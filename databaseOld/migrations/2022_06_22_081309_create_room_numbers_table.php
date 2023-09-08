<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type');
            $table->foreign('type')->references('id')->on('room_types')->onDelete('Cascade');
            $table->enum('bed_speces', ['top', 'buttom', 'left', 'right', 'top-left', 'top-right', 'buttom-left', 'buttom-right']);
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
        Schema::dropIfExists('room_numbers');
    }
}
