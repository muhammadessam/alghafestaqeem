<style>
    .site-logo img {
        height: 70px;
    }

    .footer-logo img {
        height: 120px;
    }

</style>
<header id="xisma-header" class="xisma-header-section">
    <div class="container">
        <div class="xisma-header-content">
            <div class="xisma-header-main-menu d-flex align-items-center justify-content-between">
                <div class="site-logo">
                    <a href="{{ route('website.home') }}"><img src="/{{ $setting->logo_white }}" alt=""></a>
                </div>
                <div class="xis-main-navigation-area">
                    <nav class="xis-main-navigation scroll-nav clearfix ul-li">
                        <ul style="width: max-content;" id="xis-main-nav" class="nav navbar-nav clearfix">
                            <li><a href="{{ route('website.home') }}">الرئيسيه</a></li>
                            <li><a href="{{ route('website.home') }}#aboutus">من نحن</a></li>
                            <li><a href="{{ route('website.home') }}#featured">أهدافنا</a></li>
                            <li><a href="{{ route('website.home') }}#services">خدماتنا</a></li>
                            <li><a href="{{ route('website.home') }}#sponsor">عملائنا</a></li>
                            <li><a href="/blog">المدونة</a></li>
                            <li><a href="{{ route('website.contactUs') }}">تواصل معنا</a></li>
                            <li><a href="{{ route('website.tracking') }}">تتبع طلبك</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="xis-header-cta-btn d-flex">
                    <a class="d-flex justify-content-center align-items-center" href="tel:0555179877⁩">اتصل بنا
                    </a>
                    <a class="d-flex justify-content-center align-items-center active" href="{{ route('website.rate-request.show') }}">طلب
                        تقييم </a>
                </div>
            </div>
            <div class="mobile_menu position-relative">
                <div class="mobile_menu_button open_mobile_menu">
                    <i class="fal fa-bars"></i>
                </div>
                <div class="mobile_menu_wrap">
                    <div class="mobile_menu_overlay open_mobile_menu"></div>
                    <div class="mobile_menu_content">
                        <div class="mobile_menu_close open_mobile_menu">
                            <i class="fal fa-times"></i>
                        </div>
                        <div class="m-brand-logo">
                            <a href="{{ route('website.home') }}"><img src="/{{ $setting->logo_white }}" alt=""></a>
                        </div>
                        <nav class="mobile-main-navigation scroll-nav clearfix ul-li">
                            <ul id="xis-main-nav" class="nav navbar-nav clearfix">
                                <li><a href="{{ route('website.home') }}">الرئيسيه</a></li>
                                <li><a href="{{ route('website.home') }}#aboutus">من نحن</a></li>
                                <li><a href="{{ route('website.home') }}#featured">أهدافنا</a></li>
                                <li><a href="{{ route('website.home') }}#services">خدماتنا</a></li>
                                <li><a href="{{ route('website.home') }}#sponsor">عملائنا</a></li>
                                <li><a href="{{ route('website.contactUs') }}">تواصل معنا</a></li>
                                <li><a href="{{ route('website.Prviacy-ploice') }}"> سياسية الخصوصية</a></li>


                            </ul>
                        </nav>
                        <div class="xis-header-cta-btn mobile_menu_header_btn d-flex">
                            <a class="d-flex justify-content-center align-items-center" href="tel:0555179877⁩">اتصل
                                بنا </a>
                            <a class="d-flex justify-content-center align-items-center active" href="{{ route('website.rate-request.show') }}">طلب تقييم </a>
                        </div>
                    </div>
                </div>
                <!-- /Mobile-Menu -->
            </div>
        </div>
    </div>
</header>
