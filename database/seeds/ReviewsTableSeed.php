<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Reviews;

class ReviewsTableSeed  extends Seeder
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

        foreach (range(1, 100) as $a) {
            Reviews::create([
                'name' => $faker->name,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber
            ]);
        }
    }
}
