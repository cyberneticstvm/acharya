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
        Schema::table('batch_syllabi', function (Blueprint $table) {
            $table->dropForeign('batch_syllabi_module_foreign');
            $table->unsignedBigInteger('syllabus')->references('id')->on('syllabi')->after('batch');
            $table->unique(['batch', 'syllabus', 'module']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
