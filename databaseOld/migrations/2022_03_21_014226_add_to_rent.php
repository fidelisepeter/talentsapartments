<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToRent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->string('bed_space')->nullable();
            $table->string('move_in')->nullable();
            $table->string('expiring_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rents', function($table) {
            $table->dropColumn('bed_space');
            $table->dropColumn('move_in');
            $table->dropColumn('expiring_date');
        });
    }
}
