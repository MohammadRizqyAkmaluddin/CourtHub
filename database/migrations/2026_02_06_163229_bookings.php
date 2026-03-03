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
        Schema::create('bookings', function(Blueprint $table){
            $table->id();
            $table->foreignId('venue_id')->constrained();
            $table->foreignId('court_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('guest_contact')->nullable();
            $table->string('guest_name')->nullable();

            $table->date('booking_date');

            $table->integer('price');

            $table->string('midtrans_order_id')->unique();
            $table->string('payment_status');

            $table->string('status')->default('confirmed');
            // confirmed | cancelled | expired

            $table->timestamps();

            $table->index(['venue_id', 'court_id', 'booking_date']);
            $table->engine = 'InnoDB';
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
