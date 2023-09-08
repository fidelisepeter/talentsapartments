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
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('category_id')->nullable()->after('user_id');
            $table->longText('description')->nullable()->after('complain');
            $table->longText('satisfactory_message')->nullable()->after('description');
            $table->boolean('complained_before')->nullable()->after('description');
            $table->timestamp('last_date')->nullable()->after('complained_before');
            $table->string('file')->nullable()->after('last_date');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            //
        });
    }
};
