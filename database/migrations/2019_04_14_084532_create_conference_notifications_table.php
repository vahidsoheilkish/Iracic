<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferenceNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference_notifications', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("conference_user_id")->unsigned();
            $table->foreign("conference_user_id")->references("id")->on("conference_users")->onDelete("cascade");

            $table->text("message")->nullable();
            $table->boolean("seen")->default(0);

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
        Schema::dropIfExists('conference_notifications');
    }
}
