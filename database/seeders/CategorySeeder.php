<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = ['Nokia', 'Google', 'Samsung', 'OnePlus', 'Redmi'];

        foreach ($companies as $company) {
            Category::create([
                'name' => $company,
                'slug'=> Str::slug($company),
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
