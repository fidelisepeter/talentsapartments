<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('code')->unique();
            $table->string('year')->nullable();
            $table->string('type')->nullable();
            $table->timestamp('date')->nullable();
            $table->enum('status', ['awaiting', 'ongoing', 'closed'])->default('awaiting');
            $table->timestamp('visit_start')->nullable();
            $table->timestamp('visit_end')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('Cascade');
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
        Schema::dropIfExists('guests');
    }
}
