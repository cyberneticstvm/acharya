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
        Schema::create('student_batches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student');
            $table->unsignedBigInteger('batch');
            $table->date('date_joined')->nullable();
            $table->string('status', 20)->nullable();
            $table->boolean('discount_applicable')->comment('0-no, 1-yes')->default(0);
            $table->unsignedBigInteger('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->references('id')->on('users');
            $table->foreign('student')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('batch')->references('id')->on('batches')->onDelete('cascade');
            $table->unique(['student','batch']);
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
        Schema::dropIfExists('student_batches');
    }
};
