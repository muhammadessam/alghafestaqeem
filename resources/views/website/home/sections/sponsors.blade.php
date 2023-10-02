<section id="sponsor" class="xis-sponsor-section">
    <div class="container">
        <div class="sec-title text-center">
            <h2><span>من عملائنا</span></h2>
        </div>
    </div>
    <div class="xis-sponsor-content">
        <div class="xis-sponsor-item-wrapper">
            @if (!empty($result['clients']))
                @foreach ($result['clients'] as $item)
                    <div class="xis-sponsor-item">
                        <img src="{{ $item->image }}" alt="{{ $item->title }}">
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
