<?php

namespace Database\Factories;

use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

class WordFactory extends Factory
{
    protected $model = Word::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'deutsch' => $this->faker->word,
            'englisch' => $this->faker->word,
        ];
    }
}
