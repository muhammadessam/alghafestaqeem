<section class="about-section" id="aboutus">
    <div class="container">
        <div class="row clearfix">
            <!-- Image Column -->
            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column parallax-scene-1 wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none; visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                    <div class="image" data-depth="0.40" style="transform: translate3d(0.2px, -6.7px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                        <img src="{!! $setting->imagePath('about_image') !!}" alt="">
                    </div>
                </div>
            </div>
            <!-- Content Column -->
            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <h2><span>عن الشركة</span></h2>
                        <div class="text">
                            {!! $setting->about !!}
                        </div>
                    </div>

                    <!-- Company Info Tabs -->
                    <div class="company-info-tabs">
                        <!-- Company Tabs -->
                        <div class="company-tabs tabs-box">

                            <!-- Tab Btns -->
                            <ul class="tab-btns tab-buttons clearfix">
                                <li data-tab="#prod-quality" class="tab-btn active-btn">
                                    <span class="icon">
                                        <img src="/img/icon/icon-1.png" alt="">
                                    </span>
                                    صالح بن علي الغفيص
                                </li>

                            </ul>

                            <!-- Tabs Container -->
                            <div class="tabs-content">
                                <!-- Tab / Active Tab -->
                                <div class="tab active-tab" id="prod-quality" style="display: block;">
                                    <div class="content">
                                        <div class="text">
                                            @if (!empty($result['about']))
                                            @foreach ($result['about'] as $item)
                                            <span class="mb10">
                                                <img src="/img/icon/check-circle.png" alt="">
                                                {{ $item->title }}
                                            </span>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
