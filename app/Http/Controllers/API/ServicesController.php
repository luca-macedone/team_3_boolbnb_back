<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::all('id', 'name', 'description');

        if ($services) {
            return response()->json([
                'success' => true,
                'services' => $services,
            ]);
        }
    }
}
