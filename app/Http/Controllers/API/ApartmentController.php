<?php

namespace App\Http\Controllers\API;

use App\Models\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        return Apartment::with(['publicity','service'])->orderByDesc('id')->paginate(5);
    }
    public function show($slug)
    {
        $card = Apartment::with(['publicity','service'])->where('slug', $slug)->first();
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
