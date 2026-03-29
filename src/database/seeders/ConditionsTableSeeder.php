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
            ['name' => '新品', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '非常に良好', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '良好', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '普通', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '傷・汚れあり', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
