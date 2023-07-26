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
        @if ($tenant->tenant_status === 'Activated')
            <form action="{{ route('deactivateTenant', $tenant->tenant_id) }}" method="POST">
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
            <form action="{{ route('activateTenant', $tenant->tenant_id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success">Activate</button>
            </form>
        @endif
        <p>     </p>
        <a href="{{ route('viewTenant') }}" class="btn btn-primary">Back to Tenant List</a>
    </div>
@endsection
