<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToRents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rents', function (Blueprint $table) {

            $table->string('school_check_status')->nullable();
            $table->string('guarantor_letter_photo')->nullable();
            $table->string('guarantor_letter_status')->nullable();
            $table->string('health_check_photo')->nullable();
            $table->string('health_check_status')->nullable();
            $table->string('attestation_letter_photo')->nullable();
            $table->string('attestation_letter_status')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rents');
    }
}
