<!DOCTYPE html>
<html>

<head>
    <title>Property Registration Management Report</title>
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
    <h1>Property Registration Management Report</h1>

    <div>
        <h2>Property Registration Management Report</h2>

        <p>Start Date: {{ $fromDate }}</p>
        <p>End Date: {{ $toDate }}</p>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Property Name</th>
                    <th>Property Type</th>
                    <th>Property Registration Status</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($property as $index => $prop)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $prop->property_name }}</td>
                        <td>{{ $prop->property_type }}</td>
                        <td>{{ $prop->property_posting_status }}</td>
                        <td>{{ $prop->property_post_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <h3>Summary Information</h3>
            <p>Total Number of Records: {{ $propertyCount }}</p>
            <p>Total Number of Approved Property: {{ $successPropertyCount }}</p>
            <p>Total Number of Rejected Property: {{ $rejectedPropertyCount }}</p>
            <p>Total Number of Pending Property: {{ $pendingPropertyCount }}</p>
        </div>
    </div>
</body>

</html>
