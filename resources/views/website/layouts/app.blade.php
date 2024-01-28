<!DOCTYPE html>
<html lang="ar">

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime()
                , event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0]
                , j = d.createElement(s)
                , dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NTRKQ8WD');

    </script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QGM14K82GD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-QGM14K82GD');

    </script>
    <title> شركة صالح بن علي الغفيص للتقييم العقاري</title>

    <link rel="shortcut icon" href="/img/logo/ficon.png" type="image/x-icon">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/fontawesome-all.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/odometer-theme-default.css">
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/slick-theme.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div id="preloader"></div>
    <div class="up">
        <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
    </div>

    <!-- Start of header section
 ============================================= -->
    @include('website.layouts.header')
    <!-- End of header section
 ============================================= -->

    @yield('content')
    <!-- Start of Footer  section
 ============================================= -->
    <section id="xis-footer" class="xis-footer-section">
        <div class="container">
            <div class="xis-footer-menu-content d-flex align-items-center justify-content-between">
                <div class="footer-logo">
                    <a href="{{ route('website.home') }}"><img src="/{{ $setting->logo_white }}" alt=""></a>
                </div>
                <div class="footer-menu ul-li">
                    <ul>
                        <li><a href="{{ route('website.home') }}">الرئيسيه</a></li>
                        <li><a href="{{ route('website.home') }}#aboutus">من نحن</a></li>
                        <li><a href="{{ route('website.home') }}#featured">أهدافنا</a></li>
                        <li><a href="{{ route('website.home') }}#services">خدماتنا</a></li>
                        <li><a href="{{ route('website.home') }}#sponsor">عملائنا</a></li>
                        <li><a href="{{ route('website.contactUs') }}"> تواصل معنا </a></li>
                        <li><a href="{{ route('website.Prviacy-ploice') }}"> سياسية الخصوصية</a></li>


                    </ul>
                </div>
            </div>
            <div class="xis-footer-copyright d align-items-center">

                <div class="xis-footer-social-text ul-li pera-content text-center">

                    <p>© 2023 شركة صالح بن علي الغفيص للتقييم العقاري. جميع الحقوق محفوظة.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Footer section
 ============================================= -->

    <!-- For Js Library -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/appear.js"></script>
    <script src="/js/slick.js"></script>
    <script src="/js/jquery.counterup.min.js"></script>
    <script src="/js/waypoints.min.js"></script>
    <script src="/js/odometer.js"></script>
    <script src="/js/wow.min.js"></script>
    {{-- <script src="/js/pagenav.js"></script> --}}
    <script src="/js/parallax.min.js"></script>
    <script src="/js/parallax-scroll.js"></script>
    <script src="/js/script.js"></script>
    @yield('js')
</body>

</html>
