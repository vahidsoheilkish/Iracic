<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('level')->default('user');
            $table->string('name')->nullable();;
            $table->string('family')->nullable();;
            $table->string('dependency')->nullable();;
            $table->string('melicode',10)->unique();
            $table->string('mobile',11)->nullable();;
            $table->string('email')->unique();
            $table->string('password');
            $table->string('organization_type')->nullable();;
            $table->string('job')->nullable();;
            $table->tinyInteger('group_id')->default(0)->nullable();;
            $table->tinyInteger('major_id')->default(0)->nullable();;
            $table->string('imgUrl')->default('no-img.jpg')->nullable();;
            $table->text('address')->nullable();;
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

        });
//        Schema::create('users', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('level')->default('publisher');
//            $table->string('publication_title');
//            $table->string('website_address');
//            $table->string('publication_DOI')->unique();
//            $table->string('ISSN')->unique();
//            $table->string('email')->unique();
//            $table->timestamp('email_verified_at')->nullable();
//            $table->string('password');
//            $table->rememberToken();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
