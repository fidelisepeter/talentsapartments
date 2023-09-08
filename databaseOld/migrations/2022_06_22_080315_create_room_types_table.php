<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('detail');
            $table->string('photo')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('status')->default('available');
            $table->string('location');
            $table->string('no_of_rooms')->nullable();
            $table->string('amenity1')->nullable();
            $table->string('amenity2')->nullable();
            $table->string('amenity3')->nullable();
            $table->string('amenity4')->nullable();
            $table->string('amenity5')->nullable();
            $table->string('amenity6')->nullable();
            $table->string('amenity7')->nullable();
            $table->string('amenity8')->nullable();
            $table->string('amenity9')->nullable();
            $table->string('amenity10')->nullable();
            $table->bigInteger('year');
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
        Schema::dropIfExists('room_types');
    }
}
