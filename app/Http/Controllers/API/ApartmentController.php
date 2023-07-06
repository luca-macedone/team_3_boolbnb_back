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
    public function index()
{
    $apartments = Apartment::with(['services','views','sponsorships'])->orderByDesc('id')->paginate(12);

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
        $apartment = Apartment::with(['services','views','sponsorships'])->where('slug', $slug)->first();
        dd($apartment);

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

   