<x-admin>
    @section('title', 'Order Map')

    <script src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('app.GOOGLE_MAP_KEY') }}&libraries=geometry&callback=initMap" async defer></script>
    
    <div id="map" style="height: 400px; width: 100%;"></div>

    <script>
        function initMap() {
            var mapOptions = {
                center: new google.maps.LatLng(24.774265, 46.738586), // Riyadh, Saudi Arabia
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.SATELLITE // Set map type to satellite
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        }
    </script>
</x-admin>
