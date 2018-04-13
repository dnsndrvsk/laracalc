<?php

use App\Models\Reviews;
use Illuminate\Database\Seeder;
use Faker\Factory;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Reviews::truncate();

        foreach (range(1, 1000) as $a) {
            Reviews::create([
                'name' => $faker->firstNameMale,
                'contract' => $faker->uuid,
                'phone' => $faker->tollFreePhoneNumber,
                'title' => $faker->word,
                'desc' => $faker->realText($maxNbChars = 500, $indexSize = 2),
                'votes' => $faker->numberBetween(1,5),
                'created_at' => $faker->dateTimeBetween($startDate = '-30 weeks', $endDate = 'now', $timezone = null)
            ]);
        }
    }
}
