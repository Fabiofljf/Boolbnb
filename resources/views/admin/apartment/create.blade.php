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
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Add a descriptive title" aria-describedby="titleHelper" value="{{old('title')}}">
        <small id="titleHelper" class="text-muted">Add apartment's title, max: 150 carachters</small>
    </div>
    <div class="mb-4">
        <label for="thumb">Image</label>
        <input type="text" name="thumb" id="thumb" class="form-control  @error('thumb') is-invalid @enderror" placeholder="Add a captivating image" aria-describedby="thumbHelper">
        <small id="thumbHelper" class="text-muted">Add apartment's image</small>
    </div>

    <!-- In questo punto andrà inserito il campo address che l'utente dovrà inserire. Dobbiamo verificare il modo in cui attraverso questo dato, con la chiamata Api otteniamo lat e long -->
    <div class="mb-4">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="form-control  @error('address') is-invalid @enderror" placeholder="Add apartment address" aria-describedby="addressHelper">
        <small id="addressHelper" class="text-muted">Add apartment's address</small>
    </div>

    
    <div class="mb-4">
        <label for="description">Description</label>
        <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description" rows="4">
        {{old('description')}}
        </textarea>
    </div>

    <div class="mb-4">
        <label for="rooms" class="form-label">Rooms</label>
        <input type="number" name="rooms" id="rooms" class="form-control @error('rooms') is-invalid @enderror" placeholder="Add apartment rooms" aria-describedby="roomsHelper" value="{{old('rooms')}}">
        <small id="roomsHelper" class="text-muted">Change the apartment's rooms number</small>
    </div>
    <div class="mb-4">
        <label for="baths" class="form-label">Baths</label>
        <input type="number" name="baths" id="baths" class="form-control @error('baths') is-invalid @enderror" placeholder="Add apartment baths" aria-describedby="bedsHelper" value="{{old('baths')}}">
        <small id="bedsHelper" class="text-muted">Change the apartment's baths number</small>
    </div>
    <div class="mb-4">
        <label for="beds" class="form-label">Beds</label>
        <input type="number" name="beds" id="beds" class="form-control @error('beds') is-invalid @enderror" placeholder="Add apartment beds" aria-describedby="bedsHelper" value="{{old('beds')}}">
        <small id="bedsHelper" class="text-muted">Change the apartment's beds number</small>
    </div>
    <div class="mb-4">
        <label for="sqm" class="form-label">Square Meters</label>
        <input type="number" name="sqm" id="sqm" class="form-control @error('sqm') is-invalid @enderror" placeholder="Add apartment square meters" aria-describedby="sqmHelper" value="{{old('sqm')}}">
        <small id="sqmHelper" class="text-muted">Change the apartment's square meters</small>
    </div>

    <button type="submit" class="btn btn-primary text-white">Create a brand new Apartment</button>

</form>

@endsection