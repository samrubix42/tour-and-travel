<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Destination;
use App\Models\HotelCategory;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $destinationIds = Destination::pluck('id')->toArray();
        $categoryIds = HotelCategory::pluck('id')->toArray();

        if (empty($destinationIds) || empty($categoryIds)) {
            // nothing to seed against
            return;
        }

        for ($i = 0; $i < 30; $i++) {
            $name = $faker->company . ' Hotel';
            Hotel::create([
                'category_id' => $faker->randomElement($categoryIds),
                'destination_id' => $faker->randomElement($destinationIds),
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(4),
                'address' => $faker->address,
                'rating' => $faker->randomFloat(1, 3, 5),
                'description' => '<p>' . implode('</p><p>', $faker->paragraphs(3)) . '</p>',
                'image' => 'https://placehold.co/800x600',
                'status' => 1,
            ]);
        }
    }
}
