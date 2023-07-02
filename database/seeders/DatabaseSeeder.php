<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            ServiceSeeder::class,
            SponsorshipSeeder::class,
            // ! add user seeder for add default apartments to one premade user
            ApartmentSeeder::class,
            MessageSeeder::class,
            ViewSeeder::class,
        ]);
    }
}
