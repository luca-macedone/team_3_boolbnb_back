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
        $generic_search = $request->query('generic_search') == 'true' ? true : false;
        $left_lat = floatval($request->query('left_lat'));
        $right_lat = floatval($request->query('right_lat'));
        $left_lon = floatval($request->query('left_lon'));
        $right_lon = floatval($request->query('right_lon'));
        $rooms = $request->query('rooms');
        $beds = $request->query('beds');
        $services = $request->query('services');
        //$messages = $request->query('messages');

        $query = Apartment::query()->with('services');
        if ($generic_search) {
            $query->where('id', '>', 0)->orderByDesc('id');
        } else {
            if (! empty($left_lat) && ! empty($left_lon) && ! empty($right_lat) && ! empty($right_lon)) {
                $query->whereBetween('latitude', [min($left_lat, $right_lat), max($left_lat, $right_lat)])->whereBetween('longitude', [min($left_lon, $right_lon), max($left_lon, $right_lon)]);
            }

            if (! empty($rooms)) {
                $query->where('rooms', '>=', $rooms);
            }
            if (! empty($beds)) {
                $query->where('beds', '>=', $beds);
            }

            if (! empty($services)) {
                $query->wherehas('services', function ($q) use ($services) {

                    $q->whereIn('id', $services);

                });
            }
        }

        $apartments = $query->paginate(12);

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
}
