<section class="featured-section-four" id="featured">
    <div class="container">
        <div class="row clearfix">
            <!-- Feature Block Four -->
            @if (!empty($result['objectives']))
                @foreach ($result['objectives'] as $item)
                    <div class="feature-block-four col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms"
                            style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                            <img src="{{ $item->image }}" alt="">
                            <h5>{{ $item->title }}</h5>
                            <div class="text">
                                {{ $item->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
