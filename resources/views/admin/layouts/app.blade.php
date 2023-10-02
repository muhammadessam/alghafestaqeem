<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $setting ? $setting->title . ' | ' : '' }} @yield('tab_name')</title>
    @include('admin.layouts.css')
    @yield('css')
    <link rel="shortcut icon" href="{{ $setting->imagePath('logo') ?? asset('/images/logo.png') }}">
    @if (app()->getLocale() == 'ar')
        <style>
            .pull-right {
                float: left !important;
            }

            .pull-left {
                float: right !important;
            }

        </style>
    @endif
</head>

<body class="@if (app()->getLocale() == 'ar') rtl @endif">
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        @include('admin.layouts.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            @include('admin.layouts.sidebar')
            <!-- partial -->

            <!-- partial:partials/_sidebar.html -->
            @include('admin.layouts.menu')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Session::has('message'))
                        <div class="alert alert-success"> {{ Session::get('message') }}</div>
                    @endif
                    @include('flash::message')
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span
                            class="text-muted text-center text-sm-left d-block d-sm-inline-block">{{ $setting->footer }}</span>

                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    @include('admin.layouts.js')
    @yield('js')

</body>

</html>
