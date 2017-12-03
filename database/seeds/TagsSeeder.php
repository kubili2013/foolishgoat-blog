<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**  添加角色 */
        DB::table('tags')->insert([
            ['id' => 1, 'tags' => "Java", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 2, 'tags' => "Javascript", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 3, 'tags' => "PHP", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 4, 'tags' => "C", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 5, 'tags' => "C++", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 6, 'tags' => "Python", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 7, 'tags' => "Linux", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 8, 'tags' => "Spring", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 9, 'tags' => "Laravel", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 10, 'tags' => "Ionic", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 11, 'tags' => "Vue", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 12, 'tags' => "Angular", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 13, 'tags' => "Unity 3D", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 14, 'tags' => "LibGDX", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 15, 'tags' => "Bootstrap", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 16, 'tags' => "游戏开发", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 17, 'tags' => "Web前端", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 18, 'tags' => "Web服务端", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 19, 'tags' => "Hibernate", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
            ['id' => 20, 'tags' => "Spring MVC", 'created_at' => '2016-07-12 11:31:36', 'updated_at' => '2016-07-12 11:31:36',],
        ]);
    }
}
