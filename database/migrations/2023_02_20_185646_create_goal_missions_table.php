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
        Schema::create('goal_missions', function (Blueprint $table) {
            $table->bigIncrements('goal_mission_id');
            $table->unsignedBigInteger('mission_id');
            $table->foreign('mission_id')->references('mission_id')->on('missions');
            $table->string('goal_objective_text', 255)->nullable();
            $table->integer('goal_value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal_missions');
    }
};
