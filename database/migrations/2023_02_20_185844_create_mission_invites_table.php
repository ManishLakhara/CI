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
        Schema::create('mission_invites', function (Blueprint $table) {
            $table->bigIncrements('mission_invite_id');
            $table->unsignedBigInteger('mission_id');
            $table->foreign('mission_id')->references('mission_id')->on('missions');
            $table->unsignedBigInteger('from_user_id');
            $table->foreign('from_user_id')->references('user_id')->on('users');
            $table->unsignedBigInteger('to_user_id');
            $table->foreign('to_user_id')->references('user_id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_invites');
    }
};
