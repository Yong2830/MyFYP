@extends('administratorLayout')
@section('title', 'Property Details For Approval')

@section('content')
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto mt-5">
                        <h2>Property Details</h2>
                        <hr>

                        <form class="form" method="POST"
                            action="{{ route('handleApproveRejectRequest', $property->property_id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="property_image" class="col-sm-3 col-form-label">Property Image:</label>
                                <div class="col-sm-9">
                                    <img src="{{ asset('images/' . $property->property_image1) }}" alt="Property Image"
                                        style="max-width: 100%;">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_name" class="col-sm-3 col-form-label">Property Name:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_name }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_address" class="col-sm-3 col-form-label">Property Address:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_address }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_address_state" class="col-sm-3 col-form-label">State:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_address_state }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_postal" class="col-sm-3 col-form-label">Postal Code:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_postal }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_housing_type" class="col-sm-3 col-form-label">Housing Type:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_housing_type }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_type" class="col-sm-3 col-form-label">Property Type:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_type }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_room_type" class="col-sm-3 col-form-label">Room Type:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_room_type }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_number_room" class="col-sm-3 col-form-label">Number of Rooms:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_number_room }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_rental_status" class="col-sm-3 col-form-label">Rental Status:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_rental_status }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_description" class="col-sm-3 col-form-label">Description:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_description }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_feature" class="col-sm-3 col-form-label">Extra Feature:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_feature }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_price" class="col-sm-3 col-form-label">Price:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ $property->property_price }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="property_number_room" class="col-sm-3 col-form-label">Reject Reason:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="reject_reason" name="reject_reason">
                                    @error('reject_reason')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            <button type="submit" class="btn btn-primary" name="action" value="approve">Approve</button>
                            <button type="submit" class="btn btn-danger" name="action" value="reject">Reject</button>
                        </form>
                    </div>
                </div>

                <br>
            </div>
            <a href="{{ route('showAllPropertyApproval') }}" class="btn btn-primary mb-3">Back to All pending approval
                listing</a>
        </div>
    </div>


@endsection
