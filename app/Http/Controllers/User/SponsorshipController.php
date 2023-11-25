<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\StoreSponsorshipRequest;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slug = $request->input('slug');
        $sponsorships = Sponsorship::all();
        $apartment_list = Auth::user()->apartments()->where('slug', $slug)->get();
        $apartment = $apartment_list->first();
        // dd($apartment);
        return view('user.sponsorships.index', compact(['sponsorships', 'apartment']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSponsorshipRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Returns the client Token for generate the payment method
     *
     * @return void
     */
    public function payment(Request $request, Gateway $gateway)
    {
        $apartment_id = $request->input('apartment_id');
        $sponsorship_id = $request->input('sponsorship_id');
        $sponsorship = Sponsorship::find($sponsorship_id);
        // $amount = $sponsorship->price;
        // dd($amount);
        // dd($apartment_id, $sponsorship_id);
        $clientToken = $gateway->clientToken()->generate();
        // echo ($clientToken);

        return view('user.sponsorships.payment', compact(['clientToken', 'apartment_id', 'sponsorship_id', 'sponsorship']));
    }

    /**
     * Handles the transaction and save the result inside the db
     *
     * @param Request $request
     * @param Gateway $gateway
     * @return void
     */
    public function transaction(Request $request, Gateway $gateway)
    {
        // dd($request);
        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'options' => ['submitForSettlement' => true],
        ]);
        // dd($result->message);
        if ($result->success) {
            $apartment_id = $request->apartment_id;
            $sponsorship_id = $request->sponsorship_id;
            $apartment = Apartment::find($apartment_id);
            $sponsorship = Sponsorship::find($sponsorship_id);
            // dd($interval);
            // dd($apartment, $sponsorship);

            $latest_sponsorization = DB::table('apartment_sponsorship')->where('apartment_id', $apartment->id)->orderByDesc('ending_date')->first();
            $latest_ending_date = null;

            if ($latest_sponsorization) {
                $latest_ending_date = $latest_sponsorization->ending_date;
            }

            $timestamp = Carbon::now()->format("Y-m-d H:i:s");

            if ($latest_ending_date && $latest_ending_date > $timestamp) {
                // dd('sono nell if');
                $ending_date__formatted = Carbon::createFromFormat("Y-m-d H:i:s", $latest_ending_date);
                $duration = $ending_date__formatted->addHours($sponsorship->duration)->format("Y-m-d H:i:s");
                $apartment->sponsorships()->attach($sponsorship, [
                    "starting_date" => $latest_ending_date,
                    "ending_date" => $duration,
                ]);
            } else {
                // dd('sono nell else');
                $duration = Carbon::now()->addHours($sponsorship->duration)->format("Y-m-d H:i:s");
                $apartment->sponsorships()->attach($sponsorship, [
                    "starting_date" => $timestamp,
                    "ending_date" => $duration,
                ]);
            }

            return to_route('user.apartments.show', $apartment->slug)->with('message', 'Apartment sponsored with success');
        }
        $apartment_id = $request->apartment_id;
        $apartment = Apartment::find($apartment_id);
        return to_route('user.apartments.show', ['apartment' => $apartment->slug])->withErrors(['error' => $result->message]);
    }
}
