@extends('layouts.app')
@section('content')

<section id="dashboard">
    
    <div class="row">
        
        <!-- /.col sx -->
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Thumb</th>
                            <th>Address</th>
                            <th>Body</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse($apartments as $apartment)
                        <tr>
                            <td scope="row">{{$apartment->id}}</td>
                            <td>{{$apartment->title}}</td>
                            <td><img class="img-fluid" height="200px" src="{{$apartment->thumb}}" alt="cover of {{$apartment->title}}"></td>
                            <td>{{$apartment->address}}</td>
                            <td>
                                {{ Str::limit( $apartment->description, 200) }}
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        <a href="{{route('admin.apartment.show', $apartment->id)}}">View</a>
                                    </li>
                                    <li>
                                    <a href="{{route('admin.apartment.edit', $apartment->id)}}">Edit</a>

                                    </li>
                                    <li>Delete</li>
                                </ul>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td scope="row">
                                No apartment to show 😥
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col dx -->
    </div>
    <!-- /.row down Dashboard -->
</section>


@endsection