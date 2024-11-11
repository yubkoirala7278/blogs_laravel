<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Lifestyle',
            'Finance',
            'Business',
            'Education',
            'Entertainment',
            'Environment',
            'Parenting',
            'Health & Fitness',
            'Travel',
            'Food & Cooking',
            'Fashion & Beauty',
            'DIY & Crafts',
            'Science',
            'Sports',
            'Automotive',
            'History',
            'Politics',
            'Pets & Animals',
            'Photography',
            'Relationships',
            'Spirituality',
            'Home & Garden'
        ];
        foreach ($categories as $category) {
           Category::create([
             'category'=>$category,
           ]);
        }
    }
}
