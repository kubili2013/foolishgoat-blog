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
     *
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',64)->comment('昵称');
            $table->string('email',128)->unique()->comment('邮箱,可用作登录');
            $table->string('password')->comment('密码,laravel 默认加密方式');
            $table->integer('weibo_id')->nullable(true)->unsigned()->comment('关联微博的第三方 id,唯一表示');
            $table->integer('github_id')->nullable(true)->unsigned()->comment('Github 用户唯一标识');
            $table->string('avatar',255)->nullable(true)->comment('头像地址');
            $table->date('birth')->nullable(true)->comment('生日');
            $table->string('real_name',32)->nullable(true)->comment('真是姓名');
            $table->string('phone_number',32)->nullable(true)->comment('电话');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
