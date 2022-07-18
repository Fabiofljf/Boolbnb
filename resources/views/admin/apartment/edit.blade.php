@extends('layouts.app')
@section('content')
<div class="container">
    <h5 class="pt-4">Modifica appartamento</h5>
    <h2 class="pb-4">"{{ $apartment->title }}"</h2>
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('admin.apartment.update', $apartment->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title">Titolo*</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="type title" aria-describedby="titleHelper" value="{{ old('title', $apartment->title) }}">
            <small id="titleHelper" class="text-muted">Aggiungi il Titolo dell'appartamento, massimo 150 caratteri</small>
        </div>
        <div class="mb-4">
            <label for="thumb">Immagine*</label>
            <input type="text" name="thumb" id="thumb" class="form-control  @error('thumb') is-invalid @enderror" aria-describedby="thumbHelper" value="{{ old('thumb', $apartment->thumb) }}">
            <small id="thumbHelper" class="text-muted">Aggiungi l'immagine dell'appartamento</small>
        </div>

        <!-- In questo punto andrà inserito il campo address che l'utente dovrà inserire. Dobbiamo verificare il modo in cui attraverso questo dato, con la chiamata Api otteniamo lat e long -->
        <div class="mb-4">
            <label for="address">Indirizzo*</label>
            <input type="text" name="address" id="address" class="form-control  @error('address') is-invalid @enderror" placeholder="Add apartment address" aria-describedby="addressHelper" value="{{ old('address', $apartment->address) }}">
            <small id="addressHelper" class="text-muted">Aggiungi l'indirizzo dell'appartamento</small>
        </div>


        <div class="mb-4">
            <label for="description">Descrizione</label>
            <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ old('description', $apartment->description) }}
            </textarea>
        </div>
        <div class="mb-3">
            <label for="rooms" class="form-label">Stanze</label>
            <input type="number" name="rooms" id="rooms" class="form-control" placeholder="5" aria-describedby="roomsHelper" value="{{ old('rooms', $apartment->rooms) }}">
            <small id="roomsHelper" class="text-muted">Aggiungi il numero delle stanze dell'appartamento</small>
        </div>
        <div class="mb-3">
            <label for="baths" class="form-label">Bagni</label>
            <input type="number" name="baths" id="baths" class="form-control" placeholder="3" aria-describedby="bedsHelper" value="{{ old('baths', $apartment->baths) }}">
            <small id="bedsHelper" class="text-muted">Aggiungi il numero dei bagni dell'appartamento</small>
        </div>
        <div class="mb-3">
            <label for="beds" class="form-label">Letti</label>
            <input type="number" name="beds" id="beds" class="form-control" placeholder="2" aria-describedby="bedsHelper" value="{{ old('beds', $apartment->beds) }}">
            <small id="bedsHelper" class="text-muted">Aggiungi il numero dei posti letto dell'appartamento</small>
        </div>
        <div class="mb-3">
            <label for="sqm" class="form-label">Metri quadrati</label>
            <input type="number" name="sqm" id="sqm" class="form-control" placeholder="2" aria-describedby="sqmHelper" value="{{ old('sqm', $apartment->sqm) }}">
            <small id="sqmHelper" class="text-muted">Aggiungi i metri quadrati dell'appartamento</small>
        </div>
        <div class="mb-3">
            <input class="form-check-input" type="radio" name="visibility" id="visibility" {{ $apartment->visibility ? 'checked' : '' }} value="true">
            <label class="form-check-label" for="visibility">
                Visibile
            </label>
        </div>
        <div class="mb-3">
            <input class="form-check-input" type="radio" name="visibility" id="visibility" {{ !$apartment->visibility ? 'checked' : '' }} value="false">
            <label class="form-check-label" for="visibility">
                Non visibile
            </label>
        </div>
        <button type="submit" class="btn btn-primary text-white">Conferma modifiche</button>
    </form>
    @endsection