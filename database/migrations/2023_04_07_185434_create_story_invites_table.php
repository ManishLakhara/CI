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
        Schema::create('story_invites', function (Blueprint $table) {
            $table->bigIncrements('story_invite_id');
            $table->unsignedBigInteger('story_id');
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_invites');
    }
};
