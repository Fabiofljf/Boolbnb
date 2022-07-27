@extends('layouts.app')
@section('content')
@if (session('success_message'))
            <div class='alert alert-success'>
                {{ session('success_message') }}
            </div>
@endif
   <div class="container">
   <h2 class='text-center'>Seleziona la sponsorizzazione</h2>
     <div class="row">
        @foreach($publicities as $publicity)
        <div class="col text-center">
            <a href="{{route('admin.publicity.edit', [$apartment->id, $publicity->id])}}">
                <div class="card py-5">
                    <h3 class='py-2'>{{$publicity->type}}</h3>
                    <img height='300' src="https://picsum.photos/300" alt="{{$publicity->type}}">
                    <p class='py-2'>{{$publicity->price}} €</p>
                    <p class='py-2'>{{$publicity->duration}} ore</p>
                </div>

            </a>
        </div>
        @endforeach
     </div>
   </div>
@endsection