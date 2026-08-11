<?php

namespace Database\Seeders;

use App\Models\FeedbackCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackCategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the feedback categories.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'General Experience', 'slug' => 'general-experience', 'icon' => 'document', 'sort_order' => 1],
            ['name' => 'Exhibit Quality', 'slug' => 'exhibit-quality', 'icon' => 'sparkles', 'sort_order' => 2],
            ['name' => 'Staff & Service', 'slug' => 'staff-service', 'icon' => 'chat', 'sort_order' => 3],
            ['name' => 'Suggestions', 'slug' => 'suggestions', 'icon' => 'bulb', 'sort_order' => 4],
        ];

        foreach ($categories as $category) {
            FeedbackCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
