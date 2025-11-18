<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            ['name' => 'Beaches', 'slug' => 'beaches', 'description' => 'Sandy beaches and coastal destinations.', 'is_active' => 1],
            ['name' => 'Mountains', 'slug' => 'mountains', 'description' => 'Highland and mountain getaways.', 'is_active' => 1],
            ['name' => 'Cities', 'slug' => 'cities', 'description' => 'Urban destinations, tours and stays.', 'is_active' => 1],
            ['name' => 'Adventure', 'slug' => 'adventure', 'description' => 'Adventure travel and activities.', 'is_active' => 1],
            ['name' => 'Family', 'slug' => 'family', 'description' => 'Family friendly trips and stays.', 'is_active' => 1],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->insert(array_merge($cat, ['created_at' => $now, 'updated_at' => $now]));
        }
    }
}
