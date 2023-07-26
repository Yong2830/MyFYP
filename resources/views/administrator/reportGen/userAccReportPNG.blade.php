<!DOCTYPE html>
<html>
<head>
    <title>User Account Report</title>
    <!-- Add your CSS styling here -->
    <style>
        /* Example CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .summary {
            margin-top: 20px;
            padding: 10px;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>User Account Management Report</h1>

    <div>
        <h2>User Account Management Report</h2>

        <p>Start Date: {{ $fromDate }}</p>
        <p>End Date: {{ $toDate }}</p>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>User Type</th>
                    <th>User Status</th>
                    <th>Registration Date</th>
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

        <div class="summary">
            <h3>Summary Information</h3>
            <p>Total Number of Records: {{ $totalRecordCount }}</p>
            <p>Total Number of Advertisers: {{ $advertiserCount }}</p>
            <p>Total Number of Tenants: {{ $tenantCount }}</p>
            <p>Total Number of Active Users: {{ $totalActiveUserCount }}</p>
            <p>Total Number of Deactivated Users: {{ $totalDeactivatedUserCount }}</p>
        </div>
    </div>
</body>
</html>
