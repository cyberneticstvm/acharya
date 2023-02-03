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
        Schema::table('users', function(Blueprint $table){
            $table->string('mobile', 10)->after('email')->nullable();
            $table->string('role', 10)->after('remember_token')->comment('admin, staff')->nullable();
            $table->string('status', 10)->after('role')->comment('active, inactive')->nullable();
            $table->unsignedBigInteger('branch')->after('status');
            $table->foreign('branch')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('email');
            $table->dropColumn('role');
            $table->dropColumn('status');
        });
    }
};
