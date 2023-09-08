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
        Schema::create('purchased_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('cost')->nullable();
            $table->foreignId('used_by')->nullable();
            $table->longText('description')->nullable();
            $table->string('data')->nullable();
            $table->string('task_id')->nullable();
            $table->string('labour')->nullable();
            $table->foreign('inventory_id')->references('id')->on('inventories');
            $table->foreign('used_by')->references('id')->on('users');
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
        Schema::dropIfExists('purchased_items');
    }
};
