@extends('administratorLayout')
@section('title', 'View Advertiser')

@section('content')

    <div>
        <h3>Advertiser Details</h3>
        <p><strong>Advertiser ID:</strong> {{ $advertiser->advertiser_id }}</p>
        <p><strong>Advertiser Name:</strong> {{ $advertiser->advertiser_name }}</p>
        <p><strong>Advertiser Email:</strong> {{ $advertiser->email }}</p>
        <p><strong>Advertiser Phone No:</strong> {{ $advertiser->advertiser_contact }}</p>
        <p><strong>Advertiser DOB:</strong> {{ $advertiser->advertiser_DOB }}</p>
        <p><strong>Advertiser Status:</strong> {{ $advertiser->advertiser_status }}</p>
        <p><strong>Registration Date:</strong> {{ $advertiser->registration_date }}</p>
        <p><strong>Registration Status:</strong> {{ $advertiser->registration_status }}</p>
    </div>

    <div>
        @if ($advertiser->advertiser_status === 'Activated')
            <form action="{{ route('deactivateAdvertiser', $advertiser->advertiser_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="reason">Deactivation Reason:</label>
                    <input type="text" name="deactivated_reason" id="deactivated_reason" class="form-control">
                </div>
                <p> </p>
                <button type="submit" class="btn btn-danger">Deactivate</button>
            </form>
        @else
            <form action="{{ route('activateAdvertiser', $advertiser->advertiser_id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success">Activate</button>
            </form>
        @endif
        <p>     </p>
        <a href="{{ route('viewLandlord') }}" class="btn btn-primary">Back to Advertiser List</a>
    </div>
@endsection
