<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->boolean('has_user_name')->default(0);
            $table->boolean('has_lawyer_name')->default(0);
            $table->boolean('has_signature')->default(0);
            $table->boolean('has_stamp')->default(0);
            $table->boolean('show_sign_date')->default(0);
            $table->text('user_name_config')->nullable();
            $table->text('lawyer_name_config')->nullable();
            $table->text('signature_config')->nullable();
            $table->text('stamp_config')->nullable();
            $table->text('signed_date_config')->nullable();
            $table->string('lawyers_assigned')->nullable();
            $table->string('attachments')->nullable();
            $table->string('document_path');
            $table->string('year');
            $table->timestamps();
        });

        Schema::create('signed_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->nullable();
            $table->foreignId('lawyer_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->text('signatures')->nullable();
            $table->string('signatures_status')->enum(['pending', 'completed'])->default('pending');
            $table->text('stamps')->nullable();
            $table->string('stamps_status')->enum(['pending', 'completed'])->default('pending');
            $table->text('names')->nullable();
            $table->string('names_status')->enum(['pending', 'completed'])->default('pending');
            $table->timestamp('signed_date')->nullable();
            $table->string('year');
            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('lawyer_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('documents');
    }
}
