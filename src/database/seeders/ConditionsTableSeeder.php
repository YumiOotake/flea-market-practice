<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Seeder;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condition::insert([
            ['name' => '新品'],
            ['name' => '非常に良好'],
            ['name' => '良好'],
            ['name' => '普通'],
            ['name' => '傷・汚れあり'],
        ]);
    }
}
