<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmenityToRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms_amenities');
    }
}
