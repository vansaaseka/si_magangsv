<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Magang</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/admin-dashboard/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin-dashboard/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin-dashboard/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/admin-dashboard/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/admin-dashboard/images/LogoTypeSV-01.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-center py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="assets/landingpage/assets/images/LogoSV.png" alt="logo">
                            </div>
                            <h4>Belum Punya Akun?</h4>
                            <h6 class="font-weight-light">Silahkan buat akun menggunakan email SSO</h6>
                            <form action="{{ route('register.post') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name"
                                        id="name" placeholder="Nama Lengkap">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('nim') is-invalid @enderror"
                                        name="nim" value="{{ old('nim') }}" required autocomplete="nim"
                                        id="nim" placeholder="NIM">
                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{-- <input type="text" class="form-control form-control-lg @error('prodi_id') is-invalid @enderror" name="prodi_id" value="{{ old('prodi_id') }}" required autocomplete="unit" id="prodi_id" placeholder="Prodi"> --}}

                                    <select
                                        class="form-control form-control-lg text-black @error('prodi_id') is-invalid @enderror"
                                        name="prodi_id" id="">
                                        <option value="NULL">Prodi</option>
                                        @foreach ($prodi as $pro)
                                            <option value="{{ $pro->id }}" class="text-black">
                                                {{ $pro->nama_prodi }}</option>
                                        @endforeach
                                    </select>
                                    @error('prodi_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <input type="number"
                                        class="form-control form-control-lg @error('no_wa') is-invalid @enderror"
                                        name="no_wa" value="{{ old('no_wa') }}" required autocomplete="no_wa"
                                        id="no_wa" placeholder="Nomor WhatsApp">
                                    @error('no_wa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        id="email" placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password" id="password"
                                        placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        name="password_confirmation" required autocomplete="new-password"
                                        id="password_confirmation" placeholder="Konfirmasi Password">
                                </div>

                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn">DAFTAR</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- plugins:js -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/template.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>
