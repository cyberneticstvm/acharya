<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_syllabs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch')->references('id')->on('batches');
            $table->unsignedBigInteger('syllabus')->references('id')->on('syllabi');
            $table->unique(['batch', 'syllabus']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch_syllabs');
    }
};
