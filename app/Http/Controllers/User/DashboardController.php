<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
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

        $views = Auth::user()?->apartments()
            ->select('apartments.*', DB::raw('COUNT(views.id) as total_views'))
            ->leftJoin('views', 'apartments.id', '=', 'views.apartment_id')
            ->groupBy('apartments.id')
            ->orderBy('total_views', 'desc')
            ->get();

        $totalViewsSum = $views->sum('total_views');
        if ($apartment) {
            $mediumView = $apartment->count() > 0 ? round($totalViewsSum / $apartment->count()) : 0;
        } else {
            $mediumView = 0;
        }

        $apartments = Auth::user()->apartments()->orderByDesc('id')->get();
        $messages_count = [];
        $messages_sum = 0;
        foreach ($apartments as $apartment) {
            $message = Message::where('apartment_id', $apartment->id)->where('is_read', 0)->count();
            $messages_sum = $message + $messages_sum;
            array_push($messages_count, $message);

        }

        //dd($mediumView);
        return view('user.dashboard', compact('apartment', 'totalViewsSum', 'mediumView', 'apartments', 'messages_count', 'messages_sum'));
    }

    public function front_office()
    {
        return redirect('http://localhost:5174/');
    }
}
