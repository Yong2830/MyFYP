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
        <p><strong>Registration Date:</strong> {{ $advertiser->registration_date }}</p>
        <p><strong>Registration Status:</strong> {{ $advertiser->registration_status }}</p>
    </div>

    <div>
        @if ($advertiser->registration_status === 'Pending')
            <form action="{{ route('rejectedAdvertiser', $advertiser->advertiser_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="reason">Reject Reason:</label>
                    <input type="text" name="rejected_reason" id="rejected_reason" class="form-control">
                </div>
                <p> </p>
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        @else
            <p></p>
        @endif

        <p></p>

        <form action="{{ route('approveAdvertiser', $advertiser->advertiser_id) }}" method="POST"
            style="display: inline-block;">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success">Approve</button>
        </form>


        <p> </p>
        <a href="{{ route('landlordApproval') }}" class="btn btn-primary">Back to Registration List</a>
    </div>
@endsection
