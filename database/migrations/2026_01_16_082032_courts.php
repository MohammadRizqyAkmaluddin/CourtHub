<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courts', function(Blueprint $table) {
            $table->id();
            $table->foreignId('venue_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sport_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('court_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('court_material_id')->constrained()->cascadeOnDelete();
            $table->string('name', 50);
            $table->integer('price');
            $table->integer('session_duration');
            $table->string('image')->nullable();
            $table->engine = 'InnoDB';
        });

        DB::statement("
            ALTER TABLE courts
            ADD CONSTRAINT check_session_duration
            CHECK (session_duration IN (60, 30, 100, 120)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
