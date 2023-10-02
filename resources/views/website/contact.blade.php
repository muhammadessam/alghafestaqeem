@extends('website.layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section('content')
<style>
    li{
        display: block;
    }
    .xis-contact-content .xis-btn a{
        width: auto;
    }
    .xis-contact-content .xis-btn a
    {
        overflow: initial;
    }
    .xis-btn a i {
    padding-left: 10px;
    }
    .xis-section-title span{
            letter-spacing: 0px !important;
    }
  @media screen and (max-width: 991px){
    .xis-contact-section {
        
    }
    .list-group{
        width: 100%;
    padding: 0px; 
    }
   
    .list-group-item{
        padding:10px ;
    }
    .xis-contact-content .xis-btn a {
    height: auto;
    margin: 15px;
}
  }

    </style>
    <!-- Start of banner section ============================================= -->
    <!-- @include('website.home.sections.banner') -->
    <!-- End of banner section ============================================= -->
<section id="xis-contact" class="xis-contact-section position-relative">
        <div class="container-fuild">
            <div style="    background-image: none!important;
" class="xis-contact-content position-relative" id="xis-contact-content">
                <div   class="xis-section-title text-center headline pera-content">
                    <span>تواصل معنا</span>
                    <h2>فى خدمتك دائما</h2>
                </div>
                <div class="xis-btn d-flex justify-content-center">
              <ul class="list-group">
                <li class="list-group-item">
                <a class="d-flex " href="{{url('rate-request')}}">  <i
                            class="far fa-arrow-left"></i>طلب تقييم</a>
                </li>
                <li    class="list-group-item" >
                <a class="d-flex " href="{{url('/')}}">  <i
                            class="fa fa-map-marker"></i>https://alghafestaqeem.com/</a>
                </li>
                <li class="list-group-item">
                <a class="d-flex "
                        href="tel:{{ $setting->phone }}"><i class="far  fa-phone"></i>{{ $setting->phone }} </a>
                </li>
                <li class="list-group-item">

                            <a class="d-flex " href="https://wa.me/966{{ $setting->whats_app }}">  <i
                            class="fab fa-whatsapp"></i>
                            {{$setting->whats_app}}
                            </a>
                            </li>
                            <li class="list-group-item">

                            <a class="d-flex " href="{{ $setting->youTube }}">  <i
                            class="fab fa-youtube"></i>
                            youtube.com
                            <!--{{ $setting->youTube }}-->
                            </a>
                            </li>
                            <li class="list-group-item">

                            <a class="d-flex " href="{{$setting->linkedIn}}">  <i
                            class="fab fa-linkedin"></i>
                            linkedIn.com
                            <!--{{$setting->linkedIn}} -->
                            </a>
                            </li>
                            <li class="list-group-item">

                            <a class="d-flex " href="{{$setting->twitter}}">  <i
                            class="fab fa-twitter"></i>
                            twitter.com
                            <!--{{$setting->twitter}}-->
                            </a>
                            </li>

                            </ul>
                </div>
                <div class="xis-contact-meta text-center">
                    السبت to الخميس : 8:صباحا - 8:مساءَ | الجمعة مغلق
                </div>
            </div>
           
        </div>
        
    </section>
   
    @endsection
