<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreViewRequest;
use App\Http\Requests\UpdateViewRequest;
use App\Models\Apartment;
use App\Models\View;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {

        //dd($slug);

        $apartment = Apartment::where('slug', $slug)->first();

        if (!$apartment) {
            abort(404); // Appartamento non trovato
        }

        $views = View::where('apartment_id', $apartment->id)->get();
        $apartments = Apartment::all();

        return view('user.views.index', compact('views', 'apartment', 'apartments', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreViewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreViewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\View  $view
     * @return \Illuminate\Http\Response
     */
    public function show(View $view)
    {
        $user = Auth::user();
        $view = View::where('apartment_id->user_id', '=', $user->id)->get();
        return view('user.views.show', compact('view'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\View  $view
     * @return \Illuminate\Http\Response
     */
    public function edit(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateViewRequest  $request
     * @param  \App\Models\View  $view
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateViewRequest $request, View $view)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\View  $view
     * @return \Illuminate\Http\Response
     */
    public function destroy(View $view)
    {

    }
}
