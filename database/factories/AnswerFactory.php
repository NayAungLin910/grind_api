<?php

namespace Database\Factories;

use App\ConstantValues\AnswerConstantValues;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'questionId' => Question::factory(),
            'description' => fake()->paragraph(),
            'explanation' => null,
        ];
    }

    /**
     * Indicates that the answer is correct
     *
     * @return static
     */
    public function correct()
    {
        return $this->state(function(array $attbitues) {
            return [
                'explanation' => fake()->paragraph(),
                'status' => AnswerConstantValues::CORRECT_ANSWER_TYPE,
            ];
        });
    }
}
