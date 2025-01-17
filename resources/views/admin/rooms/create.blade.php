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
                        <h4 class="card-title">Create Data Rooms</h4>
                        <form class="forms-sample" action="{{ route('rooms.store') }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleNoRooms">Number Room</label>
                                <input type="text" class="form-control" id="exampleNoRooms" placeholder="no_room"
                                    name="no_room" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFacilities">Facilities</label>
                                <textarea class="form-control" id="exampleFacilities" name="facilities" required rows="4"
                                    placeholder="Facilities"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPrice">Price</label>
                                <input type="number" class="form-control" id="exampleInputPrice" placeholder="Price"
                                    name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleTypeRooms">Type Rooms</label>
                                <select class="form-select" id="exampleTypeRooms" name="type_room" required>
                                    <option disabled selected>--Select Type Rooms--</option>
                                    <option value="sucide">Sucide</option>
                                    <option value="deluxe">Deluxe</option>
                                    <option value="standard">Standard</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleStatus">Status</label>
                                <select class="form-select" id="exampleStatus" name="status" required>
                                    <option selected disabled>--Select Status--</option>
                                    <option value="tersedia">Tersedia</option>
                                    <option value="terisi">Terisi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>File upload</label>
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

                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Plugin js for this page -->

    <script src="{{ asset('dash/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dash/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page -->
    <script src="{{ asset('dash/assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('dash/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('dash/assets/js/select2.js') }}"></script>
@endsection
