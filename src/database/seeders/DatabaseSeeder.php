<?php

namespace Database\Seeders;

use App\Models\Condition;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoriesTableSeeder::class,
            ConditionsTableSeeder::class,
        ]);

        User::factory(10)->create();
        Item::factory(30)->create();
        Order::factory(10)->create();
        //順番が重要で、依存するデータが先にないとエラーに
    }
}
