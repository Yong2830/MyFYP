@extends('tenantLayout')
@section('title', 'Reminder')

@section('content')
<div class="container">
    <h1>Reminder</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Property Name</th>
                <th>Property Address</th>
                <th>Property Type</th>
                <th>Original Price</th>
                <th>Desired Price</th>
                <th>Indicator</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reminders as $index => $reminder)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $reminder->propertyListing->property_name }}</td>
                <td>{{ $reminder->propertyListing->property_address }}</td>
                <td>{{ $reminder->propertyListing->property_type }}</td>
                <td>{{ $reminder->propertyListing->property_price }}</td>
                <td>{{ $reminder->desired_price }}</td>
                <td>{{ $reminder->price_change_indicator }}</td>
                <td>
                    <a href="{{ route('showEditReminder', $reminder->reminder_id) }}" class="btn btn-primary">Edit Reminder</a>
                    <a href="{{ route('showHomeProperty', $reminder->propertyListing->property_id) }}" class="btn btn-primary">View Property</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection