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
        Schema::create('mission_skills', function (Blueprint $table) {
            $table->bigIncrements('mission_skill_id');
            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')->references('skill_id')->on('skills');
            $table->unsignedBigInteger('mission_id');
            $table->foreign('mission_id')->references('mission_id')->on('missions');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_skills');
    }
};
