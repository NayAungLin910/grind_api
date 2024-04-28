<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'courseId' => CourseFactory::class,
            'title' => fake()->title(),
            'description' => fake()->paragraph(),
            'image' =>  '/images/default_certificate_image.png',
        ];
    }
}
