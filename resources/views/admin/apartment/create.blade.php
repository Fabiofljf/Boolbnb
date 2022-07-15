@extends('layouts.app')

@section('content')

<h2 class="py-4">Add a new Apartment</h2>
@if($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{route('admin.apartment.store')}}" method="post">
    @csrf
    <div class="mb-4">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Inserisci titolo" aria-describedby="titleHelper" value="{{old('title')}}">
        <small id="titleHelper" class="text-muted">Add apartment's title, max: 150 carachters</small>
    </div>
    <div class="mb-4">
        <label for="thumb">Image</label>
        <input type="text" name="thumb" id="thumb" class="form-control  @error('thumb') is-invalid @enderror" placeholder="Inserisci immagine" aria-describedby="thumbHelper">
        <small id="thumbHelper" class="text-muted">Add apartment's image</small>
    </div>

    <!-- In questo punto andrà inserito il campo address che l'utente dovrà inserire. Dobbiamo verificare il modo in cui attraverso questo dato, con la chiamata Api otteniamo lat e long -->
    
    <div class="mb-4">
        <label for="description">Description</label>
        <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description" rows="4">
        {{old('description')}}
        </textarea>
    </div>

    <button type="submit" class="btn btn-primary">Create Apartment</button>

</form>

@endsection