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
        Schema::table('batches', function(Blueprint $table){
            $table->unsignedBigInteger('syllabus')->after('course');
            $table->foreign('syllabus')->references('id')->on('syllabi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('batches', function(Blueprint $table){
            $table->dropColumn('syllabus');
        });
    }
};
