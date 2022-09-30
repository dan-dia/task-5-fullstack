<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(),
            "category_id" => $this->faker->numberBetween(1, 20),
            "user_id" => $this->faker->numberBetween(1, 6),
            "image" => $this->faker->image(null, 450, 300),
            "content" => $this->faker->paragraphs(6, true)
        ];
    }
}
