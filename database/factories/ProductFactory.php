<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::pluck('id', 'name');
        $users = User::all();
        $phoneModels = [    
            "Nokia"=> 
            [ 
                "Nokia 9 PureView", "Nokia 8.3 5G", "Nokia 7.2", "Nokia 6.2", "Nokia 5.3", "Nokia 3.4", 
                "Nokia 2.4", "Nokia 1.4", "Nokia 5.4", "Nokia 3.2", "Nokia X20", "Nokia 5.5", "Nokia 4.4",
                "Nokia 2.2", "Nokia 8.1", "Nokia 7.1", "Nokia 6.1", "Nokia 6", "Nokia 5.2", "Nokia 5.1", 
                "Nokia 3.1", "Nokia 2.1"
            ],
            "Samsung"=> 
            [
                "Samsung Galaxy S23 Ultra", "Samsung Galaxy S23", "Samsung Galaxy S23 FE", "Samsung Galaxy S22 Ultra",
                "Samsung Galaxy S22", "Samsung Galaxy S22 FE", "Samsung Galaxy S21 Ultra", "Samsung Galaxy S21 FE",
                "Samsung Galaxy S20 FE", "Samsung Galaxy Note 20 Ultra", "Samsung Galaxy Z Fold 3", "Samsung Galaxy A52 5G",
                "Samsung Galaxy M51", "Samsung Galaxy Xcover Pro", "Samsung Galaxy A72", "Samsung Galaxy S10 Lite",
                "Samsung Galaxy A32", "Samsung Galaxy S21", "Samsung Galaxy S20", "Samsung Galaxy Note 20",
                "Samsung Galaxy Z Flip 3", "Samsung Galaxy A51", "Samsung Galaxy M31", "Samsung Galaxy Xcover FieldPro",
                "Samsung Galaxy S10", "Samsung Galaxy A31", "Samsung Galaxy S9"
            ],
            "Google Pixel"=> 
            [
                "Google Pixel 8 Pro", "Google Pixel 8a", "Google Pixel 8", "Google Pixel 7 Pro", "Google Pixel 7a",
                "Google Pixel 7", "Google Pixel 5", "Google Pixel 4a", "Google Pixel 4 XL", "Google Pixel 3a",
                "Google Pixel 3 XL", "Google Pixel 2", "Google Pixel 2 XL", "Google Pixel 3", "Google Pixel 4",
                "Google Pixel 4a 5G", "Google Pixel 6 Pro", "Google Pixel 6", "Google Pixel 5a", "Google Pixel 4a 5G UW"
            ],
            "OnePlus"=> 
            [
                "OnePlus 9 Pro", "OnePlus 9", "OnePlus 8T", "OnePlus Nord", "OnePlus 8 Pro", "OnePlus 8",
                "OnePlus Nord N200", "OnePlus 7T", "OnePlus 7 Pro", "OnePlus 6T", "OnePlus 10 Pro", "OnePlus 10",
                "OnePlus 9T", "OnePlus Nord 2", "OnePlus 8T+", "OnePlus 8 Pro", "OnePlus 7T Pro", "OnePlus 6T McLaren",
                "OnePlus 6", "OnePlus 5T"
            ],
            "Redmi"=> 
            [
                "Redmi Note 13 Pro Max", "Redmi Note 13 Pro", "Redmi Note 13", "Redmi Note 11 Pro Max",
                "Redmi Note 12 Pro", "Redmi Note 12", "Redmi Note 11 Pro", "Redmi Note 11", "Redmi Note 10 Pro",
                "Redmi Note 10", "Redmi Note 9 Pro", "Redmi Note 9", "Redmi 9 Power", "Redmi 9", "Redmi Note 8 Pro",
                "Redmi Note 8", "Redmi 9A", "Redmi 9 Prime", "Redmi Note 11", "Redmi Note 11 Pro", "Redmi Note 10S",
                "Redmi Note 9S", "Redmi 9T", "Redmi 9 Power", "Redmi 9C"
            ]

        ];

        $randomPhones = $phoneModels[array_rand($phoneModels)];
        $randomPhoneTitle = $randomPhones[array_rand($randomPhones)];

        
        $brand = collect($phoneModels)->filter(function ($models) use ($randomPhoneTitle) {
            return in_array($randomPhoneTitle, $models);
        })->keys()->first();

        $categoryId = $categories[$brand] ?? null;

        if ($categoryId == null) {
            $categoryId = 2;
        }

        return [
            'category_id' => $categoryId,
            'title' => $randomPhoneTitle,
            'price' => fake()->randomFloat(2, 1000, 100000),
            'image' => 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg?text=' . urlencode($randomPhoneTitle),
            'description' => fake()->paragraph,
            'status' => fake()->numberBetween(0, 1),
            'created_by' => 1,
            'updated_by' => 1,
            'slug' => Str::slug($randomPhoneTitle),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'), 
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now'), 
        ];
    }
}
