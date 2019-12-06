<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_senders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('week_day');
            $table->string('time');
            $table->string('subject');
            $table->text('text');
            $table->integer('isSend')->default(0);
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
        Schema::dropIfExists('email_senders');
    }
}
