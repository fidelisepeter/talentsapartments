<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->mediumText('reg_email_template')->nullable();
            $table->mediumText('payment_email_template')->nullable();
            $table->mediumText('file_email_template')->nullable();
            $table->mediumText('complain_email_template')->nullable();
            $table->string('reg_email_recipient')->nullable();
            $table->string('payment_email_recipient')->nullable();
            $table->string('file_email_recipient')->nullable();
            $table->string('complain_email_recipient')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
