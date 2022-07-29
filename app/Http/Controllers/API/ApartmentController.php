<?php

namespace App\Http\Controllers\API;

use App\Models\Apartment;
use App\Models\Publicity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments =  Apartment::with(['services', 'user'])->orderByDesc('id')->get();
        return $apartments;
    }

    public function show($slug)
    {
        $apartment = Apartment::with(['services', 'user'])->where('slug', $slug)->first();
        if ($apartment) {
            return $apartment;
        } else {
            return response()->json([
                'status_code' => 404,
                'status_message' => 'Nothing found'
            ]);
        }
    }

    public function search(Request $request)
    {
        //Get values from query
        $lat = $request->get('lat');
        $lon = $request->get('lon');
        $radius = $request->get('radius');
        $rooms = $request->get('rooms');
        $baths = $request->get('baths');
        $beds = $request->get('beds');
        $selectedServices = $request->get('services');


        $apartments =  Apartment::with(['services', 'user'])
            ->where('rooms', '>=', $rooms)
            ->where('baths', '>=', $baths)
            ->where('beds', '>=', $beds)
            ->orderByDesc('id')
            ->get();

        $filteredApartments = [];

        if ( in_array("all",$selectedServices)) {
            $filteredApartments = $apartments;
        } else {
            foreach ($apartments as $apartment) {
                $services = $apartment->services;
                $servicesId = [];
                foreach ($services as $service) {
                    array_push($servicesId, $service->id);
                }
                if (count(array_diff($selectedServices, $servicesId)) === 0) {
                    array_push($filteredApartments, $apartment);
                }
            }

        }



        $apartmentList = [];

        //Set GeoInfo and Apartments JSON style for TomTom API
        $geometryList = [
            [
                'type' => 'CIRCLE',
                'position' => "$lat , $lon",
                'radius' => $radius,
            ]
        ];

        foreach ($filteredApartments as $apartment) {
            $apartmentArray = [
                'poi' => [
                    'name' => $apartment->title
                ],
                'address' => [
                    'freeformAddress' => $apartment->address
                ],
                'position' => [
                    'lat' => $apartment->lat,
                    'lon' => $apartment->lon,
                ],
                'info' => [
                    'id' => $apartment->id,
                ]
            ];
            array_push($apartmentList, $apartmentArray);
        };

        $geometryList = json_encode($geometryList);
        $apartmentList = json_encode($apartmentList);

        // Get data filtered from TomTom and save ids in an Array
        $responseTomTom = Http::get("https://api.tomtom.com/search/2/geometryFilter.json?&key=wwBjO0iyrGBDWYAR81J5EY7D4Y0HJGQj&geometryList=$geometryList&poiList=$apartmentList");

        $apartmentIds = [];
        $apartmentsFilteredArray = json_decode($responseTomTom);

        foreach ($apartmentsFilteredArray->results as $apartment) {

            array_push($apartmentIds, $apartment->info->id);
        }

        // Check if id is in Array of ids
        $response = Apartment::whereIn('id', $apartmentIds)->with(['services', 'user'])->orderByDesc('id')->get();

        return $response;
    }

    public function apartmentPublicity(Publicity $publicity) {
        $apartments = Apartment::whereHas('publicities')->orderByDesc('id')->get();
     
        return $apartments;
    }
}