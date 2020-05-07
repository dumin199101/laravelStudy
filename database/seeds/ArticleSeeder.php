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
        $data = [];
        for ($i=1;$i<10;$i++) {
            $data[] = [
                'title'=>'title_' . $i,
                'desc'=>'desc_' . $i
            ];
        }
        DB::table('articles')->insert($data);
    }
}
