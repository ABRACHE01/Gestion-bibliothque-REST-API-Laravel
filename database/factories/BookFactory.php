<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'isbn' => $this->faker->isbn13,
            'publisher' => $this->faker->company,
            'published_date' => $this->faker->date(),
            'description' => $this->faker->text,
            'page_count' => $this->faker->numberBetween(100, 1000),
            'language' => $this->faker->languageCode,
            'category_id' => \App\Models\Category::factory(),
            'user_id' => \App\Models\User::factory(),
            'image' => fake()->imageUrl(640, 480, 'books'),
            'status' => $this->faker->randomElement(['available', 'reserved', 'borrowed']),
        ];
    }
}
