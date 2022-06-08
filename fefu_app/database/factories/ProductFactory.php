<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    private $categoryIds;

    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, ?Collection $connection = null)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking,  $afterCreating, $connection);
        $this->categoryIds = ProductCategory::pluck('id')->all();
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->realText(),
            'price' => $this->faker->randomFloat(8, 100, 1000000),
            'product_category_id' => $this->faker->randomElement($this->categoryIds),
        ];
    }
}