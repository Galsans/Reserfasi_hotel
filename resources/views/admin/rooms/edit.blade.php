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
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Data Rooms</h4>
                        <form class="forms-sample" action="{{ route('rooms.update', $rooms->id) }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleNoRooms">Number Room</label>
                                <input type="text" class="form-control" id="exampleNoRooms" placeholder="Number Rooms"
                                    name="no_room" value="{{ $rooms->no_room }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleFacilities">Facilities</label>
                                <textarea class="form-control" id="exampleFacilities" name="facilities" rows="4" placeholder="Facilities">{{ $rooms->facilities }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPrice">Price</label>
                                <input type="number" class="form-control" id="exampleInputPrice" placeholder="Price"
                                    name="price" value="{{ $rooms->price }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="type_room">Type Rooms</label>
                                <select class="form-select" id="type_room" name="type_room">
                                    <option disabled selected>--Select Type Rooms--</option>
                                    <option value="sucide"
                                        {{ old('type_room', $rooms->type_room ?? '') == 'sucide' ? 'selected' : '' }}>Sucide
                                    </option>
                                    <option value="deluxe"
                                        {{ old('type_room', $rooms->type_room ?? '') == 'deluxe' ? 'selected' : '' }}>Deluxe
                                    </option>
                                    <option value="standard"
                                        {{ old('type_room', $rooms->type_room ?? '') == 'standard' ? 'selected' : '' }}>
                                        Standard</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option disabled selected>--Select Status--</option>
                                    <option value="tersedia"
                                        {{ old('status', $rooms->status ?? '') == 'tersedia' ? 'selected' : '' }}>Tersedia
                                    </option>
                                    <option value="terisi"
                                        {{ old('status', $rooms->status ?? '') == 'terisi' ? 'selected' : '' }}>Terisi
                                    </option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="img">File Upload</label>
                                @if (!empty($rooms->img))
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($rooms->img) }}" alt="Room Image"
                                            class="img-fluid rounded" width="500">
                                    </div>
                                @endif
                                <input type="file" name="img" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary py-3"
                                            type="button">Upload</button>
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-secondary me-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
