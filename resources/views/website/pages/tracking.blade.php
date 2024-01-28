@extends('website.layouts.app')
@section('title', 'طلب تقييم عقارى معتمد')
@section('content')

<section class="wizard-section">
    <div class="row no-gutters  justify-content-center">
        <div class="col-11 col-sm-9 col-md-8 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="form-wizard">

                @if(!isset($order))
                <form id="form" role="form" action="{{ route('website.tracking_number') }}" method="get" enctype='multipart/form-data'>
                    <h2 class=" ltn__secondary-color-3"><strong> تتبع طلبك</strong></h2>
                    @csrf

                    @include('flash::message')




                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="wizard-form-text-label"> أدخل رقم الطلب <span>*</span></label>
                                <input class="form-control wizard-required" required type="text" name="request_no" />


                                <div class="wizard-form-error">
                                    <span class="mb-3">@lang('validation.required',['attribute'=>
                                        __('validation.attributes.request_no')])
                                    </span>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <button class="form-wizard-submit float-right">إرسال</button>
                            </div>
                        </div>
                    </div>
                </form>
                @else

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <h3>رقم الطلب : <span>{{$order->request_no}}</span></h3>
                            <h3>أسم العميل : <span>{{$order->name}}</span></h3>
                            <h3>حالة الطلب : <span>{!!$orderDetails!!}</span></h3>

                        </div>


                    </div><!-- /.row -->
                </div><!-- /.container -->



                @endif
            </div>

        </div>

    </div>
</section>

<!-- End -->
@endsection
@section('js')

<script src="/js/wizard.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHBCkTZlvulHaGrVpSTtS_LstDQJ7n6iM&language=ar">
</script>
<script type="text/javascript">
    let map, marker;

    function initialise() {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
            var latitude = position.coords.latitude;

            var longitude = position.coords.longitude;
            console.log(position.coords)
            var mapCanvas = document.getElementById("mapCanv");

            var myCenter = new google.maps.LatLng(latitude, longitude);
            var mapOptions = {
                center: myCenter
                , zoom: 14
            };
            map = new google.maps.Map(mapCanvas, mapOptions);
            marker = new google.maps.Marker({
                position: myCenter
                , draggable: true
            , });
            marker.setMap(map);
            geocodePosition(marker.getPosition());
            new google.maps.event.addListener(marker, 'dragend', function() {

                geocodePosition(marker.getPosition());
                $("#latitude").val(this.getPosition().lat());
                $("#longitude").val(this.getPosition().lng());

            });

        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
        //var geoloccontrol = new klokantech.GeolocationControl(map, 20);

    }
    $(".locatinId").bind('change paste keyup', function() {
        var latitude = document.getElementById("latitude").value;

        var longitude = document.getElementById("longitude").value;
        var latLng = new google.maps.LatLng(latitude, longitude);
        map.setCenter(latLng);
        marker.setPosition(latLng);

    })
    google.maps.event.addDomListener(window, 'load', initialise);


    function geocodePosition(pos) {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            latLng: pos

        }, function(responses) {
            if (responses && responses.length > 0) {
                $("#location").val(responses[0].formatted_address);
            }
        });
    }

</script>
@endsection
