<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValues;
use App\Models\ProductCategory;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductAttributeValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductAttributeValues::query()->delete();

        $products = Product::get();
        $attributes = ProductAttribute::get();
        $categoryIds = ProductCategory::pluck('id')->all();

        /** @var Generator $faker */
        $faker = app(Generator::class);
        $attributeIdsByCategoryId = [];

        foreach ($categoryIds as $categoryId) {
            $attributeIdsByCategoryId[$categoryId] = $faker->randomElements($attributes, rand(3,5));
        }

        foreach ($products as $product) {
            foreach ($attributeIdsByCategoryId[$product->product_category_id] as $attribute) {
                if ($faker->boolean(90)) {
                    ProductAttributeValues::factory()->setProduct($product->id)->setAttribute($attribute)->create();
                }
            }
        }
    }
}