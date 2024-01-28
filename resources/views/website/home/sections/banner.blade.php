<section id="xis-banner" class="xis-banner-section" data-background="{{ $setting->imagePath('slider_image') != '' ? $setting->imagePath('slider_image') : '/img/banner/banner.png' }}">
    <div class="container">
        <div class="xis-banner-content position-relative">
            <div class="xis-banner-img scene">
                <div class="inner-img">
                    <img class="layer" data-depth="0.2" src="/img/banner/bn1.png" alt="">
                </div>
                <div class="shape-img1">
                    <img src="/img/banner/bn-sh1.png" alt="">
                </div>
            </div>
            <div class="xis-banner-text headline pera-content">

                <h1 class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                    {!! $setting->slider !!} <br> </h1>
                <div class="xis-btn wow fadeInUp" data-wow-delay="700ms" data-wow-duration="1500ms">
                    <a class="d-flex justify-content-center align-items-center" href="{{url('rate-request')}}">اطلب تقييم <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .xis-banner-content .xis-banner-text h1 {
        width: 55%;
    }

</style>
