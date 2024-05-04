<?php

namespace Database\Factories;

use App\ConstantValues\StepConstantValues;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Step>
 */
class StepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sectionId' => Section::factory(),
            'type' => StepConstantValues::READING_TYPE,
            'title' => fake()->title(),
            'video' => null,
            'description' => fake()->paragraph(),
            'readingContent' => fake()->paragraph(),
            'timeGiven' => null,
        ];
    }

    /**
     * Indicate that the step's type should be reading
     *
     * @return static
     */
    public function reading()
    {
        return $this->state(fn (array $attributes) => [
            'type' => StepConstantValues::READING_TYPE,
            'video' => null,
            'readingContent' => fake()->paragraph(),
        ]);
    }

    /**
     * Indicates that the step's type should be video
     *
     * @return static
     */
    public function video()
    {
        return $this->state(fn (array $attributes) => [
            'type' => StepConstantValues::VIDEO_TYPE,
            'video' => '/default/videos/default_course_video.mp4',
            'readingContent' => null,
        ]);
    }

    /**
     * Indicates that the step's type should be quiz
     *
     * @return static
     */
    public function quiz()
    {
        return $this->state(function(array $attbitues) {
            return [
                'type' => StepConstantValues::QUIZ_TYPE,
                'video' => null,
                'readingContent' => null,
                'timeGiven' => Carbon::now()->toDateTimeString(),
            ];
        });
    }
}
