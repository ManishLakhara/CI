<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionInviteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_invite', function (Blueprint $table) {
            $table->bigIncrements('mission_invite_id');
            $table->unsignedBigInteger('mission_id');
            $table->foreign('mission_id')->references('mission_id')->on('mission'); 
            $table->unsignedBigInteger('from_user_id');
            $table->foreign('from_user_id')->references('user_id')->on('user'); 
            $table->unsignedBigInteger('to_user_id');
            $table->foreign('to_user_id')->references('user_id')->on('user'); 
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
        Schema::dropIfExists('mission_invite');
    }
}
