<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\BookingSession;
use App\Models\BookingHold;
use App\Models\BookingHoldHeader;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Illuminate\Support\Str;

use function Symfony\Component\Clock\now;

class BookingHoldController extends Controller
{
    public function storeAuth(Request $request)
    {
        $request->validate([
            'venue_id' => 'required|exists:venues,id',
            'court_id' => 'required|exists:courts,id',
            'date' => 'required|date',
            'sessions' => 'required|array|min:1',
            'sessions.*.start' => 'required',
            'sessions.*.end' => 'required',
            'sessions.*.price' => 'required|integer',
        ]);

        $userId = Auth::id();

        $checkExisting = BookingHoldHeader::where('user_id', $userId)->first();

        if ($checkExisting) {
            $checkExisting->delete();
        }

        $expiresAt = Carbon::now()->addMinutes(10);

        $bookingHoldHeader = BookingHoldHeader::create([
            'venue_id'     => $request->venue_id,
            'court_id'     => $request->court_id,
            'user_id'      => $userId,
            'booking_date' => $request->date,
            'expires_at'   => $expiresAt
        ]);

        $holds = [];
        foreach ($request->sessions as $session) {
           $holds[] =  BookingHold::create([
                'booking_hold_header_id' => $bookingHoldHeader->id,
                'start_time' => $session['start'],
                'end_time' => $session['end'],
                'price' => $session['price'],
            ]);
        }

        return response()->json([
            'success' => true,
            'expires_at' => $expiresAt,
            'booking_hold_header_id' => $bookingHoldHeader->id,
            'sessions' => $holds,
        ]);
    }

    public function storeGuest(Request $request)
    {
        $request->validate([
            'venue_id' => 'required|exists:venues,id',
            'court_id' => 'required|exists:courts,id',
            'date' => 'required|date',
            'sessions' => 'required|array|min:1',
            'sessions.*.start' => 'required',
            'sessions.*.end' => 'required',
            'sessions.*.price' => 'required|integer',
            'guest_contact' => 'required|string',
        ]);

        $checkExisting = BookingHoldHeader::where('guest_contact', $request->guest_contact)->first();

        if ($checkExisting) {
            $checkExisting->delete();
        }

        $expiresAt = Carbon::now()->addMinutes(10);

        $bookingHoldHeader = BookingHoldHeader::create([
            'venue_id' => $request->venue_id,
            'court_id' => $request->court_id,
            'user_id'  => null,
            'guest_contact' => $request->guest_contact,
            'guest_name' => $request->guest_name,
            'booking_date'  => $request->date,
            'expires_at' => $expiresAt
        ]);

        $holds = [];
        foreach ($request->sessions as $session) {
           $holds[] =  BookingHold::create([
                'booking_hold_header_id' => $bookingHoldHeader->id,
                'start_time' => $session['start'],
                'end_time' => $session['end'],
                'price' => $session['price'],
            ]);
        }

        return response()->json([
            'success' => true,
            'expires_at' => $expiresAt,
            'booking_hold_header_id' => $bookingHoldHeader->id,
            'sessions' => $holds,
        ]);
    }

    public function show($id)
    {
        $header = BookingHoldHeader::with(['venue', 'court'])
            ->findOrFail($id);

        $sessions = BookingHold::where('booking_hold_header_id', $header->id)
            ->orderBy('start_time')
            ->get();

        return response()->json([
            'id' => $header->id,
            'venue' => $header->venue,
            'court' => $header->court,
            'date' => $header->booking_date,
            'expires_at' => $header->expires_at,
            'sessions' => $sessions,
            'total_price' => $sessions->sum('price'),
            'guest_contact' => $header->guest_contact,
            'user_id' => $header->user_id,
        ]);
    }


    public function cancel(Request $request)
    {
        $request->validate([
            'booking_hold_header_id' => 'required|integer',
        ]);

        $header = BookingHoldHeader::with('hold')
            ->find($request->booking_hold_header_id);

        if (!$header) {
            return response()->json([
                'success' => false,
                'message' => 'Booking hold header not found'
            ], 404);
        }

        $header->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function myActiveHolds()
    {
        $userId = Auth::id();

        $holds = BookingHoldHeader::with([
                'venue',
                'court',
                'hold' // relasi ke booking_holds
            ])
            ->where('user_id', $userId)
            ->where('expires_at', '>', Carbon::now())
            ->orderBy('expires_at')
            ->get();

        return response()->json([
            'data' => $holds
        ]);
    }

    public function active(Request $request)
    {
        $user = Auth::user();

        $hold = BookingHold::with('header')
            ->where('user_id', $user->id)
            ->whereHas('header', function ($q) {
                $q->where('status', 'hold'); // atau unpaid
            })
            ->latest()
            ->first();

        return response()->json([
            'has_active' => (bool) $hold,
            'hold' => $hold,
        ]);
    }

    public function replace(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|integer',
        ]);

        DB::transaction(function () use ($request) {
            // hapus booking lama
            BookingHold::where('user_id', Auth::id())->delete();
            BookingHoldHeader::where('user_id', Auth::id())
                ->where('status', 'hold')
                ->delete();

            // buat booking baru
            $header = BookingHoldHeader::create([
                'user_id' => Auth::id(),
                'status' => 'hold',
            ]);

            BookingHold::create([
                'booking_hold_header_id' => $header->id,
                'user_id' => Auth::id(),
                'schedule_id' => $request->schedule_id,
            ]);
        });

        return response()->json([
            'success' => true,
        ]);
    }

    public function check()
    {
        $user = Auth::check();

        if ($user) {
           $checkExisting = BookingHoldHeader::where('user_id', Auth::id())->first();
        }

        if($checkExisting) {
        return response()->json([
            'success' => true,
            'data'   => $checkExisting
        ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => $checkExisting
            ]);
        }
    }


    private function finalizeBooking($header)
    {
        DB::transaction(function () use ($header) {

            foreach ($header->bookingHolds as $hold) {

                // 🔥 ANTI DOUBLE BOOKING CHECK
                $conflict = Booking::where('court_id', $header->court_id)
                    ->where('booking_date', $header->booking_date)
                    ->where(function ($query) use ($hold) {
                        $query->where('start_time', '<', $hold->end_time)
                            ->where('end_time', '>', $hold->start_time);
                    })
                    ->lockForUpdate()
                    ->exists();

                if ($conflict) {
                    throw new \Exception('Slot already booked');
                }

                Booking::create([
                    'venue_id' => $header->venue_id,
                    'court_id' => $header->court_id,
                    'user_id' => $header->user_id,
                    'guest_contact' => $header->guest_contact,
                    'guest_name' => $header->guest_name,
                    'booking_date' => $header->booking_date,
                    'start_time' => $hold->start_time,
                    'end_time' => $hold->end_time,
                    'price' => $hold->price,
                    'midtrans_order_id' => $header->midtrans_order_id,
                    'payment_status' => 'paid',
                    'status' => 'confirmed'
                ]);
            }

            $header->update([
                'payment_status' => 'paid'
            ]);

            $header->bookingHolds()->delete();
            $header->delete();
        });
    }

    public function createPayment($id)
    {
        try {

            $header = BookingHoldHeader::with('hold')->findOrFail($id);

            $orderId = 'ORDER-' . time() . '-' . $header->id;

            $grossAmount = $header->hold->sum('price');

            if ($grossAmount <= 0) {
                throw new \Exception('Total price is 0');
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $grossAmount,
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $header->update([
                'midtrans_order_id' => $orderId,
                'snap_token' => $snapToken,
                'payment_status' => 'pending'
            ]);

            return response()->json([
                'snap_token' => $snapToken
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }


    private function markAsPaid($orderId)
    {
            DB::transaction(function () use ($orderId) {

                $header = BookingHoldHeader::with('hold')
                    ->where('midtrans_order_id', $orderId)
                    ->first();

                if (!$header) return;

                $totalPrice = $header->hold->sum('price');

                // 1️⃣ create booking
                $booking = Booking::create([
                    'venue_id' => $header->venue_id,
                    'court_id' => $header->court_id,
                    'booking_date' => $header->booking_date,
                    'user_id' => $header->user_id,
                    'guest_contact' => $header->guest_contact,
                    'guest_name' => $header->guest_name,
                    'price' => $totalPrice,
                    'midtrans_order_id' => $header->midtrans_order_id,
                    'payment_status' => 'paid',
                    'status' => 'confirmed',
                ]);

                // 2️⃣ insert sessions
                foreach ($header->hold as $hold) {
                    BookingSession::create([
                        'booking_id' => $booking->id,
                        'start_time' => $hold->start_time,
                        'end_time'   => $hold->end_time,
                        'price'      => $hold->price,
                    ]);
                }

                // 3️⃣ hapus hold
                $header->hold()->delete();
                $header->delete();
            });
    }

    private function markAsFailed($orderId)
    {
        $header = BookingHoldHeader::where('midtrans_order_id', $orderId)->first();

        if (!$header) return;

        $header->hold()->delete();
        $header->delete();
    }

    public function handle(Request $request)
    {
        $orderId = $request->order_id;
        $status = $request->transaction_status;
        $fraud = $request->fraud_status;

        $signatureKey = hash('sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            config('midtrans.server_key')
        );

        if ($signatureKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        if ($status == 'capture') {
            if ($fraud == 'accept') {
                $this->markAsPaid($orderId);
            }
        }
        elseif ($status == 'settlement') {
            $this->markAsPaid($orderId);
        }
        elseif ($status == 'expire' || $status == 'cancel') {
            $this->markAsFailed($orderId);
        }

        return response()->json(['message' => 'ok']);
    }

}
