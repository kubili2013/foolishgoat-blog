<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',128)->unique()->comment('标题');
            $table->string('thumbnail',256)->comment('缩略图');
            $table->integer('view_number')->unsigned()->default(0)->comment('阅读次数');
            $table->integer('upvote_number')->unsigned()->default(0)->comment('点赞次数');
            $table->unsignedInteger('user_id')->comment('关联用户id');
            $table->boolean('is_top')->comment('是否置顶')->default(false);
            $table->boolean('is_essence')->comment('是否精华')->default(false);
            $table->boolean('publish')->default(false);
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('articles');
    }
}
