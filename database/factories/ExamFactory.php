<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    protected $model = Exam::class;

    public function definition()
    {
        return [
            'person_id' => Person::query()->inRandomOrder()->value('id'),
            'agent_id' => $this->faker->boolean(80)
                ? User::role('agent')->inRandomOrder()->value('id')
                : null,
            'exam_at' => $this->faker->dateTimeBetween('-90 days', 'now'),
            'notes' => $this->faker->boolean(60) ? $this->faker->sentence(8) : null,
        ];
    }
}
