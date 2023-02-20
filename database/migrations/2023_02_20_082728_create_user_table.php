<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('first_name', 16)->nullable();
            $table->string('last_name', 16)->nullable();
            $table->string('email', 128);
            $table->string('password', 255);
            $table->integer('phone_number');
            $table->string('avatar', 2048)->nullable();;
            $table->text('why_i_volunteer')->nullable();
            $table->string('employee_id', 16)->nullable();;
            $table->string('department', 16)->nullable();;
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('country_id')->on('country'); 
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('city_id')->on('city');
            $table->text('profile_text')->nullable();
            $table->string('linked_in_url', 255)->nullable();;
            $table->string('title', 255)->nullable();;
            $table->enum('status',[0,1]);
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
        Schema::dropIfExists('user');
    }
}
