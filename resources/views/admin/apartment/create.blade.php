@extends('layouts.app')

@section('content')
    <h2 class="py-4">Aggiungi nuovo appartamento</h2>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.apartment.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <!-- Titolo -->
        <div class="mb-4">
            <label for="title">Titolo*</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                placeholder="Appartamento con Soffitto Affrescato Vista Mare" required aria-describedby="titleHelper"
                value="{{ old('title') }}">
            <small id="titleHelper" class="text-muted">Aggiungi il Titolo dell'appartamento, massimo 150 caratteri</small>
        </div>

        <!-- Thumb -->
        <div class="mb-4">
            <label for="thumb">Immagine*</label>
            <input type="file" name="thumb" id="thumb" class="form-control  @error('thumb') is-invalid @enderror"
                required aria-describedby="thumbHelper">
            <small id="thumbHelper" class="text-muted">Aggiungi l'immagine dell'appartamento (formati accettati:
                wpeg,jpg,jpeg,png || max: 2MB)</small>
        </div>

        <!-- In questo punto andrà inserito il campo address che l'utente dovrà inserire. Dobbiamo verificare il modo in cui attraverso questo dato, con la chiamata Api otteniamo lat e long -->
        {{-- search-box --}}
        <div id="map" style="height:600px"></div>
        <div id="search-box"></div>
        <div class="my-3">
            <label for="address">Indirizzo*</label>
            <input type="text" name="address" id="address" class="form-control  @error('address') is-invalid @enderror"
                required placeholder="Via Stazione 25, 40048 San Benedetto Val di Sambro" aria-describedby="addressHelper"
                value="{{ old('address') }}" readonly>
            <small id="addressHelper" class="text-muted">Aggiungi l'indirizzo dell'appartamento</small>
        </div>
        <div class="mb-3 d-none">
            <input class="form-control" type="text" name="lat" id="lat" readonly placeholder="44.19108">
            <label class="text-muted" for="lat">
                Latitudine
            </label>
        </div>
        <div class="mb-3 d-none">
            <input class="form-control" type="text" name="lon" id="lon" readonly placeholder="11.21899">
            <label class="text-muted" for="lon">
                Longitudine
            </label>
        </div>

        <!-- Body -->
        <div class="mb-4">
            <label for="description">Aggiungi la descrizione dell'appartamento*</label>
            <textarea class="form-control  @error('description') is-invalid @enderror" name="description" required id="description"
                rows="4">{{ old('description') }}</textarea>
        </div>

        <!-- Details -->
        <div class="mb-4">
            <label for="rooms" class="form-label">Stanze*</label>
            <input type="number" name="rooms" required id="rooms" class="form-control @error('rooms') is-invalid @enderror"
                placeholder="stanze" min=1 aria-describedby="roomsHelper" value="{{ old('rooms') }}">
            <small id="roomsHelper" class="text-muted">Aggiungi il numero delle stanze dell'appartamento</small>
        </div>

        <div class="mb-4">
            <label for="baths" class="form-label">Bagni*</label>
            <input type="number" name="baths" required id="baths" class="form-control @error('baths') is-invalid @enderror"
                placeholder="bagni" min=1 aria-describedby="bedsHelper" value="{{ old('baths') }}">
            <small id="bedsHelper" class="text-muted">Aggiungi il numero dei bagni dell'appartamento</small>
        </div>
        <div class="mb-4">
            <label for="beds" class="form-label">Letti*</label>
            <input type="number" name="beds" required id="beds" class="form-control @error('beds') is-invalid @enderror"
                placeholder="letti" min=1 aria-describedby="bedsHelper" value="{{ old('beds') }}">
            <small id="bedsHelper" class="text-muted">Aggiungi il numero dei posti letto dell'appartamento</small>
        </div>
        <div class="mb-4">
            <label for="sqm" class="form-label">Metri quadrati*</label>
            <input type="number" name="sqm" required id="sqm" class="form-control @error('sqm') is-invalid @enderror"
                placeholder="metratura" min=10 aria-describedby="sqmHelper" value="{{ old('sqm') }}">
            <small id="sqmHelper" class="text-muted">Aggiungi i metri quadrati dell'appartamento</small>
        </div>

        <div class="mb-4">
            <label for="services" class="form-label">Servizi*</label>
            <select multiple class="form-select" name="services[]" required id="services" aria-label="services">
                <option value="" disabled>Seleziona uno o più servizi</option>
                @forelse ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @empty
                    <option value="">Non ci sono servizi</option>
                @endforelse

            </select>
        </div>
        <!-- Visibility -->
        <div class="mb-3">
            <input class="form-check-input" type="radio" name="visibility" id="visibility" value="true" checked>
            <label class="form-check-label" for="visibility">
                Visibile
            </label>
        </div>
        <div class="mb-3">
            <input class="form-check-input" type="radio" name="visibility" id="visibility" value="false">
            <label class="form-check-label" for="visibility">
                Non visibile
            </label>
        </div>

        <button type="submit" class="btn btn-primary text-white">Creare nuovo appartamento</button>

    </form>
    <script src="{{ asset('js/map_create.js') }}"></script>
@endsection
