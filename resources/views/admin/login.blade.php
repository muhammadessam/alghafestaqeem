<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>لوحة التحكم | {{ $setting->title ?? '' }} </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/panel/vendors/feather/feather.css">
    <link rel="stylesheet" href="/panel/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/panel/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/panel/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="icon" type="image/png" href="{{ $setting->imagePath('logo') ?? '/images/logo.png' }}" />
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
    <div class=" container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img src="{{ $setting->imagePath('logo') ?? '/images/logo.png' }}" alt="logo">
                            </div>
                            <h4>مرحبا! دعنا نبدأ</h4>
                            <h6 class="font-weight-light">تسجيل الدخول</h6>
                            <form class="pt-3" action="{{ route('admin.login') }}" method="post" id="loginForm">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail">البريد الإلكتروني</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="ti-user text-primary"></i>
                                            </span>
                                        </div>
                                        <input required name="email" value="{{ old('email') }}" type="email" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="البريد الإلكتروني" />

                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback text-right">{{ $errors->first('email') }}</span>
                                    @else
                                    <div class="invalid-feedback text-right">من فضلك قم باإدخال البريد الإلكتروني
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword">كلمة المرور</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="ti-lock text-primary"></i>
                                            </span>
                                        </div>
                                        <input required name="password" type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="كلمة المرور" />
                                    </div>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback text-right">{{ $errors->first('password') }}</span>
                                    @else
                                    <div class="invalid-feedback text-right">من فضلك قم باإدخال كلمة المرور
                                    </div>
                                    @endif
                                </div>


                                @if ($errors->any())
                                <h5 class="text-danger float-left">{{ $errors->first() }}</h5>
                                <br>
                                @endif

                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            تذكرني
                                        </label>
                                    </div>
                                    {{-- <a href="#" class="auth-link text-black">Forgot password?</a> --}}
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">تسجيل
                                        الدخول
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">
                            {{ $setting->footer ?? '' }}</p>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/panel/vendors/js/vendor.bundle.base.js"></script>
    <script src="/panel/js/off-canvas.js"></script>
    <script src="/panel/js/hoverable-collapse.js"></script>

    <script src="/panel/js/template.js"></script>
    <script src="/panel/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $('#loginForm').validate({
            rules: {
                password: {
                    required: true
                    , minlength: 5
                , },

                email: {
                    required: true
                    , email: true
                , },

            }
            , messages: {

                password: {
                    required: 'Please provide a password'
                    , minlength: 'Your password must be at least 5 characters long'
                , }
                , email: 'Please enter a valid email address'
            , }
            , errorPlacement: function(label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            }
            , highlight: function(element, errorClass) {
                $(element).parent().addClass('has-danger');
                $(element).addClass('form-control-danger');
            }
        , });

    </script>
</body>

</html>
