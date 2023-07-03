<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new_user = new User();
        $new_user->name = 'Admin';
        $new_user->lastname = 'Admin';
        $new_user->email = 'admin@boolbnb.com';
        $new_user->password = Hash::make('adminpassword123!');
        $new_user->birthday = date_create();
        $new_user->save();
    }
}
