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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('promo_code')->unique();
            $table->string('thumbnail');
            $table->string('promo_type');
            $table->longText('description')->nullable();
            $table->json('promo_data')->nullable();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->boolean('active')->default(0);
            $table->boolean('show')->default(0);
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
        Schema::dropIfExists('promos');
    }
};
