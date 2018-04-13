<?php

use App\Models\ReviewsImages;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ReviewsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        ReviewsImages::truncate();

        foreach (range(1, 5000) as $a) {
            ReviewsImages::create([
                'path' => $faker->firstNameMale . '.jpg',
                'review_id' => $faker->numberBetween(1,1000),
            ]);
        }
    }
}
