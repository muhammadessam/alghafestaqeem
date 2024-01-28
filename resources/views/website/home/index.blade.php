@extends('website.layouts.app')
@section('content')
<!-- Start of banner section ============================================= -->
@include('website.home.sections.banner')
<!-- End of banner section ============================================= -->

<section class="cta-section-two">
    <div class="container">
        <div class="inner-container">
            <div class="row clearfix">

                <!-- Title Column -->
                <div class="title-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <h3>قم بتنزيل تطبيقنا لجعل الحياة أسهل </h3>

                    </div>
                </div>

                <!-- Apps Column -->
                <div class="apps-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <a href="{{ $setting->googlePlay ? $setting->googlePlay : '#' }}"><img src="/img/googleplay.png" alt=""></a>
                        <a href="{{ $setting->appStore ? $setting->appStore : '#' }}"><img src="/img/iosstore.png" alt=""></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@include('website.home.sections.about')

@include('website.home.sections.featured')
@include('website.home.sections.services')

<!-- Start of Fun Fact section ============================================= -->
@include('website.home.sections.counter')

<!-- End of Fun Fact section ============================================= -->

<!-- Start of Sponsor section  ============================================= -->
@include('website.home.sections.sponsors')

<!-- End of Sponsor section ============================================= -->

<!-- Start of Contact Us section ============================================= -->
<section id="xis-contact" class="xis-contact-section position-relative">
    <span class="xis-contact-shape3 position-absolute"><img src="/img/shape/side-sh5.png" alt=""></span>
    <span class="xis-contact-shape4 position-absolute"><img src="/img/shape/side-sh6.png" alt=""></span>
    <div class="container-fuild">
        <div class="xis-contact-content position-relative" id="xis-contact-content">
            <span class="xis-contact-shape1 position-absolute"><img src="/img/shape/ct-sh2.png" alt=""></span>
            <span class="xis-contact-shape2 position-absolute"><img src="/img/shape/ct-sh1.png" alt=""></span>
            <div class="xis-section-title text-center headline pera-content">
                <span>تواصل معنا</span>
                <h2>فى خدمتك دائما</h2>
            </div>
            <div class="xis-btn d-flex justify-content-center">
                <a class="d-flex justify-content-center align-items-center" href="tel:{{ $setting->phone }}">{{ $setting->phone }} <i class="far fa-arrow-right"></i></a>
                <a class="d-flex justify-content-center align-items-center" href="{{url('rate-request')}}">طلب تقييم <i class="far fa-arrow-right"></i></a>
            </div>
            <div class="xis-contact-meta text-center">
                السبت to الخميس : 8:صباحا - 8:مساءَ | الجمعة مغلق
            </div>
        </div>
    </div>
</section>
<!-- End of Contact Us section ============================================= -->

@endsection
