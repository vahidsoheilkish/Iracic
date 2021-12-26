<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("volume_id")->unsigned();
            $table->foreign("volume_id")->references("id")->on("volumes")->onDelete("cascade");

            $table->string("duration")->nullable();
            $table->string("pages_number" , 12)->nullable();

            $table->boolean("special")->default(0);
            $table->text("description")->nullable();

            $table->unique(['volume_id','duration']);

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
        Schema::dropIfExists('issues');
    }
}
