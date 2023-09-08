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
        

        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item')->unique();
            $table->string('thumbnail')->nullable();
            $table->string('category_id')->nullable();
            $table->longText('description')->nullable();
            $table->string('cost')->nullable();
            $table->string('quantity')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated')->references('id')->on('users');
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
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('inventories');
    }
};
