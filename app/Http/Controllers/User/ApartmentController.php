<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Auth::user()->apartments()->orderByDesc('id')->paginate(12);
        // dd($apartments);

        return view('user.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::user()) {
            $services = Service::all();
            return view('user.apartments.create', compact('services'));
        } else {
            abort(403);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        // $request['visibility'] = boolValue($request->visibility);
        // dd($request);

        $val_data = $request->validated();

        $response = Http::get("https://api.tomtom.com/search/2/search/$request->full_address.json?key=" . env('TOMTOMAPIKEY') . '&countrySet=ITA&radius=20000');
        $json_data = $response->json();
        // dd($json_data);
        $val_data['latitude'] = $json_data['results'][0]['position']['lat'];
        $val_data['longitude'] = $json_data['results'][0]['position']['lon'];

        if ($request->hasFile('image')) {
            $img_path = Storage::disk('public')->put('uploads', $request->image);
            //dd($img_path);
            $val_data['image'] = $img_path;
        }

        $val_data['slug'] = Apartment::generateSlug($val_data['title']);

        $val_data['user_id'] = Auth::id();

        $new_apartment = Apartment::create($val_data);
        // dd($new_apartment);

        if ($request->has('services')) {
            $new_apartment->services()->attach($request->services);
        }

        // dd($new_apartment);

        // if ($request['services']) {
        //     $newApartment->services()->attach($val_data['services']);
        // }

        // dd($val_data);

        return to_route('user.apartments.index')->with('message', 'Apartment created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            return view('user.apartments.show', compact('apartment'));
        }
        abort(403);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();

        if (Auth::id() === $apartment->user_id) {
            return view('user.apartments.edit', compact(['apartment', 'services']));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        // $request['visibility'] = boolValue($request->visibility);
        // dd($request);

        $val_data = $request->validated();

        $response = Http::get("https://api.tomtom.com/search/2/search/$request->full_address.json?key=" . env('TOMTOMAPIKEY') . '&countrySet=ITA&radius=20000');
        $json_data = $response->json();
        // dd($json_data);
        $val_data['latitude'] = $json_data['results'][0]['position']['lat'];
        $val_data['longitude'] = $json_data['results'][0]['position']['lon'];

        if ($request->hasFile('image')) {
            if ($apartment->image) {
                Storage::delete($apartment->image);
            }

            $img_path = Storage::put('uploads', $request->image);
            $val_data['image'] = $img_path;
        }

        $val_data['slug'] = Apartment::generateSlug($val_data['title']);

        $apartment->update($val_data);
        // dd($new_apartment);

        if ($request->has('services')) {
            $apartment->services()->sync($request->services);
        }

        return to_route('user.apartments.index')->with('message', 'Apartment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return to_route('user.apartments.index')->with('message', 'Apartment deleted with success');
    }
}
