<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
            $table->text("body")->nullable();
            $table->text("tags")->nullable();
            $table->string("imgUrl")->nullable();

            $table->bigInteger("viewCount")->unsigned()->default(0);

            $table->enum('lang',['en','fa','ar']);

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
        Schema::dropIfExists('posts');
    }
}
