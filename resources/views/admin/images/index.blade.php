@extends('layouts.app')

@section('content')
<div class="row">
<div class="article-nav text-end">
  <p>
  <a class="btn btn-primary" href="{{route('admin.apartment.edit', $apartment->slug)}}" role="button">Modifica Articolo</a>
  <a class="btn btn-primary" href="{{route('admin.apartment.show', $apartment->slug)}}" role="button">Mostra</a>
  </p>
</div>
@forelse($images as $image)


    <div class="col-4">
        <form action="{{route('admin.apartments.images.destroy', ['apartment' =>$apartment , 'image'=> $image])}}" method="post">
            @csrf 
            @method('DELETE')

        <img class="img-fluid w-100"src="{{asset('/storage/' . $image->src)}}" alt="apartment image">
        <button class="btn btn-danger text-white mt-2 me-2" type="submit">Delete</button>
        </form>

    </div>

@empty
<div class="col">
    <h2>No Images to show</h2>
    <a class="btn btn-primary" href="{{route('admin.apartment.edit', $apartment->slug)}}" role="button">Back</a>
</div>

@endforelse
</div>
@endsection