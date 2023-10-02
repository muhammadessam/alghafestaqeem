 <section id="services" class="ximsa-it-blog-section" >
     <div class="container">
         <div class="ximsa-it-blog-top-content   align-items-center">
             <div class="ximsa-it-section-title xis-it-main-headline pera-content text-center">
                 <h2 class="text-uppercase text-center">خدماتنا</h2>
                 <div class="text">نقدم في شركة صالح الغفيص أفضل الخدمات للمستفيدين في جميع مناطق المملكة.
                 </div>

             </div>

         </div>

         <div class="row">
             @if (!empty($result['services']))
                 @foreach ($result['services'] as $item)

                     <div class="ximsa-it-blog-item col-lg-4 ">
                         <div class="inner-img position-relative">
                             <img src="{{ $item->image }}" alt="">
                         </div>
                         <div class="inner-text xis-it-main-headline pera-content">
                             <h3>{{ $item->title }}</h3>
                             <p>{!! $item->description !!}</p>

                         </div>
                     </div>
                 @endforeach
             @endif
         </div>
     </div>
 </section>
