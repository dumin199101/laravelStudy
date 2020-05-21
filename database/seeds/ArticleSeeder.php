<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // faker基本使用
        /*$faker = Faker\Factory::create();
        $data = [];
        for ($i=1;$i<10;$i++) {
            $data[] = [
                'title'=>$faker->name,
                'desc'=>$faker->sentence
            ];
        }
        DB::table('articles')->insert($data);*/

        //使用faker数据工厂模拟数据
        factory(\App\Models\ArticleModel::class, 20)->create();
    }
}
