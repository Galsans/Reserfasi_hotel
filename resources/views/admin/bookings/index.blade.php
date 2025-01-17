@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    {{-- <i class="mdi mdi-home"></i> --}}
                    <i class="fa fa-hotel"></i>
                </span> <a href="{{ route('rooms.index') }}" class="text-dark text-decoration-none">Rooms</a>

            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        {{-- <span></span>Create <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> --}}

                        <a href="{{ route('rooms.create') }}" type="button" class="btn btn-gradient-primary btn-md">Create
                            Data</a>
                        {{-- <button></button> --}}
                    </li>
                </ul>
            </nav>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>There were some errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Rooms</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> No Room </th>
                                        <th> Facilities </th>
                                        <th> Type Rooms </th>
                                        <th> Price </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $items)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $items->no_room }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($items->facilities, 20, '...') }}</td>
                                            <td>
                                                @if ($items->type_room === 'sucide')
                                                    <label
                                                        class="badge badge-gradient-primary text-dark"><b>{{ $items->type_room }}</b></label>
                                                @elseif ($items->type_room === 'deluxe')
                                                    <label
                                                        class="badge badge-gradient-dark"><b>{{ $items->type_room }}</b></label>
                                                @else
                                                    <label
                                                        class="badge badge-gradient-success text-dark"><b>{{ $items->type_room }}</b></label>
                                                @endif
                                            </td>
                                            <td>Rp. {{ number_format($items->price, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($items->status === 'tersedia')
                                                    <label
                                                        class="badge badge-gradient-success text-dark"><b>{{ $items->status }}</b></label>
                                                @else
                                                    <label
                                                        class="badge badge-gradient-warning text-dark"><b>{{ $items->status }}</b></label>
                                                @endif

                                            </td>
                                            <td class="d-flex gap-2">
                                                <a href="{{ route('rooms.show', $items->id) }}"
                                                    class="btn btn-info btn-sm">Detail</a>
                                                <a href="{{ route('rooms.edit', $items->id) }}"
                                                    class="btn btn-secondary btn-sm">Edit</a>
                                                {{-- <form action="{{ route('rooms.destroy', $items->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                </form> --}}
                                            <a href="{{ route('rooms.destroy', $items->id) }}" class="btn btn-danger btn-sm"
                                                data-confirm-delete="true">Delete</a>
                                            </td> --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center " colspan="7"><b>Data Is Not Found</b></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
