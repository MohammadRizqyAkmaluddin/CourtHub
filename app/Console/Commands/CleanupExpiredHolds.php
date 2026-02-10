<?php

namespace App\Console\Commands;

use App\Models\BookingHold;
use App\Models\BookingHoldHeader;
use Illuminate\Console\Command;

use function Symfony\Component\Clock\now;

class CleanupExpiredHolds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-expired-holds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        BookingHoldHeader::where('expires_at', '<=', now())->delete();
    }
}
