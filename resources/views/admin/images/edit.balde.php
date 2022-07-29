
@extends('layouts.app')

@section('content')

@forelse($images as $image)
    <div class="col-4">
      <img class="img-fluid" src="{{asset('/storage/' . $image->src)}}" alt="$image->src">
    </div>

@empty

@endforelse

@endsection