<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Message;


class DashboardController extends Controller
{
    public function index()
    {
        // $user_id = Auth::user();
        $mostRelevant = Auth::user()?->apartments()
            ->select('apartments.*', DB::raw('COUNT(views.id) as total_views'))
            ->leftJoin('views', 'apartments.id', '=', 'views.apartment_id')
            ->groupBy('apartments.id')
            ->orderBy('total_views', 'desc')
            ->first();
        /* dd($mostRelevant); */

        $views=Auth::user()?->apartments()
            ->select('apartments.*', DB::raw('COUNT(views.id) as total_views'))
            ->leftJoin('views', 'apartments.id', '=', 'views.apartment_id')
            ->groupBy('apartments.id')
            ->orderBy('total_views', 'desc')
            ->get();

        $totalViewsSum = $views->sum('total_views');
        $mediumView = round($totalViewsSum / $mostRelevant->count());

        $apartments = Auth::user()->apartments()->orderByDesc('id')->get();
        $messages_count = [];
        $messages_sum = 0;
        foreach ($apartments as $apartment)
        {
            $message = Message::where('apartment_id', $apartment->id)->where('is_read', 0)->count();
            $messages_sum = $message + $messages_sum;
            array_push($messages_count, $message);

        }
        return view('user.dashboard', compact('mostRelevant','totalViewsSum','mediumView', 'apartments', 'messages_count', 'messages_sum'));
    }

    public function front_office()
    {
        return redirect('http://localhost:5174/');
    }
}