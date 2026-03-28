<?php

namespace Database\Factories;

use App\Models\Condition;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seller_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'condition_id' => Condition::all()->random()->id,
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'image' => 'default.png',
            'price' => $this->faker->numberBetween(100, 50000),
            'status' => 1, // 新規出品は販売中固定
        ];
    }
}
