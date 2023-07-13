<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        // $user_id = Auth::user();
        $apartment = Auth::user()?->apartments()
            ->select('apartments.*', DB::raw('COUNT(views.id) as total_views'))
            ->leftJoin('views', 'apartments.id', '=', 'views.apartment_id')
            ->groupBy('apartments.id')
            ->orderBy('total_views', 'desc')
            ->first();
        /* dd($apartment); */

        $views=Auth::user()?->apartments()
        ->select('apartments.*', DB::raw('COUNT(views.id) as total_views'))
        ->leftJoin('views', 'apartments.id', '=', 'views.apartment_id')
        ->groupBy('apartments.id')
        ->orderBy('total_views', 'desc')
        ->get();

        $totalViewsSum = $views->sum('total_views');

        /* dd($totalViewsSum); */ 
        
        return view('user.dashboard', compact('apartment','views'));
    }

    public function front_office()
    {
        return redirect('http://localhost:5174/');
    }
}