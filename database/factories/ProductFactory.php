<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'name'        => Str::title($name),
            'slug'        => Str::slug($name).'-'.Str::lower(Str::random(6)),
            'description' => $this->faker->paragraph(),
            'price'       => $this->faker->numberBetween(75000, 750000),
            'image_url'   => 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?q=80&w=1200&auto=format',
            'stock'       => $this->faker->numberBetween(5, 100),
        ];
    }
}

