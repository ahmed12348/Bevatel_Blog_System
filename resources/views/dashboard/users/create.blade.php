@extends('dashboard.layout')

@section('content')
    <div class="container">

        <meta name="csrf-token" content="{{ csrf_token() }}">


        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Users</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create User</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <!-- Back Button -->
                <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- User Creation Form -->
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h6 class="mb-0 text-uppercase">Create New User</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('dashboard.users.store') }}" method="POST" id="create"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Text Inputs -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Enter user name" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" type="email" id="email" name="email"
                                    placeholder="Enter user email" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control" type="password" id="password" name="password"
                                    placeholder="Enter user password" required>
                            </div>

                            <!-- Select Role Input with Select2 -->
                            <div class="mb-3">
                                <label for="role" class="form-label">Select Role</label>
                                <select class="form-select select2" id="role" name="roles[]" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <!-- Select office_code  Input using select2 -->
                            <div class="mb-3">
                                <label for="office_code" class="form-label">Select Office</label>
                                 <select class="form-select select2" id="office_code" name="office_code" required>
                                  <option value="October">October</option>
                                    <option value="El_Dokki_">El_Dokki_</option>
                                    <option value="Gomhoriat_Ein_Shams">Gomhoriat_Ein_Shams</option>
                                    <option value="Heliopolis_Wast">Heliopolis_Wast</option>
                                    <option value="Helwan">Helwan</option>
                                </select>
                                @error('office_code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <!-- Job Title -->
                            {{-- <div class="mb-3">
                                <label for="job_title" class="form-label">Job Title</label>
                                <input class="form-control" type="text" id="job_title" name="job_title"
                                    placeholder="Enter job title">
                                @error('job_title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End User Creation Form -->
    </div>

    <!-- Scripts to add Select2 functionality -->
    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>


     
    @endpush
@endsection
