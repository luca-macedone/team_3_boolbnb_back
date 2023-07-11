<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

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
        $left_lat = floatval($request->query('left_lat'));
        $right_lat = floatval($request->query('right_lat'));
        $left_lon = floatval($request->query('left_lon'));
        $right_lon = floatval($request->query('right_lon'));
        $rooms = $request->query('rooms');
        $beds = $request->query('beds');
        $services = $request->query('services');
        //$messages = $request->query('messages');

        $query = Apartment::query()->with('services');

        if (! empty($left_lat) && ! empty($left_lon) && ! empty($right_lat) && ! empty($right_lon)) {
            $query->whereBetween('latitude', [min($left_lat, $right_lat), max($left_lat, $right_lat)])->whereBetween('longitude', [min($left_lon, $right_lon), max($left_lon, $right_lon)]);
        }

        if (! empty($rooms)) {
            $query->where('rooms', '>', $rooms);
        }
        if (! empty($beds)) {
            $query->where('beds', '>', $beds);
        }

        if (! empty($services)) {
            $query->wherehas('services', function ($q) use ($services) {

                $q->whereIn('id', $services);

            });
        }

        $apartments = $query->get();

        return response()->json([
            'success' => true,
            'apartments' => $apartments,
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
        // dd(floatval($left_lat), $left_lon, $right_lat, $right_lon);
        $left_lat = floatval($left_lat);
        $right_lat = floatval($right_lat);
        $left_lon = floatval($left_lon);
        $right_lon = floatval($right_lon);

        // $apartments = Apartment::with(['services'])->whereBetween('latitude', [min($left_lat, $right_lat), max($left_lat, $right_lat)])->whereBetween('longitude', [min($left_lon, $right_lon), max($left_lon, $right_lon)])->orderByDesc('id')->get();
        // dd($apartments);
        $query = Apartment::query();

        if (! empty($value)) {
            $query->where('column', $value);
        }

        $query->get();

        return response()->json([
            'success' => true,
            'result' => $apartments,
        ]);
    }
}
