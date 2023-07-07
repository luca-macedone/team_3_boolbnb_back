<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user_data()
    {
        header('Access-Control-Allow-Origin: *');

        if (Auth::user()) {
            if (Auth::user()->name || Auth::user()->lastname) {
                $user_name = Auth::user()->name;
                $user_lastname = Auth::user()->lastname;

                return response()->json([
                    'success' => true,
                    'user' => [
                        'name' => $user_name,
                        'lastname' => $user_lastname,
                    ],
                ]);
            } else {
                $user_email = Auth::user()->email;

                return response()->json([
                    'success' => true,
                    'user' => [
                        'email' => $user_email,
                    ],
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'user' => null,
            ]);
        }
    }
}
