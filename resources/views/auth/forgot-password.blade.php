<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Lupa Password | SITASI ITK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico')}}">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/preloader.min.css')}}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('dist/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('dist/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('dist/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="{{ route('login')}}" class="d-block auth-logo">
                                        <img src="{{ asset('dist/assets/images/logo-sm.svg')}}" alt="" height="28"> 
                                        <span class="logo-txt">SITASI ITK</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Lupa Password?</h5>
                                        <p class="text-muted mt-2">Masukkan email Anda dan kami akan mengirimkan link untuk reset password</p>
                                    </div>

                                    {{-- Alert Messages menggunakan sistem yang sudah ada --}}
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="mdi mdi-check-all label-icon"></i><strong>Success</strong> - {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    @if($errors->any())
                                        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="mdi mdi-block-helper label-icon"></i><strong>Failed</strong> - {{ $errors->first() }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <form class="mt-4 pt-2" role="form" method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" 
                                                   placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                                            @error('email')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">
                                                Kirim Link Reset Password
                                            </button>
                                        </div>
                                    </form>

                                    <div class="mt-3 text-center">
                                        <p class="mb-0">
                                            Ingat password Anda? 
                                            <a href="{{ route('login') }}" class="text-primary">Kembali ke Login</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> 
                                        <a href="https://is.itk.ac.id">Sistem Informasi ITK.</a><br>
                                        Developed by <a href="#">Sri Rahayu Natasia</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex" style="
                        background-image: url('{{ asset('assets/img/foto-itk.jpg')}}');
                        background-size: contain;
                        background-position: center center;
                        background-repeat: no-repeat;
                    ">
                        <div class="bg-overlay bg-primary"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-7">
                                <div class="p-0 p-sm-4 px-xl-0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('dist/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/pace-js/pace.min.js') }}"></script>
</body>

</html>