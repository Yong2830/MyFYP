<!DOCTYPE html>
<html>

<head>
    <title>Content Checker Report</title>
    <style>
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

        th,
        td {
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
    <h1>Content Checker Report</h1>

    <div>
        <h2>Content Checker Report</h2>

        <p>Start Date: {{ $fromDate }}</p>
        <p>End Date: {{ $toDate }}</p>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>User Type</th>
                    <th>Rejected/Deactivated Reason</th>
                    <th>Rejected/Deactivated Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if ($user instanceof App\Models\DeactivatedTenant)
                                {{ $user->tenant->tenant_name }}
                            @elseif ($user instanceof App\Models\DeactivatedAdvertiser)
                                {{ $user->advertiser->advertiser_name }}
                            @elseif ($user instanceof App\Models\RejectedTenant)
                                {{ $user->tenant->tenant_name }}
                            @elseif ($user instanceof App\Models\RejectedAdvertiser)
                                {{ $user->advertiser->advertiser_name }}
                            @endif
                        </td>
                        <td>
                            @if ($user instanceof App\Models\DeactivatedTenant || $user instanceof App\Models\RejectedTenant)
                                Tenant
                            @elseif ($user instanceof App\Models\DeactivatedAdvertiser || $user instanceof App\Models\RejectedAdvertiser)
                                Advertiser
                            @endif
                        </td>
                        <td>
                            @if ($user instanceof App\Models\DeactivatedTenant)
                                {{ $user->deactivated_reason }}
                            @elseif ($user instanceof App\Models\DeactivatedAdvertiser)
                                {{ $user->deactivated_reason }}
                            @elseif ($user instanceof App\Models\RejectedTenant)
                                {{ $user->rejected_reason }}
                            @elseif ($user instanceof App\Models\RejectedAdvertiser)
                                {{ $user->rejected_reason }}
                            @endif
                        </td>
                        <td>
                            @if ($user instanceof App\Models\DeactivatedTenant)
                                {{ $user->deactivated_date }}
                            @elseif ($user instanceof App\Models\DeactivatedAdvertiser)
                                {{ $user->deactivated_date }}
                            @elseif ($user instanceof App\Models\RejectedTenant)
                                {{ $user->rejected_date }}
                            @elseif ($user instanceof App\Models\RejectedAdvertiser)
                                {{ $user->rejected_date }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <h4>Summary Information</h4>
            <p>Total Number of Records: {{ $totalRecordCount }}</p>
            <p>Total Number of Rejected/Deactivated Advertiser Times: {{ $totalAdvertiser }}</p>
            <p>Total Number of Rejected/Deactivated Tenant Times: {{ $totalTenant }}</p>
        </div>
    </div>
</body>

</html>
