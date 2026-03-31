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
        Schema::create('ratings', function(Blueprint $table){
            $table->id();
            $table->foreignId('booking_id')->constrained();
            $table->decimal('rate', 2, 1);
            $table->text('review')->nullable();
            $table->timestamps();

            $table->unique('booking_id');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
