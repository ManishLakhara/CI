<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_media', function (Blueprint $table) {
            $table->bigIncrements('story_media_id');
            $table->unsignedBigInteger('story_id');
            $table->foreign('story_id')->references('story_id')->on('story'); 
            $table->string('type', 8);
            $table->text('path');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('story_media');
    }
}
