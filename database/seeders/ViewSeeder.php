<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\View;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Faker\Generator as Fakers;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Fakers $faker)
    {
        $apartments = Apartment::all();

        $faker = Faker::create();

        foreach ($apartments as $apartment) {
            $startDate = Carbon::now()->subMonths(2); // Data di inizio delle visualizzazioni (1 mese fa)
            $endDate = Carbon::now()->subDays(1); // Data di fine delle visualizzazioni (1 giorno fa)

            // Genera il numero di visualizzazioni desiderato per l'appartamento
            $viewsCount = 170;

            $dates = collect();

            for ($i = 0; $i < $viewsCount; $i++) {
                $date = $faker->dateTimeBetween($startDate, $endDate);
                $dates->push($date);
            }

            $sortedDates = $dates->sort();

            foreach ($sortedDates as $date) {
                $view = [
                    "apartment_id" => $apartment->id,
                    "ip" => $faker->ipv4(),
                    "date" => $date,
                ];

                View::create($view);
            }
        }
    }
}
