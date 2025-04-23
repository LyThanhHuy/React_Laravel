<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        {{-- Navbar --}}
        {{-- @include('layouts.partials.navbar') --}}

        {{-- Sidebar --}}
        {{-- @include('layouts.partials.sidebar') --}}

        {{-- Content --}}
        <div class="content-wrapper">
            <section class="content pt-3">
                <div class="container-fluid">
                    @yield('content')
                    huyt huy huy uhuhu
                </div>
            </section>
        </div>

        {{-- Footer --}}
        {{-- @include('layouts.partials.footer') --}}

    </div>

    {{-- JS --}}
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
