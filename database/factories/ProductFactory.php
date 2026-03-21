<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'description' => $this->faker->randomElement([
                'Armacao acetato premium',
                'Lente monofocal antirreflexo',
                'Lente multifocal digital',
                'Armacao metal leve',
                'Lente fotossensivel',
                'Cordao para oculos',
                'Kit limpeza lentes',
            ]).' '.$this->faker->bothify('##??'),
            'value' => $this->faker->randomFloat(2, 25, 950),
            'quantity' => $this->faker->numberBetween(5, 120),
        ];
    }
}
