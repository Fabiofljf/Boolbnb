@extends('layouts.app')
@section('content')
    <section id="dashboard">

        <div class="row">

            <!-- /.col sx -->
            <div class="container">
                <!-- Sezione per aggiungere un ulteriore appartamento -->
                <div class="d-flex justify-content-between py-4">
                    <h1>Lista di appartamenti</h1>
                    <div>
                        <a href="{{ route('admin.apartment.create') }}" class="btn btn-primary text-white">Aggiungi nuovo
                            appartamento</a></div>
                </div>
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
                                    <td scope="row">{{ $apartment->id }}</td>
                                    <td>{{ $apartment->title }}</td>
                                    <td> <img src="{{ asset('/storage/' . $apartment->thumb)}}" alt="thumb of {{$apartment->title}}"></td>
                                    <td>{{ $apartment->address }}</td>
                                    <td>
                                        {{ Str::limit($apartment->description, 200) }}
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a class="btn btn-primary text-white btn-sm"
                                                    href="{{ route('admin.apartment.show', $apartment->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                        <path
                                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                    </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-success text-white btn-sm"
                                                    href="{{ route('admin.apartment.edit', $apartment->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                        <path
                                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                    </svg>
                                                </a>

                                            </li>
                                            <li>
                                                <!-- Bottone per avviare la modale -->
                                                <button type="button" class="btn btn-danger btn-sm text-white"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete-apartment-{{ $apartment->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </button>

                                                <!-- Modale -->
                                                <div class="modal fade" id="delete-apartment-{{ $apartment->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="modelTitle-{{ $apartment->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete apartment:
                                                                    "{{ $apartment->title }}"</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this apartment? <br>
                                                                !Caution this is a destructive operation!
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>


                                                                <form
                                                                    action="{{ route('admin.apartment.destroy', $apartment->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td scope="row">
                                        Nessun appartamento da mostrare 😥
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
