<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['Toilet Paper', null],
            ['Hand & Body Soap', null],
            ['Towels', null],
            ['Bed Linens', null],
            ['Pillows', null],
            ['Cleaning products', null],
            ['Pool', null],
            ['Wi-fi', null],
            ['Kitchen', null],
            ['Fridge', null],
            ['TV', null],
            ['Microwave', null],
            ['Parking', null],
            ['Jacuzzi', null],
            ['Washing Machine', null],
            ['Dryer', null],
            ['Self check-in', null],
            ['Pets Allowed', null],
            ['CO2 detector', null],
            ['Smoke detector', null],
            ['Fire Extinguisher', null],
            ['Aid Kit', null],
            ['Emergency numbers', null],
            ['Chimney', null],
            ['Heating', null],
            ['AC', null],
        ];
        foreach ($services as $service) {
            $newService = new Service();
            $newService->name = $service[0];
            $newService->description = $service[1];
            $newService->save();
        }
    }
}
