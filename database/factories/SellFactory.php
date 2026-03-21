<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Sell;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellFactory extends Factory
{
    protected $model = Sell::class;

    public function definition()
    {
        return [
            'person_id' => Person::query()->inRandomOrder()->value('id'),
            'status' => 0,
        ];
    }
}
