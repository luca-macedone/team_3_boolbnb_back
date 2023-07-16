<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $apartments = Apartment::with(['services', 'views', 'sponsorships'])->orderByDesc('id')->paginate(12);
        // $apartments = Apartment::with(['services'])->orderByDesc('id')->paginate(12);
        // dd($apartments);
        $generic_search = $request->query('generic_search') == 'true' ? true : false;
        $searched_lat = floatval($request->query('searched_lat'));
        $searched_lon = floatval($request->query('searched_lon'));
        $rooms = $request->query('rooms');
        $beds = $request->query('beds');
        $services = $request->query('services');
        $radius = $request->query('radius');
        $result_apartments = [];
        //$messages = $request->query('messages');

        $timestamp = Carbon::now()->format("Y-m-d H:i:s");

        $query = Apartment::query()->with('services');

        if ($generic_search) {
            $result_apartments = $query
                ->join('apartment_sponsorship', 'id', '=', 'apartment_sponsorship.apartment_id')
                ->where('ending_date', '>', $timestamp)
                ->groupBy('apartments.id')
                ->select('apartments.*')
                ->get();
        } else {
            $query
                ->leftJoin('apartment_sponsorship', 'apartments.id', '=', 'apartment_sponsorship.apartment_id')
                ->where(function ($query) use ($timestamp) {
                    $query->whereNull('apartment_sponsorship.apartment_id')
                        ->orWhere('apartment_sponsorship.ending_date', '>', $timestamp);
                })
                ->groupBy('apartments.id')
                ->select('apartments.*')
                ->orderByRaw('CASE WHEN apartment_sponsorship.apartment_id IS NOT NULL THEN 0 ELSE 1 END');
            // ->whereBetween('latitude', [min($left_lat, $right_lat), max($left_lat, $right_lat)])
            // ->whereBetween('longitude', [min($left_lon, $right_lon), max($left_lon, $right_lon)]);

            if (!empty($rooms)) {
                $query->where('rooms', '>=', $rooms);
            }
            if (!empty($beds)) {
                $query->where('beds', '>=', $beds);
            }

            if (!empty($services)) {
                $query->wherehas('services', function ($q) use ($services) {

                    $q->whereIn('id', $services);
                });
            }
        }
        $apartments = $query->get();
        // $apartments = $query->paginate(12);
        // dd($apartments);

        foreach ($apartments as $apartment) {
            $apartment_lat = $apartment->latitude;
            $apartment_lon = $apartment->longitude;
            $formatted_radius = intval($radius);
            $distance = ApartmentController::calculateCoordinates($searched_lat, $searched_lon, $apartment_lat, $apartment_lon);
            // dd($distance, $formatted_radius);
            if ($distance <= $formatted_radius) {
                $apartment->distance_from_point = $distance;
                array_push($result_apartments, $apartment);
            }
        }

        return response()->json([
            'success' => true,
            'apartments' => $result_apartments,
            'sql' => $query->toSql(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // $apartment = Apartment::with(['services', 'views', 'sponsorships'])->where('slug', $slug)->first();
        // dd($apartment);
        $apartment = Apartment::with(['services'])->where('slug', $slug)->get();
        // dd($apartment);

        if ($apartment) {

            return response()->json([
                'success' => true,
                'result' => $apartment,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'apartment not found 404',
            ]);
        }
    }

    public static function calculateCoordinates($serLat, $serLon, $aptLat, $aptLon)
    {
        $serLat *= pi() / 180;
        $serLon *= pi() / 180;
        $aptLat *= pi() / 180;
        $aptLon *= pi() / 180;

        $diffLat = $serLat - $aptLat;
        $diffLon = $serLon - $aptLon;

        $a = pow(sin($diffLat / 2), 2) + cos($serLat) * cos($aptLat) * pow(sin($diffLon / 2), 2);
        $c = 2 * asin(sqrt($a));

        $radius = 6371;

        return ($c * $radius);
    }
    public function all()
    {
        $apartments = Apartment::all();
        if ($apartments) {

            return response()->json([
                'success' => true,
                'result' => $apartments,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'apartments not found 404',
            ]);
        }
    }

}
