<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferenceVolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference_volumes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("conference_id")->unsigned();
            $table->foreign("conference_id")->references("id")->on("conferences")->onDelete("cascade");

            $table->text('conference_subjects')->nullable();
            $table->text('description')->nullable();
            $table->boolean('sent_article')->nullable();

            $table->string('sendAbstractDate')->nullable();
            $table->string('sendArticleDate')->nullable();
            $table->string('declareRefereeDate')->nullable();

            $table->string('startDate')->nullable();
            $table->string('endDate')->nullable();

            $table->string("city")->nullable();
            $table->string("place")->nullable();

            $table->string("postAddress")->nullable();
            $table->string("siteAddress")->nullable();
            $table->string("email")->nullable();
            $table->string("tell")->nullable();
            $table->string("fax")->nullable();

            // todo add pic and field

            $table->string("chief")->nullable();
            $table->string("conferenceSecretary")->nullable();
            $table->string("conferencePresidency")->nullable();
            $table->string("scientificSecretary")->nullable();
            $table->string("executiveSecretary")->nullable();

            $table->string("poster")->nullable();

            $table->string("catalogue")->nullable();

            $table->string("letter")->nullable();
            $table->string("dir")->nullable();
            $table->enum('type',[1,2,3]);


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
        Schema::dropIfExists('conference_volumes');
    }
}
