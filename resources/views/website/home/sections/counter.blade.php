<section id="xis-fun-fact" class="xis-fun-fact-section position-relative">
    <span class="xis-fun-shape2 position-absolute" data-parallax='{"y" : 100, "rotateY":200}'><img
            src="/img/shape/circle1.png" alt=""></span>
    <span class="xis-fun-shape3 position-absolute" data-parallax='{"y" : 200}'><img src="/img/shape/side-sh1.png"
            alt=""></span>
    <span class="xis-fun-shape4 position-absolute" data-parallax='{"y" : -100}'><img src="/img/shape/side-sh2.png"
            alt=""></span>
    <span class="xis-fun-shape5 position-absolute"><img src="/img/shape/sh1.png" alt=""></span>
    <div class="container">
        <div class="xis-fun-fact-content position-relative">
            <div class="xis-fun-shape1 position-absolute"><img src="/img/shape/cn-sh1.png" alt=""></div>
            <div class="row">
                @if (!empty($result['counters']))
                    @foreach ($result['counters'] as $item)

                        <div class="col-lg-4 col-md-12">
                            <div class="xis-fun-fact-inner-item position-relative text-center">
                                <div class="xis-inner-text headline pera-content">
                                    <h3><span class="odometer"
                                            data-count="{{ $item->counter }}"></span>{{ $item->sign }}
                                    </h3>
                                    <p>
                                        {{ $item->title }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
