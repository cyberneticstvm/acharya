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
        Schema::create('batch_syllabi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch')->references('id')->on('batches');
            $table->unsignedBigInteger('module');
            $table->boolean('status')->comment('1-completed,0-not completed')->default(0);
            $table->unsignedBigInteger('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->references('id')->on('users');
            $table->foreign('module')->references('id')->on('modules')->onDelete('cascade');
            $table->foreign('module')->references('id')->on('modules')->onUpdate('cascade');
            $table->unique(['batch', 'module']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch_syllabi');
    }
};
