<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApartmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where(('user_id'), Auth::user()->id)->orderByDesc('id')->get();
        $services = Service::all();
        return view('admin.apartment.index', compact('apartments', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartment.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentRequest $request)
    {
        $user_id = Auth::id();

        // Validazione dati
        $val_data = $request->validated();
        $visibility = $request->boolean('visibility');
        $val_data['visibility'] = $visibility;

        // Generazione dello slug
        $slug = Apartment::generateSlug($request->title);
        $val_data['slug'] = $slug;
        $val_data['user_id'] = $user_id;
        //ddd($val_data);

        /* thumb */
        if ($request->hasFile('thumb')) {
            $path = Storage::put('apartment_images', $request->thumb);
            $val_data['thumb'] = $path;
        }

        /* Address & coordinate */

        $val_data['lat'] = $request->lat;
        $val_data['lon'] = $request->lon;




        // Creazione della risorsa
        $new_apartment = Apartment::create($val_data);
        $new_apartment->services()->attach($request->services);


        // Redirezionamento all'index admin
        return redirect()->route('admin.apartment.index')->with('message', "Appartamento creato con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            return view('admin.apartment.show', compact('apartment'));
        } else {
            dd('utente non autorizzato');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            $services = Service::all();
            return view('admin.apartment.edit', compact('apartment', 'services'));
        } else {
            dd('utente non autorizzato');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            if ($request->hasFile('thumb')) {
                //dd("immagine si");
                $val_data = $request->validate(
                    [
                        'title' => ['required', Rule::unique('apartments')->ignore($apartment), 'max:150'],
                        'thumb' => ['required', 'image', 'max:2024'],
                        'address' => 'required',
                        'description' => 'nullable',
                        'rooms' => 'integer|nullable|between:1,20',
                        'beds' => 'integer|nullable|between:1,20',
                        'baths' => 'integer|nullable|between:1,30',
                        'sqm' => 'integer|nullable|between:1,10000',
                        'visibility' => 'nullable',
                        'lat' => 'required|numeric',
                        'lon' => 'required|numeric',
                    ]
                );
                Storage::delete($apartment->thumb);
                $path = Storage::put('apartment_images', $request->thumb);
                $val_data['thumb'] = $path;
            } else {
                //dd("immagine no");
                $val_data = $request->validate(
                    [
                        'title' => ['required', Rule::unique('apartments')->ignore($apartment), 'max:150'],
                        'address' => 'required',
                        'description' => 'nullable',
                        'rooms' => 'integer|nullable|between:1,20',
                        'beds' => 'integer|nullable|between:1,20',
                        'baths' => 'integer|nullable|between:1,30',
                        'sqm' => 'integer|nullable|between:1,10000',
                        'visibility' => 'nullable',
                        'lat' => 'required|numeric',
                        'lon' => 'required|numeric',
                    ]
                );
            }
            $visibility = $request->boolean('visibility');
            $val_data['visibility'] = $visibility;
            //ddd($visibility);
            $slug = Str::slug($request->title, '-');
            //dd($val_data);
            $val_data['slug'] = $slug;
            $val_data['lat'] = $request->lat;
            $val_data['lon'] = $request->lon;

            $apartment->update($val_data);
            $apartment->services()->sync($request->services);
            return redirect()->route('admin.apartment.index')->with('message', "Appartamento \"$apartment->title\" modificato con successo");
        } else {
            dd('utente non autorizzato');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            if ($apartment->thumb) {
                Storage::delete($apartment->thumb);
            };
            $apartment->delete();
            return redirect()->back()->with('message', "Appartamento \"$apartment->title\" eliminato con successo");
        } else {
            dd('utente non autorizzato');
        }
    }
}