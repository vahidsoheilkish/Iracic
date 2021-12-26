<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferenceUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('codemeli')->unique();
            $table->string('password')->nullable();
            $table->string('tell')->nullable();
            $table->string('real_password')->nullable();
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
        Schema::dropIfExists('conference_users');
    }
}
