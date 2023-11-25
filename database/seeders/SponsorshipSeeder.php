<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = [
            [
                "name" => "Bronze",
                "description" => "",
                "duration" => 24,
                "price" => 2.99,
            ],
            [
                "name" => "Silver",
                "description" => "",
                "duration" => 72,
                "price" => 5.99,
            ],
            [
                "name" => "Gold",
                "description" => "",
                "duration" => 144,
                "price" => 9.99,
            ],
        ];

        foreach ($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship();
            $newSponsorship->name = $sponsorship['name'];
            $newSponsorship->description = $sponsorship['description'];
            $newSponsorship->duration = $sponsorship['duration'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->save();
        }

    }
}
