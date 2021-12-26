<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_notifications', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("publication_user_id")->unsigned();
            $table->foreign("publication_user_id")->references("id")->on("publication_users")->onDelete("cascade");

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
        Schema::dropIfExists('publication_notifications');
    }
}
