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
        Schema::table('fees', function(Blueprint $table){
            $table->boolean('fee_pending')->comment('1-yes, 0-no')->after('discount_applicable')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fees', function(Blueprint $table){
            $table->dropColumn('fee_pending');
        });
    }
};
