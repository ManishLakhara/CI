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
        Schema::create('stories', function (Blueprint $table) {
            $table->bigIncrements('story_id');
            $table->unsignedBigInteger('mission_id');
            $table->foreign('mission_id')->references('mission_id')->on('missions');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->enum('status',['DRAFT', 'PENDING',  'PUBLISHED',  'DECLINED'])->default('DRAFT');
            $table->timestamp('published_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
