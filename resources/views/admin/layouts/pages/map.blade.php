<script type="text/javascript">
    function initialise() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById("latitude-field").value = position.coords.latitude;
                document.getElementById("longitude-field").value = position.coords.longitude;
                var latitude = position.coords.latitude;

                var longitude = position.coords.longitude;

                var mapCanvas = document.getElementById("mapCanv");

                var myCenter = new google.maps.LatLng(latitude, longitude);
                var mapOptions = {
                    center: myCenter,
                    zoom: 14
                };
                var map = new google.maps.Map(mapCanvas, mapOptions);
                var marker = new google.maps.Marker({
                    position: myCenter,
                    draggable: true,
                });
                marker.setMap(map);
                geocodePosition(marker.getPosition());
                new google.maps.event.addListener(marker, 'dragend', function() {

                    geocodePosition(marker.getPosition());
                    $("#latitude-field").val(this.getPosition().lat());
                    $("#longitude-field").val(this.getPosition().lng());

                });

            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            var latitude = document.getElementById("latitude-field").value;

            var longitude = document.getElementById("longitude-field").value;

            var mapCanvas = document.getElementById("mapCanv");

            var myCenter = new google.maps.LatLng(latitude, longitude);
            var mapOptions = {
                center: myCenter,
                zoom: 14
            };
            var map = new google.maps.Map(mapCanvas, mapOptions);
            var marker = new google.maps.Marker({
                position: myCenter,
                draggable: true,
            });
            marker.setMap(map);
            geocodePosition(marker.getPosition());
            new google.maps.event.addListener(marker, 'dragend', function() {

                geocodePosition(marker.getPosition());
                $("#latitude-field").val(this.getPosition().lat());
                $("#longitude-field").val(this.getPosition().lng());

            });
        }

        //var geoloccontrol = new klokantech.GeolocationControl(map, 20);

    }

    google.maps.event.addDomListener(window, 'load', initialise);

    function geocodePosition(pos) {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            latLng: pos

        }, function(responses) {
            if (responses && responses.length > 0) {
                //   updateMarkerAddress(responses[0].formatted_address);
                $("#address_ar-field").val(responses[0].formatted_address);
            } else {
                // updateMarkerAddress('Cannot determine address at this location.');
            }
        });
    }

</script>
