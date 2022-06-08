<?php

namespace Database\Factories;

use App\Enums\ProductAttributeType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttribute>
 */
class ProductAttributeFactory extends Factory
{

    private $sortOrder = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->randomElement(array_values(ProductAttributeType::getConstants())),
            'sort_order' => $this->sortOrder++,
        ];
    }
}