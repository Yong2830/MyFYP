@extends('administratorLayout')
@section('title', 'View Tenant')

@section('content')

    <div>
        <h3>Tenant Details</h3>
        <p><strong>Tenant ID:</strong> {{ $tenant->tenant_id }}</p>
        <p><strong>Tenant Name:</strong> {{ $tenant->tenant_name }}</p>
        <p><strong>Tenant Email:</strong> {{ $tenant->email }}</p>
        <p><strong>Tenant Phone No:</strong> {{ $tenant->tenant_contact }}</p>
        <p><strong>Tenant DOB:</strong> {{ $tenant->tenant_DOB }}</p>
        <p><strong>Tenant Status:</strong> {{ $tenant->tenant_status }}</p>
        <p><strong>Registration Date:</strong> {{ $tenant->registration_date }}</p>
        <p><strong>Registration Status:</strong> {{ $tenant->registration_status }}</p>
    </div>

    <div>
        @if ($tenant->registration_status === 'Pending')
            <form action="{{ route('rejectedTenant', $tenant->tenant_id) }}" method="POST">
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

        <form action="{{ route('approveTenant', $tenant->tenant_id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success">Approve</button>
        </form>


        <p> </p>
        <a href="{{ route('tenantApproval') }}" class="btn btn-primary">Back to Registration List</a>
    </div>
@endsection
