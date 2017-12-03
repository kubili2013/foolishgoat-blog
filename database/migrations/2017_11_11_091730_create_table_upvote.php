<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUpvote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upvote', function (Blueprint $table) {
            $table->unsignedInteger('article_id')->comment('关联文章id');
            $table->unsignedInteger('user_id')->comment('关联用户id');
            $table->primary(['article_id', 'user_id']);
            $table->timestamps();
            $table->foreign('article_id')->references('id')->on('articles');
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
        Schema::dropIfExists('upvote');
    }
}
