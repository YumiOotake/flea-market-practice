<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['name' => '日用品'],
            ['name' => '文房具'],
            ['name' => '衣類'],
            ['name' => '家具'],
            ['name' => '書籍'],
            ['name' => '雑貨'],
            ['name' => 'キッチン用品'],
            ['name' => '食器'],
            ['name' => 'その他'],
        ]);
    }
}
