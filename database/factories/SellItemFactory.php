<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sell;
use App\Models\SellItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellItemFactory extends Factory
{
    protected $model = SellItem::class;

    public function definition()
    {
        $product = Product::query()->inRandomOrder()->first();

        return [
            'sell_id' => Sell::query()->inRandomOrder()->value('id'),
            'product_id' => $product?->id,
            'quantity' => $this->faker->numberBetween(1, 3),
            'value' => $product?->value ?? $this->faker->randomFloat(2, 20, 300),
            'discount' => $this->faker->randomFloat(2, 0, 30),
        ];
    }
}
