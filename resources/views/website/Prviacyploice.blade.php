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
                    <span> سياسية الخصوصية</span>
                </div>
                <div class="xis-btn d-flex justify-content-center">
            
                 {!! $Prviacyploice->privacy_ar !!}
                </div>
               
            </div>
           
        </div>
        
    </section>
   
    @endsection
