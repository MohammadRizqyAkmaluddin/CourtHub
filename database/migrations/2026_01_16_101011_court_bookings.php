<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('court_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('court_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');

            $table->foreignId('additional_id')->nullable()->constrained();

            $table->enum('method', ['QRIS', 'Transfer', 'VA']);

            $table->integer('court_price');
            $table->integer('additional_price');

            $table->enum('status', [
                'Draft',
                'Locked',
                'Paid',
                'Cancelled',
                'Expired'
            ])->default('Draft');

            $table->timestamp('locked_until')->nullable();
            $table->timestamps();

            $table->index(['court_id', 'booking_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
