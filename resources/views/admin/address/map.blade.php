<x-admin>
    @section('title', 'Address on Map')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $address->user->name }} - {{ $address->name }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.address.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="map" style="height: 60vh; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadGoogleMapsAPI();
        });

        function loadGoogleMapsAPI() {
            var script = document.createElement('script');
            script.src = `https://maps.googleapis.com/maps/api/js?key={{ Config::get('app.GOOGLE_MAP_KEY') }}&libraries=geometry&callback=onGoogleMapsAPILoaded`;
            document.head.appendChild(script);
        }

        function onGoogleMapsAPILoaded() {
            const address = @json($address);
            var latLng = new google.maps.LatLng(address.latitude, address.longitude);
            var mapOptions = {
                center: latLng,
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.SATELLITE
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });
        }
    </script>
</x-admin>
