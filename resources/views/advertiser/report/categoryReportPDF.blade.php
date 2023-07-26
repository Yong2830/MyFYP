<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category Report</title>

    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .generated-date {
            text-align: right;
            margin-bottom: 10px;
        }

        .summary-table {
            border-collapse: collapse;
            width: 100%;
        }

        .summary-table th,
        .summary-table td {
            border: 1px solid #000;
            padding: 8px;
        }

        .summary-info {
            margin-top: 20px;
        }

        .summary-info h4 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>

</head>
<body>
    <div class="header">
        <h2>Property Category Report</h2>
    </div>

    <div class="generated-date">
        <p>Generated Date: {{ date('Y-m-d') }}</p>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Category Report</h3>

            <p>Start Date: {{ $fromDate }}</p>
            <p>End Date: {{ $toDate }}</p>

            <table class="summary-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Property Name</th>
                        <th>Housing Type</th>
                        <th>Property Type</th>
                        <th>Property Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($properties as $index => $property)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $property->property_name }}</td>
                        <td>{{ $property->property_housing_type }}</td>
                        <td>{{ $property->property_type }}</td>
                        <td>{{ $property->property_rental_status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="summary-info">
                <h4>Summary Information</h4>
                <p>Total Number of Records: {{ $totalCount }}</p>
                <p>Total Number of Landed Type: {{ $landedCount }}</p>
                <p>Total Number of Condominium Type: {{ $condominiumCount }}</p>

                <br>

                <p>Housing Type with the Highest Rented Rate: <b>{{ $highestRentedHousingType }}</b></p>
                <p>Property Type with the Highest Rented Rate: <b>{{ $highestRentedPropertyType }}</b></p>
            </div>
        </div>
    </div>


</body>
</html>
       
    