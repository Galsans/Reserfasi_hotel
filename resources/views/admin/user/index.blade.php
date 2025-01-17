@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    {{-- <i class="mdi mdi-home"></i> --}}
                    <i class="fa fa-hotel"></i>
                </span> <a href="{{ route('users.index') }}" class="text-dark text-decoration-none">Users</a>

            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        {{-- <span></span>Create <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> --}}

                        <a href="{{ route('users.create') }}" type="button" class="btn btn-gradient-primary btn-md">Create
                            Data</a>
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
                        <h4 class="card-title">List Users</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Name </th>
                                        <th> Email </th>
                                        <th> Role </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $items)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $items->name }}</td>
                                            <td>{{ $items->email }}</td>
                                            <td>{{ $items->role }}</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{ route('users.show', $items->id) }}"
                                                    class="btn btn-info btn-sm">Detail</a>
                                                <a href="{{ route('users.edit', $items->id) }}"
                                                    class="btn btn-secondary btn-sm">Edit</a>
                                                <a href="{{ route('users.destroy', $items->id) }}"
                                                    class="btn btn-danger btn-sm" data-confirm-delete="true">Delete</a>
                                            </td>
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
