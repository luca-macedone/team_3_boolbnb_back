<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = config('apartments');
        foreach ($apartments as $apartment) {
            $new_apartment = new Apartment();
            $new_apartment->title = $apartment['title'];
            $new_apartment->slug = Apartment::generateSlug($new_apartment->title);
            $new_apartment->rooms = $apartment['rooms'];
            $new_apartment->beds = $apartment['beds'];
            $new_apartment->square_meters = $apartment['square_meters'];
            $new_apartment->bathrooms = $apartment['bathrooms'];
            $new_apartment->image = $apartment['image'];
            $new_apartment->latitude = $apartment['latitude'];
            $new_apartment->longitude = $apartment['longitude'];
            $new_apartment->full_address = $apartment['full_address'];
            $new_apartment->save();
        }
    }
}
