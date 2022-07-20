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
        <form action="{{ route('admin.apartment.update', $apartment->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Titolo -->
            <div class="mb-4">
                <label for="title">Titolo*</label>
                <input type="text" name="title" id="title"
                    class="form-control @error('title') is-invalid @enderror" placeholder="type title"
                    aria-describedby="titleHelper" value="{{ old('title', $apartment->title) }}">
                <small id="titleHelper" class="text-muted">Aggiungi il Titolo dell'appartamento, massimo 150
                    caratteri</small>
            </div>
            <!-- Thumb -->
            <div class="apartment-thumb">
                <img width='500' src="{{ asset('/storage/' . $apartment->thumb) }}"
                    alt="thumb of {{ $apartment->title }}">
            </div>
            <div class="mb-4">
                <label for="thumb">Immagine*</label>
                <input type="file" name="thumb" id="thumb"
                    class="form-control  @error('thumb') is-invalid @enderror" aria-describedby="thumbHelper"
                    value="{{ old('thumb', $apartment->thumb) }}">
                <small id="thumbHelper" class="text-muted">Aggiungi l'immagine dell'appartamento (formati accettati:
                    wpeg,jpg,jpeg,png || max: 2MB)</small>
            </div>

            {{-- search-box --}}
            <div id='map' class='map'></div>
            <div id="search-box"></div>
            <div class="my-3">
                <!-- Address -->
                <div class="my-3">
                    <label for="address">Indirizzo*</label>
                    <input type="text" name="address" id="address"
                        class="form-control  @error('address') is-invalid @enderror" placeholder="Add apartment address"
                        aria-describedby="addressHelper" value="{{ old('address', $apartment->address) }}" readonly>
                    <small id="addressHelper" class="text-muted">Aggiungi l'indirizzo dell'appartamento</small>
                </div>
                <input class="form-control" type="text" name="lat" id="lat"
                    value="{{ old('lat', $apartment->lat) }}" readonly>
                <label class="text-muted" for="lat">
                    Latitudine
                </label>
            </div>
            <div class="mb-3">
                <input class="form-control" type="text" name="lon" id="lon"
                    value="{{ old('lon', $apartment->lon) }}" readonly>
                <label class="text-muted" for="lon">
                    Longitudine
                </label>
            </div>

            <!-- Body -->
            <div class="mb-4">
                <label for="description">Descrizione</label>
                <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description"
                    rows="4">{{ old('description', $apartment->description) }}
            </textarea>
            </div>

            <!-- Details -->
            <div class="mb-3">
                <label for="rooms" class="form-label">Stanze</label>
                <input type="number" name="rooms" id="rooms" class="form-control" placeholder="5"
                    aria-describedby="roomsHelper" min=0 value="{{ old('rooms', $apartment->rooms) }}">
                <small id="roomsHelper" class="text-muted">Aggiungi il numero delle stanze dell'appartamento</small>
            </div>
            <div class="mb-3">
                <label for="baths" class="form-label">Bagni</label>
                <input type="number" name="baths" id="baths" class="form-control" placeholder="3"
                    aria-describedby="bedsHelper" min=0 value="{{ old('baths', $apartment->baths) }}">
                <small id="bedsHelper" class="text-muted">Aggiungi il numero dei bagni dell'appartamento</small>
            </div>
            <div class="mb-3">
                <label for="beds" class="form-label">Letti</label>
                <input type="number" name="beds" id="beds" class="form-control" placeholder="2"
                    aria-describedby="bedsHelper" min=0 value="{{ old('beds', $apartment->beds) }}">
                <small id="bedsHelper" class="text-muted">Aggiungi il numero dei posti letto dell'appartamento</small>
            </div>
            <div class="mb-3">
                <label for="sqm" class="form-label">Metri quadrati</label>
                <input type="number" name="sqm" id="sqm" class="form-control" placeholder="2"
                    aria-describedby="sqmHelper" min=0 value="{{ old('sqm', $apartment->sqm) }}">
                <small id="sqmHelper" class="text-muted">Aggiungi i metri quadrati dell'appartamento</small>
            </div>

            <div class="mb-4">
                <label for="tags" class="form-label m-0">Servizi</label>
                <select multiple class="form-select" name="services[]" id="services" aria-label="services">
                    <option value="" disabled>Modifica uno o più servizi</option>
                    @forelse ($services as $service)
                        @if ($errors->any())
                            <option value="{{ $service->id }}"
                                {{ in_array($service->id, old('services')) ? 'selected' : '' }}>{{ $service->name }}
                            </option>
                        @else
                            <option value="{{ $service->id }}"
                                {{ $apartment->services->contains($service->id) ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endif
                    @empty
                        <option value="">Non ci sono servizi</option>
                    @endforelse
                </select>
            </div>
            <!-- Visibility -->
            <div class="mb-3">
                <input class="form-check-input" type="radio" name="visibility" id="visibility"
                    {{ $apartment->visibility ? 'checked' : '' }} value="true">
                <label class="form-check-label" for="visibility">
                    Visibile
                </label>
            </div>
            <div class="mb-3">
                <input class="form-check-input" type="radio" name="visibility" id="visibility"
                    {{ !$apartment->visibility ? 'checked' : '' }} value="false">
                <label class="form-check-label" for="visibility">
                    Non visibile
                </label>
            </div>
            <button type="submit" class="btn btn-primary text-white">Conferma modifiche</button>
        </form>
    @endsection
