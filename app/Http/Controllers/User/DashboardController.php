<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function front_office()
    {
        return redirect('http://localhost:5174/');
    }
}
