<?php

namespace App\Http\Controllers\API;

use App\Models\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments =  Apartment::with(['services','user'])->orderByDesc('id')->get();
        return $apartments;
    }

    public function show($slug)
    {
        $card = Apartment::with(['services','user'])->where('slug', $slug)->first();
        if ($card){
            return $card;
        }else {
            return response()->json ([
                'status_code' => 404,
                'status_message' => 'Nothing found'
            ]);
        }
    }
}
