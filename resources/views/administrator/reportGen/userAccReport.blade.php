@extends('administratorLayout')
@section('title', 'User Account Report')

@section('content')
    <h1>User Account Management Report</h1>

    <form class="form" method="POST" action="{{ route('generateUserAccManagementReport') }}">
        @csrf

        <div class="form-group">
            <label for="user_type">User Type:</label>
            <select class="form-control" id="user_type" name="user_type">
                <option value="All" {{ $userType == 'All' ? 'selected' : '' }}>All</option>
                <option value="Tenant" {{ $userType == 'Tenant' ? 'selected' : '' }}>Tenant</option>
                <option value="Advertiser" {{ $userType == 'Advertiser' ? 'selected' : '' }}>Advertiser</option>
            </select>
        </div>

        <div class="form-group">
            <label for="user_status">User Status:</label>
            <select class="form-control" id="user_status" name="user_status">
                <option value="All" {{ $userStatus == 'All' ? 'selected' : '' }}>All</option>
                <option value="Activated" {{ $userStatus == 'Activated' ? 'selected' : '' }}>Activated</option>
                <option value="Deactivated" {{ $userStatus == 'Deactivated' ? 'selected' : '' }}>Deactivated</option>
            </select>
        </div>

        <div class="form-group">
            <label for="from_date">From Date:</label>
            <input type="date" class="form-control" id="from_date" name="from_date"
                value="{{ old('from_date', $fromDate) }}">
        </div>

        <div class="form-group">
            <label for="to_date">To Date:</label>
            <input type="date" class="form-control" id="to_date" name="to_date" value="{{ old('to_date', $toDate) }}">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary" name="generate">Generate Report</button>
            <button type="submit" class="btn btn-primary" name="download" formaction="" formtarget="_blank">Download
                Report</button>
        </div>
    </form>




    <div class="row mt-5">
        <div class="col-md-12">
            <h3>User Account Management Report</h3>

            <label>Start Date: {{ $fromDate }}</label>
            <br>
            <label>End Date: {{ $toDate }}</label>

            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>User Type</th>
                        <th>User Status</th>
                        <th>Registratio Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($user instanceof App\Models\Tenant)
                                    {{ $user->tenant_name }}
                                @elseif ($user instanceof App\Models\Advertiser)
                                    {{ $user->advertiser_name }}
                                @endif
                            </td>
                            <td>
                                @if ($user instanceof App\Models\Tenant)
                                    Tenant
                                @elseif ($user instanceof App\Models\Advertiser)
                                    Advertiser
                                @endif
                            </td>
                            <td>
                                @if ($user instanceof App\Models\Tenant)
                                    {{ $user->tenant_status }}
                                @elseif ($user instanceof App\Models\Advertiser)
                                    {{ $user->advertiser_status }}
                                @endif
                            </td>
                            <td>{{ $user->registration_date }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div>
                <h4>Summary Information</h4>
                <p>Total Number of Records: {{ $totalRecordCount }}</p>
                <p>Total Number of Advertiser: {{ $advertiserCount }}</p>
                <p>Total Number of Tenant: {{ $tenantCount }}</p>
                <p>Total Number of Active Users: {{ $totalActiveUserCount }}</p>
                <p>Total Number of Deactivated Users: {{ $totalDeactivatedUserCount }}</p>
                <br>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 ">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
