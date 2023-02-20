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
        Schema::create('mission_documents', function (Blueprint $table) {
            $table->bigIncrements('mission_document_id');
            $table->unsignedBigInteger('mission_id');
            $table->foreign('mission_id')->references('mission_id')->on('missions');
            $table->string('document_name', 255);
            $table->string('document_type', 255);
            $table->string('document_path', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_documents');
    }
};
