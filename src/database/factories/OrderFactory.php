<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Item;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $item = Item::all()->random();

        return [
            'item_id' => $item->id,
            'buyer_id' => User::all()->random()->id,
            'seller_id' => $item->seller_id, // itemの出品者と一致させる
            'status' => $this->faker->randomElement([1, 2, 3]),
        ];
    }
}
