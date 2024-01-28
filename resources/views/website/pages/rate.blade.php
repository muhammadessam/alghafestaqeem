@extends('website.layouts.app')
@section('title', 'طلب تقييم عقارى معتمد')
@section('content')

<section class="wizard-section">
    <div class="row no-gutters  justify-content-center">
        <div class="col-11 col-sm-9 col-md-8 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="form-wizard">
                <form id="form" role="form" action="{{ route('website.rate-request.store') }}" method="post" enctype='multipart/form-data'>
                    <h2 class=" ltn__secondary-color-3"><strong>قدم طلب تقييم عقار </strong></h2>
                    @csrf
                    <div class="form-wizard-header">
                        <p>املأ كل حقل النموذج للانتقال إلى الخطوة التالية</p>
                        <ul class="list-unstyled form-wizard-steps clearfix">
                            <li class="active">
                                <span>1</span>
                            </li>
                            <li>
                                <span>2</span>
                            </li>
                            <li>
                                <span>3</span>
                            </li>
                            <li>
                                <span>4</span>
                            </li>
                        </ul>
                    </div>
                    @include('flash::message')
                    <fieldset class="wizard-fieldset show" id="step-1">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h3 class="fs-title"> مقدم الطلب</h3>
                                @include('website.pages.step-1')
                                <div class="form-group clearfix">
                                    <a href="javascript:;" class="form-wizard-next-btn float-right">التالي</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="wizard-fieldset" id="step-2">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h3 class="fs-title"> بيانات العقار</h3>
                                @include('website.pages.step-2')
                                <div class="form-group clearfix">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left">السابق</a>
                                    <a href="javascript:;" class="form-wizard-next-btn float-right">التالي</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="wizard-fieldset" id="step-3">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h3 class="fs-title"> موقع العقار</h3>
                                @include('website.pages.step-3')
                                <div class="form-group clearfix">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left">السابق</a>
                                    <a href="javascript:;" class="form-wizard-next-btn float-right">التالي</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="wizard-fieldset" id="step-4">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h3 class="fs-title"> رفع المستندات</h3>
                                @include('website.pages.step-4')
                                <div class="form-group clearfix">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left">السابق</a>
                                    <button class="form-wizard-submit float-right">إرسال</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
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
