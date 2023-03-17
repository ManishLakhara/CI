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
        Schema::create('time_missions', function (Blueprint $table) {
            $table->bigInteger('time_mission_id')->unsigned()->autoIncrement();
            $table->bigInteger('mission_id')->unsigned();
            $table->foreign('mission_id')->references('mission_id')->on('missions');
            $table->integer('total_seats')->nullable();
            $table->datetime('registration_deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_missions');
    }
};
