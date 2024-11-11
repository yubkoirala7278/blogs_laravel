<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'AI',
            'Gadgets',
            'Software',
            'Fitness Tips',
            'Travel',
            'Personal Finance',
            'Investing',
            'Marketing',
            'Online Learning',
            'Movies',
            'Music',
            'Climate Change',
            'Parenting Tips',
            'Sustainability',
            'Cryptocurrency',
            'SEO',
            'Study Hacks',
            'Book Reviews',
            'Gaming',
            'Health Tech',
            'Recipes',
            'Skincare',
            'Mindfulness',
            'Yoga',
            'Photography Tips',
            'Pet Care',
            'Home Improvement',
            'Fashion Trends',
            'Adventure Travel',
            'History Facts'
        ];
        foreach ($tags as $tag) {
            Tag::create([
                'tag' => $tag,
            ]);
        }
    }
}
