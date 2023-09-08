<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('suffix')->nullable();
            $table->string('ta_uid')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('verification_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('role')->default('student');
            //personal info
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('school')->nullable();
            $table->string('level')->nullable();
            $table->string('course')->nullable();
            $table->string('department')->nullable();
            $table->string('faculty')->nullable();
            $table->string('matric_number')->unique()->nullable();
            //guardian
            $table->string('g_relationship')->nullable();
            $table->string('g_suffix')->nullable();
            $table->string('g_first_name')->nullable();
            $table->string('g_last_name')->nullable();
            $table->string('g_email')->nullable();
            $table->string('g_phone_number')->nullable();
            $table->string('g_street')->nullable();
            $table->string('g_city')->nullable();
            $table->string('g_state')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
