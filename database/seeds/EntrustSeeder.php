<?php

use Illuminate\Database\Seeder;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**  添加角色 */
        DB::table('roles')->insert([
            ['id' => 1, 'name' => "admin", 'display_name' => '管理员', 'description' => '超级管理员,可以拥有各种权限',],
            ['id' => 2, 'name' => "blog_creator", 'display_name' => '博客主', 'description' => '博客主,可以写文章',],
        ]);

        /** 添加权限 */
        DB::table('permissions')->insert([
            ['id' => 1, 'name' => "system", 'display_name' => '系统管理权限', 'description' => '系统管理权限',],
            ['id' => 2, 'name' => "article", 'display_name' => '文章权限', 'description' => '文章增删改查权限',],
        ]);
    }
}
