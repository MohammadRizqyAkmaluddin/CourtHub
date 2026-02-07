<?php

namespace App\Services;

use App\Models\BookingHold;
use App\Models\BookingSession;

class BookingAvailabilityService
{
    /**
     * Create a new class instance.
     */
    public function isSlotAvailable(
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
            })->exists();

        if ($bookingExists) return false;

        $holdExists = BookingHold::where('court_id', $courtId)
            ->where('booking_date', $date)
            ->where('expires', '>', now())
            ->where(function ($q) use ($start, $end) {
                $q->where('start_time', '<', $end)
                  ->where('end_time', '>', $start);
            })->exists();

        return !$holdExists;
    }
}
