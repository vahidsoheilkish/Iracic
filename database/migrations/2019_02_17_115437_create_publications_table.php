<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("group_id")->unsigned();
            $table->foreign("group_id")->references("id")->on("groups")->onDelete("cascade");
            $table->integer("major_id")->unsigned();
            $table->foreign("major_id")->references("id")->on("majors")->onDelete("cascade");
            $table->integer('publication_user_id')->unique()->unsigned();
            $table->foreign("publication_user_id")->references("id")->on("publication_users")->onDelete("cascade");

            $table->text("title")->nullable();
            $table->string("slug")->nullable();

            $table->string("printISSN")->nullable();
            $table->string("onlineISSN")->nullable();

            $table->string("dependency")->nullable();
            $table->string("DOI")->nullable();

            $table->string('poster')->nullable();
            $table->string('owner_logo')->nullable();

            $table->enum('lang',['en','fa','ar']);

            $table->enum('publish_order',['month','season','half-year']);
            $table->enum('publication_type',['abstract','fulltext']);
            $table->enum('access',['open','pay']);

            $table->string('first_publish_year')->nullable();

            $table->string("country")->nullable();
            $table->string("city")->nullable();

            $table->string("iracic_code")->nullable();
            $table->enum('active',[0,1,2])->default(0);

            $table->integer("viewCount")->unsigned()->default(0);



            $table->string("publication_publisher")->nullable();

            $table->string("responsible")->nullable(); //modir masol
            $table->string("redactor")->nullable(); // sar dabir
            $table->string("editor")->nullable(); // virastar
            $table->string("manager_in")->nullable(); // modir dakheli
            $table->string("manager_exe")->nullable(); // modir ejraee

            $table->string("tell")->nullable(); // tell
            $table->string("fax")->nullable(); // fax
            $table->string("website")->nullable(); // website
            $table->text("address")->nullable(); // address

            $table->string("dir")->nullable();

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
        Schema::dropIfExists('publications');
    }
}
