<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Court;
use App\Models\OperationHour;
use App\Models\BookingSession;
use App\Models\BookingHold;
use App\Models\BookingHoldHeader;

use function Symfony\Component\Clock\now;

class CourtAvailabilityController extends Controller
{
    public function show(Request $request, Court $court)
    {
        $date = Carbon::parse(
            $request->query('date', Carbon::now()->toDateString())
        );

        $dayOfWeek = $date->dayOfWeekIso;

        $operation = OperationHour::where('venue_id', $court->venue_id)
            ->where('day_of_week', $dayOfWeek)
            ->first();

        if (!$operation || $operation->is_closed) {
            return response()->json([
                'date'    => $date->toDateString(),
                'session' => []
            ]);
        }

        $sessions = $this->generateSessions(
            $court,
            $date,
            $operation
        );

        return response()->json([
            'date' => $date->toDateString(),
            'court_id' => $court->id,
            'price_per_session' => $court->price,
            'sessions' => $sessions
        ]);
    }

    private function generateSessions(
        Court $court,
        Carbon $date,
        OperationHour $operation
    ): array {
        $duration = $court->session_duration;

        [$start, $end] = $this->resolveOpenClose(
            $date,
            $operation->open_time,
            $operation->close_time
        );

        $sessions = [];

        while ($start->copy()->addMinutes($duration)->lte($end)) {

            $slotEnd = $start->copy()->addMinutes($duration);

            $available = $this->isSlotAvailable(
                $court->id,
                $start->toDateString(), // ⬅️ penting
                $start->format('H:i:s'),
                $slotEnd->format('H:i:s')
            );

            $sessions[] = [
                'start' => $start->format('H:i'),
                'end'   => $slotEnd->format('H:i'),
                'price' => $court->price,
                'available' => $available
            ];

            $start = $slotEnd;
        }

        return $sessions;
    }


    private function isSlotAvailable(
        int $courtId,
        string $date,
        string $start,
        string $end
    ): bool {
        $bookingExists = BookingSession::where('court_id', $courtId)
            ->where('booking_date', $date)
            ->where(function ($q) use ($start, $end) {
                $q->where('start_time', '<', $end)
                ->where('end_time', '>', $start);
            })
            ->exists();

        if ($bookingExists) return false;

        $holdExists = BookingHold::where('court_id', $courtId)
            ->where('booking_date', $date)
            ->where('expires_at', '>', now())
            ->where(function ($q) use ($start, $end) {
                $q->where('start_time', '<', $end)
                ->where('end_time', '>', $start);
            })
            ->exists();

        return !$holdExists;
    }

    public function month(Request $request, Court $court)
    {
        $now = Carbon::now();
        $start = $now->copy()->startOfDay();
        $end = $now->copy()->endOfMonth();

        $dates = [];

        while ($start->lte($end)) {

            $hasAvailable = $this->hasAvailableSession(
                $court,
                $start
            );

            $dates[] = [
                'date' => $start->toDateString(),
                'day' => $start->format('D'),
                'has_available' => $hasAvailable
            ];

            $start->addDay();
        }

        return response()->json([
            'court_id' => $court->id,
            'month' => now()->format('Y-m'),
            'dates' => $dates
        ]);
    }

    private function hasAvailableSession(Court $court, Carbon $date): bool
    {
        $operation = OperationHour::where('venue_id', $court->venue_id)
            ->where('day_of_week', $date->dayOfWeekIso)
            ->first();

        // ❌ Tidak ada jadwal hari ini
        if (!$operation) {
            return false;
        }

        // ❌ Venue explicitly closed
        if ($operation->is_closed) {
            return false;
        }

        // ✅ Kalau buka tapi jam belum diset, anggap available
        if (!$operation->open_time || !$operation->close_time) {
            return true;
        }

        $start = Carbon::parse($date->toDateString().' '.$operation->open_time);
        $end   = Carbon::parse($date->toDateString().' '.$operation->close_time);

        // 🟢 HANDLE lewat tengah malam
        if ($end->lte($start)) {
            $end->addDay(); // tutup keesokan hari
        }

        return true;
    }

    public function day(Request $request, Court $court)
    {
        $date = Carbon::parse($request->query('date'));
        $dayOfWeek = $date->dayOfWeekIso; // Mon=1

        // operation hours venue
        $hours = $court->venue->operationHours()
            ->where('day_of_week', $dayOfWeek)
            ->first();

        if (!$hours || $hours->is_closed) {
            return response()->json([
                'court_id' => $court->id,
                'date' => $date->toDateString(),
                'sessions' => []
            ]);
        }

        [$open, $close] = $this->resolveOpenClose(
            $date,
            $hours->open_time,
            $hours->close_time
        );


        $duration = $court->session_duration; // minutes
        $price = $court->price;

        // booked (paid)
        $bookedSessions = BookingSession::whereHas('booking', function ($q) use ($court, $date) {
            $q->where('court_id', $court->id)
            ->whereDate('booking_date', $date)
            ->where('status', 'paid');
        })->get();


        // holds (not expired)
        $holds = BookingHoldHeader::with('hold')
            ->where('court_id', $court->id)
            ->whereDate('booking_date', $date)
            ->where('expires_at', '>', now())
            ->get();

        $sessions = [];

        while ($open->copy()->addMinutes($duration) <= $close) {
            $start = $open->copy();
            $end = $open->copy()->addMinutes($duration);

            $overlap = $bookedSessions->contains(fn ($b) =>
                $start < Carbon::parse($b->end_time) &&
                $end > Carbon::parse($b->start_time)
            ) || $holds->contains(fn ($h) =>
                $start < Carbon::parse($h->end_time) &&
                $end > Carbon::parse($h->start_time)
            );

            $sessions[] = [
                'start' => $start->format('H:i'),
                'end' => $end->format('H:i'),
                'price' => $price,
                'available' => !$overlap
            ];

            $open->addMinutes($duration);
        }

        return response()->json([
            'court_id' => $court->id,
            'date' => $date->toDateString(),
            'sessions' => $sessions
        ]);
    }

    private function resolveOpenClose(
        Carbon $date,
        string $open,
        string $close
    ): array {
        $start = Carbon::parse($date->toDateString().' '.$open);
        $end   = Carbon::parse($date->toDateString().' '.$close);

        if ($end->lte($start)) {
            $end->addDay(); // lewat tengah malam
        }

        return [$start, $end];
    }


}
