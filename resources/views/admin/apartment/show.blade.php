@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>{{ $apartment->title }}</h2>
        <p>{{ $apartment->address }}</p>
        <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
            <div class="col-6">
                <div class="apartment-thumb">
                    <img src="{{ asset('/storage/' . $apartment->thumb) }}" alt="thumb of {{ $apartment->title }}">
                </div>
            </div>
            <div class="col-6 mb-3">
                <div id="map" style="height:100%"></div>
            </div>
        </div>
        @if($images)
    <div class="article-imgs row mb-3">
        <h3>Immagini:</h3>
        @foreach($images as $image)
        <div class="col-3 py-3">
            <img class="img-fluid w-100" src="{{asset('/storage/' . $image->src)}}" alt="">
        </div>
        @endforeach
    </div>
    @endif
        <div class="apartment-description mt-3">
            <h3>Description:</h3>
            {{ $apartment->description }}
        </div>
        <div class="apartment-details mt-3">
            <h3>Details:</h3>
            <ul>
                <li>Rooms Numbers: {{ $apartment->rooms }}</li>
                <li>Beds Numbers: {{ $apartment->beds }}</li>
                <li>Baths Numbers: {{ $apartment->baths }}</li>
                <li>Sqm: {{ $apartment->sqm }}</li>
            </ul>
        </div>

        <div class="apartment-services mt-3">
            <h3>Services:</h3>
            <ul>
                @forelse($apartment->services as $service)
                <li>{!! $service->icon !!} {{ $service->name }}</li>
                @empty
                <li>No Serivices 😪</li>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="apartment-publicity mt-3">
        <h3>Publicity:</h3>
        <ul>
            @forelse($apartment->publicities as $publicity)
            <li>{!! $publicity->icon !!} {{ $publicity->name }}</li>
            @empty
            <li>No Publicity 😪</li>
            @endforelse
        </ul>
    </div>
    </div>
    <h3>Messages:</h3>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        @foreach($messages as $message)
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading{{$message->id}}">
                <button class="accordion-button collapsed justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$message->id}}" aria-expanded="false" aria-controls="flush-collapse{{$message->id}}">
                    <div class="d-flex justify-content-between w-75">
                        <div>
                            <strong>{{$message->subject}}</strong>
                        </div>
                        <div class="text-end">
                            Mittente:{{$message->email}}

                        </div>
                    </div>

                </button>
            </h2>
            <div id="flush-collapse{{$message->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$message->id}}" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <h5>{{$message->subject}}</h5>
                    <p>{{$message->content}} </p>
                    <p>{{$message->full_name}}</p>
                    <p>{{$message->created_at}}</p>
                </div>
                </p>
            </div>

        </div>
        @endforeach

</div>

<script>
    let apartment = <?php echo json_encode($apartment->toArray()); ?>;
    let latitude = apartment.lat;
    let longitude = apartment.lon;
    let address = apartment.address;
    let title = apartment.title;
</script>
<script src="{{ asset('js/map_show.js') }}"></script>
@endsection