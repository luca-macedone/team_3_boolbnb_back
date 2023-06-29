<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'Toilet Paper',
            'Hand & Body Soap',
            'Towels',
            'Bed Linens',
            'Pillows',
            'Cleaning products',
            'Pool',
            'Wi-fi',
            'Kitchen',
            'Fridge',
            'TV',
            'Microwave',
            'Parking',
            'Jacuzzi',
            'Washing Machine',
            'Dryer',
            'Self check-in',
            'Pets Allowed',
            'CO2 detector',
            'Smoke detector',
            'Fire Extinguisher',
            'Aid Kit',
            'Emergency numbers',
            'Chimney',
            'Heating',
            'AC'
        ];
        foreach ($services as $service){
            $newService = New Service();
            $newService -> name = $Service[0];
            $newService -> description = $Service[1];
            $newService -> save();
        }
    }
}
