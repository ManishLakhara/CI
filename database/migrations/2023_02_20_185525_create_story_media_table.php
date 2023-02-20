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
        Schema::create('story_media', function (Blueprint $table) {
            $table->bigIncrements('story_media_id');
            $table->unsignedBigInteger('story_id');
            $table->foreign('story_id')->references('story_id')->on('stories');
            $table->string('type', 8);
            $table->text('path');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_media');
    }
};
