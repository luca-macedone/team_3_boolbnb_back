<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $messages = Message::where('apartment_id', $request['apartment_id'])->get();

        if ($messages->count() > 0) {
            return response()->json([
                'success' => true,
                'messages' => $messages,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'There are no messages for this apartment',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'message' => 'required',
            'name' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'apartment_id' => 'required|exists:apartments,id',
        ]);

        // Salva il messaggio nel database
        $message = Message::create([
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
            'name' => $validatedData['name'],
            'lastname' => $validatedData['lastname'],
            'apartment_id' => $validatedData['apartment_id'],
        ]);

        if ($message) {
            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully',
                'data' => $message,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Message not sent successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
