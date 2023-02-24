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
        Schema::create('missions', function (Blueprint $table) {
            $table->bigIncrements('mission_id');
            $table->unsignedBigInteger('theme_id');
            $table->foreign('theme_id')->references('mission_theme_id')->on('mission_themes');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('city_id')->on('cities');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('country_id')->on('countries');
            $table->string('title', 128);
            $table->text('short_description');
            $table->text('description');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->enum('mission_type',['TIME','GOAL']);
            $table->tinyInteger('status')->default(1);
            $table->string('organization_name', 255)->nullable();
            $table->text('organization_detail')->nullable();
            $table->enum('availability', ['daily','weekly','week-end','monthly'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
