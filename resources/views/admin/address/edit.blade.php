<x-admin>
    @section('title')
        {{ 'Edit Address' }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Address</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.address.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.address.update', $data) }}"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="user" class="form-label">User</label>
                                        <select name="user" id="user" class="form-control">
                                            <option value="" selected disabled>select the User</option>
                                            @foreach ($users as $user)
                                                <option {{ $data->user->id == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Address Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter address name" required value="{{ $data->name }}">
                                    </div>
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="map" style="height: 60vh; width: 100%;"></div>
                                </div>
                            </div>
                            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', $data->latitude) }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude', $data->longitude) }}">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                    </form>
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
            // Use the coordinates from `$data` to center the map and place the marker.
            var initialPosition = new google.maps.LatLng({{ $data->latitude }}, {{ $data->longitude }});

            var mapOptions = {
                center: initialPosition,
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.SATELLITE
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

            // Place a marker on the initial position.
            let marker = new google.maps.Marker({
                position: initialPosition,
                map: map,
                draggable: true // Make the marker draggable if needed
            });

            // Listen for clicks on the map to move the marker.
            google.maps.event.addListener(map, 'click', function(event) {
                placeMarker(event.latLng, map, marker);
            });

            // Optionally, listen for dragend event if marker is draggable.
            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });
        }

        function placeMarker(location, map, marker) {
            // Move the existing marker.
            marker.setPosition(location);

            // Update hidden form inputs.
            document.getElementById('latitude').value = location.lat();
            document.getElementById('longitude').value = location.lng();
        }
    </script>
</x-admin>
