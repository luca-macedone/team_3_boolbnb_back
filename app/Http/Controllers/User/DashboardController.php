<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $user_id = Auth::user();
        $apartment = Auth::user()?->apartments()->first();

        // dd($apartment);

        return view('user.dashboard', compact('apartment'));
    }

    public function front_office()
    {
        return redirect('http://localhost:5174/');
    }
}
