<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'content' => $this->faker->paragraphs(3, true),
            'image' => 'blog1.png',
            'category_id' => Category::factory(),
            'user_id' => '1',
            'status' => $this->faker->randomElement(['0', '1']),
            'views' => $this->faker->numberBetween(0, 1000),
            'is_featured' => $this->faker->boolean(),
            'date' => $this->faker->date(),

        ];
    }
}
