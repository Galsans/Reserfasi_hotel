<!-- resources/views/profile/edit.blade.php -->
@extends('dashboard.app')

@section('content')

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> My Profile
            </h3>
            {{-- <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Profile
                    </li>
                </ul>
            </nav> --}}
        </div>

        <!-- Display Validation Errors -->
        @error('error')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- @if ($user->alamat == null)
            <div class="alert alert-danger">Sebelum Memesan, Harap Mengisi No Whatsapp dan Alamat Yang Benar Terlebih Dahulu
            </div>
        @endif --}}

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card shadow-sm">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if (Auth::user()->img == '')
                                <img src="/dash/src/assets/images/faces/face1.jpg" alt="Profile" class="rounded-circle"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <img src="{{ Storage::url(Auth::user()->img) }}" alt="Profile" class="rounded-circle"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                            <h2 class="mt-3">{{ $user->name }}</h2>
                            <h3 class="text-muted">{{ $user->role }}</h3>
                        </div>
                    </div>
                </div>


                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview"><i class="mdi mdi-magnify"></i> Overview</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"><i
                                            class="mdi mdi-pencil"></i> Edit
                                        Profile</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    {{-- <h5 class="card-title">Alamat</h5>
                                    <p class="small fst-italic bg-light p-2 rounded">{{ $user->alamat }}</p> --}}

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row mb-3">
                                        <div class="col-lg-3 col-md-4 label">
                                            <i class="mdi mdi-account-circle-outline me-2"></i>Username
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <div class="p-2 bg-light rounded">{{ $user->name }}</div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-3 col-md-4 label">
                                            <i class="mdi mdi-whatsapp me-2"></i>Whatsapp
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <div class="p-2 bg-light rounded">{{ $user->phone }}</div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-3 col-md-4 label">
                                            <i class="mdi mdi-email-outline me-2"></i>Email
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <div class="p-2 bg-light rounded">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <form method="POST" class="row g-3" action="{{ route('profile.update') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                @if (Auth::user()->img == '')
                                                    <img src="/dash/src/assets/images/faces/face1.jpg" alt="Profile"
                                                        class="rounded-circle"
                                                        style="width: 150px; height: 150px; object-fit: cover;">
                                                @else
                                                    <img src="{{ Storage::url(Auth::user()->img) }}" alt="Profile"
                                                        class="rounded-circle"
                                                        style="width: 150px; height: 150px; object-fit: cover;">
                                                @endif
                                                <div class="pt-2">
                                                    <input id="img" type="file"
                                                        class="form-control @error('img') is-invalid @enderror"
                                                        name="img">
                                                    @error('img')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name', $user->name) }}" required>
                                                <label for="name">Username</label>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email', $user->email) }}" required>
                                                <label for="email">Email</label>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input id="phone" type="number"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    name="phone" value="{{ old('phone', $user->phone) }}" required>
                                                <label for="phone">No Whatsapp</label>
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $user->alamat) }}</textarea>
                                                <label for="alamat">Alamat</label>
                                                @error('alamat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input id="current_password" type="password"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    name="current_password">
                                                <label for="current_password">Current Password</label>
                                                @error('current_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password">
                                                <label for="password">Password (Leave blank to keep current
                                                    password)</label>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input id="password_confirmation" type="password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    name="password_confirmation">
                                                <label for="password_confirmation">Confirm Password</label>
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
