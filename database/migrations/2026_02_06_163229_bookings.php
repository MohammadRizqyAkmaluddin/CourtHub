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
            $table->foreignId('user_id')->constrained();
            $table->string('guest_contact');
            $table->date('booking_date');
            $table->integer('total_price');
            $table->enum('status', ['pending', 'paid', 'cancelled', 'expired']);

            $table->index('status');
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
