<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('ivnites', function(Blueprint $table) {
            $table->id();
            $table->string('code')->index();
            $table->string('email');
            $table->integer('user_id')->unsigned();
            $table->string('status');
            $table->dateTime('expires');
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
        Schema::dropIfExists('invites');
    }
}