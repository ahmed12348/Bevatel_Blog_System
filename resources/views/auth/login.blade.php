<!doctype html>
<html lang="en" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <title>Onedash - Bootstrap 5 Admin Template</title>
</head>
<body>
    <!--start wrapper-->
    <div class="wrapper">
        <!--start content-->
        <main class="authentication-content">
            <div class="container-fluid">
                <div class="authentication-card">
                    <div class="card shadow rounded-0 overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/images/error/login-img.jpg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-4 p-sm-5">
                                    <!-- <h5 class="card-title">Sign In</h5> -->
                                    <!-- <p class="card-text mb-5">See your growth and get consulting support!</p> -->
                                    <form class="form-body" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <!-- Google Sign-In Button -->
                                        <!-- <div class="d-grid mb-3">
                                            <a class="btn btn-white radius-30" href="javascript:;">
                                                <span class="d-flex justify-content-center align-items-center">
                                                    <img class="me-2" src="{{ asset('assets/images/icons/search.svg') }}" width="16" alt="">
                                                    <span>Sign in with Google</span>
                                                </span>
                                            </a>
                                        </div> -->
                                        <!-- OR SIGN IN WITH EMAIL -->
                                        <!-- <div class="login-separater text-center mb-4">
                                            <span>OR SIGN IN WITH EMAIL</span>
                                            <hr>
                                        </div> -->
                                        <div class="row g-3">
                                            <!-- Email Input -->
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <div class="ms-auto position-relative">
                                                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-envelope-fill"></i>
                                                    </div>
                                                    <input type="email" class="form-control radius-30 ps-5" id="inputEmailAddress" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                                </div>
                                                @error('email')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Password Input -->
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                                <div class="ms-auto position-relative">
                                                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-lock-fill"></i>
                                                    </div>
                                                    <input type="password" class="form-control radius-30 ps-5" id="inputChoosePassword" name="password" placeholder="Enter Password" required>
                                                </div>
                                                @error('password')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Remember Me Checkbox -->
                                            <!-- <div class="col-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                                </div>
                                            </div> -->
                                            <!-- Forgot Password Link -->
                                            <!-- <div class="col-6 text-end">
                                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                                            </div> -->
                                            <!-- Submit Button -->
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary radius-30">Sign In</button>
                                                </div>
                                            </div>
                                            <!-- Sign Up Link -->
                                            <!-- <div class="col-12">
                                                <p class="mb-0">Don't have an account yet? <a href="{{ route('register') }}">Sign up here</a></p>
                                            </div> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--end page main-->
    </div>
    <!--end wrapper-->
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
</body>
</html>
