<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\View;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartmentIds = Apartment::pluck('id')->toArray();

        for ($i = 0; $i < 5000; $i++) {
            $apartmentId = $apartmentIds[array_rand($apartmentIds)];

            $view = [
                "apartment_id" => $apartmentId,
                "ip" => $faker->ipv4(),
                "date" => $faker->dateTimeBetween('-1 months', '-1 days'),
            ];

            View::create($view);
        }
    }
}
