<?php

namespace Database\Factories;

use App\Models\Person;
use Guiliredu\BrazilianCityMigrationSeed\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'nickname' => $this->faker->firstName(),
            'document' => $this->faker->unique()->numerify('###########'),
            'address' => $this->faker->streetAddress(),
            'address_city_id' => City::query()->inRandomOrder()->value('id') ?? 1,
            'address_reference' => $this->faker->sentence(4),
            'district' => $this->faker->citySuffix(),
            'phone' => $this->faker->numerify('###########'),
            'age' => $this->faker->numberBetween(18, 90),
            'acs' => 'ACS '.$this->faker->bothify('??###'),
        ];
    }
}
