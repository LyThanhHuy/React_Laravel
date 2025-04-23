<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('favicon.png') }}" rel="shortcut icon">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    <div class="w-100 d-flex justify-content-center">
        <div class="login-box">
            <div class="login-logo">
                <b>Admin</b>LTE Login
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Đăng nhập để bắt đầu phiên làm việc</p>

                    <form {{-- action="{{ route('login') }}"  --}} method="POST">
                        @csrf

                        {{-- @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif --}}

                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required
                                autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">Ghi nhớ</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
