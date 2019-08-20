<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Settings1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('website_title')->nullable();
            $table->integer('logo')->unsigned()->nullable();
            $table->foreign('logo')->references('id')->on('media')->onDelete('cascade');
            $table->integer('fav_icon')->unsigned()->nullable();
            $table->foreign('fav_icon')->references('id')->on('media')->onDelete('cascade');
            $table->string('mobile1')->nullable();
            $table->string('mobile2')->nullable();
            $table->string('email')->nullable();
            $table->string('fb')->nullable();
            $table->boolean('fb_show')->nullable();
            $table->string('youtube')->nullable();
            $table->boolean('youtube_show')->nullable();
            $table->string('twitter')->nullable();
            $table->boolean('twitter_show')->nullable();
            $table->string('insta')->nullable();
            $table->boolean('insta_show')->nullable();
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
        //
    }
}
