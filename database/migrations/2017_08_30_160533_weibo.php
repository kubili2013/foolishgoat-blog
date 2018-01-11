<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Weibo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weibo', function (Blueprint $table) {
            $table->string('id',64)->unique();
            $table->integer('user_id')->unsigned();
            $table->string('weibo_id',64)->unique();
            $table->string('index_url',128)->nullable(true);
            $table->timestamps();
            $table->primary('id');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weibo');
    }
}
