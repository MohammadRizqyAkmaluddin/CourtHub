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
        Schema::create('communities', function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('venue_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('sport_type_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('venue_name')->nullable();
            $table->foreignId('city_id')->nullable()->constrained();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('membership_fee');
            $table->integer('total_member');
            $table->integer('max_slot');
            $table->text('description');
            $table->string('image');
            $table->integer('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
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
