
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferenceArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference_articles', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('conference_volume_id')->unique()->unsigned();
            $table->foreign('conference_volume_id')->references("id")->on("conference_volumes")->onDelete("cascade");

            $table->string('title')->nullable();
            $table->text('abstract')->nullable();
            $table->text('authors_info')->nullable();
            $table->text('highlight')->nullable();
            $table->text('keywords')->nullable();
            $table->integer('pageCount')->nullable();
            $table->string('page')->nullable();
            $table->longText('resource')->nullable();
            $table->longText('struct')->nullable();
            $table->string('DOI')->nullable();
            $table->string('IOI')->nullable();
            $table->string('files_directory')->nullable();
            $table->string('price')->nullable();
            $table->boolean('active')->default(0);
            $table->boolean('saved_authors')->default(0);
            $table->dateTime("receieved")->nullable();
            $table->dateTime("accepted")->nullable();
            $table->enum('type',['abstract','fulltext']);
            $table->smallInteger('article')->default(2);
            $table->integer("viewCount")->unsigned()->default(0);
            $table->boolean("press")->default(0);
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
        Schema::dropIfExists('conference_articles');
    }
}
