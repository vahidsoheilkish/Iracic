<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->integer('major_id')->unsigned();

            $table->integer('conference_user_id')->unique()->unsigned();
            $table->foreign('conference_user_id')->references("id")->on("conference_users")->onDelete("cascade");

            $table->text('title')->nullable();
            $table->string('slug')->nullable();

            $table->enum('level',['international','regional','national','provincial','inner'])->nullable();


            $table->string("printISSN")->nullable();
            $table->string("onlineISSN")->nullable();
            $table->string("ISBN")->nullable();

            $table->string("country")->nullable();
            $table->string("conference_publisher")->nullable();
            $table->integer("viewCount")->unsigned()->default(0);

            $table->string("organizer")->nullable();
            $table->string('owner_logo')->nullable();

            $table->enum('conference_type',['abstract','fulltext']);
            $table->enum('access',['open','pay']);

            $table->string("DOI");

            $table->string("code")->nullable();

            $table->enum('lang',['en','fa']);
            $table->enum('active',[0,1,2])->default(0);

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
        Schema::dropIfExists('conferences');
    }
}
