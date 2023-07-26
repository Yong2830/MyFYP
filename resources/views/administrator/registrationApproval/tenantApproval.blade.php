@extends('administratorLayout')
@section('title', 'Tenant Approval List')

@section('content')
<h1>Tenant Registration List</h1>

    <table style="border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 10px;">No.</th>
                <th style="border: 1px solid black; padding-right: 60px; padding-left:10px;">Tenant ID</th>
                <th style="border: 1px solid black; padding-right: 100px; padding-left:10px;">Tenant Name</th>
                <th style="border: 1px solid black; padding-right: 40px; padding-left:10px;">Tenant Email</th>
                <th style="border: 1px solid black; padding-right: 40px; padding-left:10px;">Tenant Phone No</th>
                <th style="border: 1px solid black; padding-right: 40px; padding-left:10px;">Tenant DOB</th>
                <th style="border: 1px solid black; padding-right: 40px; padding-left:10px;">Registration Status</th>
                <th style="border: 1px solid black; padding-right: 40px; padding-left:10px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tenants as $index => $tenant)
                <tr>
                    <td style="border: 1px solid black; padding: 10px;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $tenant->tenant_id }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $tenant->tenant_name }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $tenant->email }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $tenant->tenant_contact }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $tenant->tenant_DOB }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $tenant->registration_status }}</td>

                    <td style="border: 1px solid black; padding: 10px;">

                        <div class="d-inline-block">
                            <a href="{{ route('showTenantApp', $tenant->tenant_id)}}" class="btn btn-info btn-sm">View</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-12 ">
            {{ $tenants->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection