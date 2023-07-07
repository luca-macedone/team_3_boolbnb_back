<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // public function user_data()
    // {
    //     if (Auth::check()) {
    //         $user = Auth::getUser();
    //     }

    //     $user_id = Auth::id();
    //     $user = User::where('id', $user_id)->get();
    //     // dd($user_id);

    //     if ($user_id) {
    //         if ($user->name || $user->lastname) {

    //             return response()->json([
    //                 'success' => true,
    //                 'user' => [
    //                     'name' => $user->name,
    //                     'lastname' => $user->lastname,
    //                 ],
    //             ]);
    //         } else {

    //             return response()->json([
    //                 'success' => true,
    //                 'user' => [
    //                     'email' => $user->email,
    //                 ],
    //             ]);
    //         }
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'user' => null,
    //         ]);
    //     }
    // }
}
