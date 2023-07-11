<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {

        $user = Auth::user();
        $apartment = Apartment::where('slug', $slug)->get();

        $messages = $apartment[0]->messages;
        return view('user.messages.index', compact('messages'));
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
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        /* $val_data = $request->validated();
    $message = Message::create();
    $message->fill($val_data);
    $message->save();
    return view('user.messages.show', compact('message')); */

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {

        return view('user.messages.show', compact('message'));

        /*    $user = Auth::user();
    if ($user->id === $message->apartment_id->user_id) {
    return view('user.messages.show', compact('message'));
    }
    abort(403); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {

        $apartmentId = $message->apartment_id;
        $slug = Apartment::find($apartmentId)->slug;
        $message->delete();

        return to_route('user.messages.index', compact('slug'))->with('message', 'Message deleted');
    }

}
