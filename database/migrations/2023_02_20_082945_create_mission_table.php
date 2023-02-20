<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission', function (Blueprint $table) {
            $table->bigIncrements('mission_id');
            $table->unsignedBigInteger('theme_id');
            $table->foreign('theme_id')->references('mission_theme_id')->on('mision_theme');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('city_id')->on('city'); 
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('country_id')->on('country'); 
            $table->string('title', 128);
            $table->text('short_description');
            $table->text('description');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->enum('mission_type',['TIME','GOAL']);
            $table->enum('status',[0,1]);
            $table->string('organization_name', 255)->nullable();
            $table->text('organization_detail')->nullable();
            $table->enum('availability',['daily','weekly','week-end','monthly'])->nullable();
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
        Schema::dropIfExists('mission');
    }
}
