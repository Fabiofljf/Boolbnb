<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApartmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        return view('admin.apartment.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
        return view('admin.apartment.create');
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

        // Creazione della risorsa
        $new_apartment = Apartment::create($val_data);


        // Redirezionamento all'index admin
        return redirect()->route('admin.apartment.index')->with('message', 'Apartment Created Successfully');
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
            return view('admin.apartment.edit', compact('apartment'));
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
    public function update(ApartmentRequest $request, Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            $val_data = $request->validated();
            $visibility = $request->boolean('visibility');
            $val_data['visibility'] = $visibility;
            //ddd($visibility);
            $slug = Str::slug($request->title, '-');
            //dd($val_data);
            $val_data['slug'] = $slug;
            if ($request->hasFile('thumb')) {
                Storage::delete($apartment->thumb);
                $path = Storage::put('apartment_images', $request->thumb);
                $val_data['thumb'] = $path;
            }
            $apartment->update($val_data);
            return redirect()->route('admin.apartment.index');
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
            return redirect()->back()->with('message', "Apartment $apartment->title removed successfully");
        } else {
            dd('utente non autorizzato');
        }
    }
}