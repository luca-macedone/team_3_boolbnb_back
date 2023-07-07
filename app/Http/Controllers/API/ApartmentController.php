<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Apartment;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $apartments = Apartment::with(['services', 'views', 'sponsorships'])->orderByDesc('id')->paginate(12);
        $apartments = Apartment::with(['services'])->orderByDesc('id')->paginate(12);
        // dd($apartments);

        return response()->json([
            'success' => true,
            'apartments' => $apartments,
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

    /**
     * Return all the apartments inside a given range
     *
     * @param  string  $left_lat max_latitude
     * @param  string  $left_lon max_longitude
     * @param  string  $right_lat min_latitude
     * @param  string  $right_lon min_longitude
     * @return void
     */
    public function concerned_list($left_lat, $left_lon, $right_lat, $right_lon)
    {
        // Apartment::where('longitude' > $min_longitude, AND, 'latitude' > $min_latitude, OR, 'longitude' < $max_longitude, AND, 'latitude' < $max_latitude)->orderByDesc('sponsorship_expiration_date')->paginate('18')
        $apartments = Apartment::with(['services'])->whereBetween('latitude', [$left_lat, $right_lat])->whereBetween('longitude', [$left_lon, $right_lon])->orderByDesc('id')->get();
        // dd($apartments);

        return response()->json([
            'success' => true,
            'result' => $apartments,
        ]);
    }
}
