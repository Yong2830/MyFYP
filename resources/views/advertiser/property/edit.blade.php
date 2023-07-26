@extends('advertiserLayout')
@section('title', ' Edit Property Listings')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto mt-5">
            <a href="{{ route('property.index') }}" class="btn btn-primary mb-3">Back to Index</a>
            <form class="form" method="POST" action="{{ route('property.update' , $property->property_id) }}" enctype="multipart/form-data">
                @csrf
                <div id="map" style="height: 400px;"></div>
                @method('PUT')

                <div class="form-group row">
                    <label for="property_image1" class="col-sm-3 col-form-label">Property Images:</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="property_image1" accept="image/*">
                        <br>
                        <img id="preview-img" src="{{ asset('images/' . $property->property_image1) }}" alt="Preview Image" style="height:200px; width: 250px;">
                        @error('property_image1')
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="property_name" class="col-sm-3 col-form-label">Property Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="property_name" name="property_name" maxlength="50" value="{{ old('property_name' , $property->property_name) }}">
                        @error('property_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="property_address" class="col-sm-3 col-form-label">Property Address:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="property_address" name="property_address" maxlength="100" value="{{ old('property_address', $property->property_address) }}">
                        @error('property_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="property_address_state" class="col-sm-3 col-form-label">State:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="property_address_state" name="property_address_state">
                            <option value="Johor">Johor</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Kelantan">Kelantan</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Labuan">Labuan</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Pahang">Pahang</option>
                            <option value="Penang">Penang</option>
                            <option value="Perak">Perak</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Putrajaya">Putrajaya</option>
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Terengganu">Terengganu</option>
                        </select>
                        
                        @error('property_address_state')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="property_postal" class="col-sm-3 col-form-label">Postal Code:</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="property_postal" name="property_postal" value="{{ old('property_postal', $property->property_postal) }}">
                        @error('property_postal')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="property_housing_type" class="col-sm-3 col-form-label">Housing Type:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="property_housing_type" name="property_housing_type">
                            <option value="Condominium">Condominium</option>
                            <option value="Landed">Landed</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="property_type" class="col-sm-3 col-form-label">Property Type:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="property_type" name="property_type">
                            <option value="Whole Unit">Whole Unit</option>
                            <option value="Room">Room</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="property_room_type" class="col-sm-3 col-form-label">Room Type:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="property_room_type" name="property_room_type">
                            <option value="Master">Master Room</option>
                            <option value="Middle">Middle Room</option>
                            <option value="Single">Single Room</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="property_number_room" class="col-sm-3 col-form-label">Number of Rooms:</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="property_number_room" name="property_number_room" value="{{ old('property_number_room', $property->property_number_room) }}">
                        @error('property_number_room')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="property_rental_status" class="col-sm-3 col-form-label">Rental Status:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="property_rental_status" name="property_rental_status">
                            <option value="Vacant">Vacant</option>
                            <option value="Rented">Rented</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="property_description" class="col-sm-3 col-form-label">Description:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="property_description" name="property_description" rows="4">{{ old('property_description', $property->property_description) }}</textarea>
                    </div>
                        
                    @error('property_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group row">
                    <label for="property_feature" class="col-sm-3 col-form-label">Extra Feature:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="property_feature" name="property_feature" value="{{ old('property_feature', $property->property_feature) }}">
                    </div>    
                    @error('property_feature')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group row">
                    <label for="property_price" class="col-sm-3 col-form-label">Price:</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="property_price" name="property_price" value="{{ old('property_price', $property->property_price) }}">
                    </div>
                    @error('property_price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXYCw8sSpsLk3xfAjeuosLGUvfYSrrvmY&libraries=places">
</script>

<script>
let map;
let marker;

function initMap() {
    // Check if geolocation is available in the user's browser
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                const mapOptions = {
                    center: userLocation,
                    zoom: 15,
                };

                map = new google.maps.Map(document.getElementById("map"), mapOptions);

                // Add a click event listener to the map
                map.addListener("click", (event) => {
                    placeMarker(event.latLng);
                });
            },
            (error) => {
                console.error(error);
                // If geolocation fails, fallback to a default center
                const defaultLocation = {
                    lat: 0,
                    lng: 0
                };

                const mapOptions = {
                    center: defaultLocation,
                    zoom: 15,
                };

                map = new google.maps.Map(document.getElementById("map"), mapOptions);

                // Add a click event listener to the map
                map.addListener("click", (event) => {
                    placeMarker(event.latLng);
                });
            }
        );
    } else {
        // If geolocation is not available, fallback to a default center
        const defaultLocation = {
            lat: 0,
            lng: 0
        };

        const mapOptions = {
            center: defaultLocation,
            zoom: 15,
        };

        map = new google.maps.Map(document.getElementById("map"), mapOptions);

        // Add a click event listener to the map
        map.addListener("click", (event) => {
            placeMarker(event.latLng);
        });
    }

    // Add an event listener to the address input field to handle auto navigation
    const addressInput = document.getElementById("property_address");
    addressInput.addEventListener("change", () => {
        const address = addressInput.value;
        if (address.trim() !== "") {
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ address: address }, (results, status) => {
                if (status === google.maps.GeocoderStatus.OK && results[0]) {
                    const location = results[0].geometry.location;
                    map.setCenter(location);
                    placeMarker(location);
                } else {
                    console.error("Geocode was not successful for the following reason: " + status);
                }
            });
        }
    });
}

function placeMarker(location) {
    if (marker) {
        marker.setMap(null); // Remove the previous marker if it exists
    }

    // Create a new marker at the clicked location
    marker = new google.maps.Marker({
        position: location,
        map: map,
        draggable: true // Allow the marker to be dragged by the user
    });

    // Get the address using the Geocoding API
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        location: location
    }, (results, status) => {
        if (status === google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                const address = results[0].formatted_address;
                document.getElementById("property_address").value = address;
            }
        }
    });

    // Add a dragend event listener to the marker to update the property address when the marker is dragged
    marker.addListener("dragend", () => {
        geocoder.geocode({
            location: marker.getPosition()
        }, (results, status) => {
            if (status === google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    const address = results[0].formatted_address;
                    document.getElementById("property_address").value = address;
                }
            }
        });
    });
}

// Initialize the map
initMap();
</script>
@endsection