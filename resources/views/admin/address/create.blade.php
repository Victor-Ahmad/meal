<x-admin>
    @section('title')
        {{ 'Create Address' }}
    @endsection
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('app.GOOGLE_MAP_KEY') }}&libraries=geometry&callback=initMap"
        async defer></script>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Address</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.address.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.address.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="user" class="form-label">User</label>
                                        <select name="user" id="user" class="form-control">
                                            <option value="" selected disabled>select the User</option>
                                            @foreach ($users as $user)
                                                <option {{ old($user->id) == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Address Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter address name" required value="{{ old('name') }}">
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
                            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let marker; // Global marker variable

        function initMap() {
            $(document).ready(function() {
                var mapOptions = {
                    center: new google.maps.LatLng(24.774265, 46.738586), // Default center
                    zoom: 14,
                    mapTypeId: google.maps.MapTypeId.SATELLITE // Set map type to satellite
                };
                var map = new google.maps.Map(document.getElementById("map"), mapOptions);

                // Listen for clicks on the map.
                google.maps.event.addListener(map, 'click', function(event) {
                    placeMarker(event.latLng, map);
                });
            });
        }

        function placeMarker(location, map) {
            if (marker) {
                // Move the existing marker.
                marker.setPosition(location);
            } else {
                // Create a new marker if one doesn't exist.
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }

            // Update hidden form inputs.
            document.getElementById('latitude').value = location.lat();
            document.getElementById('longitude').value = location.lng();
        }
    </script>

</x-admin>
