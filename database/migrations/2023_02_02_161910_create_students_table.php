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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('mobile', 10)->unique();
            $table->string('mobile_alt', 10)->nullable();
            $table->date('dob')->nullable();
            $table->text('qualification')->nullable();
            $table->string('category', 15)->comment('reservation category')->nullable();
            $table->text('address')->nullable();
            $table->date('admission_date')->nullable();
            $table->decimal('fee', 7, 2)->default(0.0);
            $table->boolean('discount_applicable')->comment('1-yes, 0-no')->default(0);
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('students');
    }
};
