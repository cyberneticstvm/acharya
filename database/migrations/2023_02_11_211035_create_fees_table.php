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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student');
            $table->unsignedBigInteger('batch');
            $table->date('paid_date')->nullable();
            $table->tinyInteger('fee_month')->nullable();
            $table->integer('fee_year')->nullable();
            $table->decimal('fee', 7, 2)->default(0);
            $table->boolean('discount_applicable')->comment('1-yes, 0-no')->default(0);
            $table->unsignedBigInteger('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->references('id')->on('users');
            $table->foreign('student')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('batch')->references('id')->on('batches')->onDelete('cascade');
            $table->unique(['student', 'batch', 'fee_month', 'fee_year']);
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
        Schema::dropIfExists('fees');
    }
};
