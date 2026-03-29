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
            ['name' => '日用品', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '文房具', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '衣類', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '家具', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '書籍', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '雑貨', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'キッチン用品', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '食器', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'その他', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
