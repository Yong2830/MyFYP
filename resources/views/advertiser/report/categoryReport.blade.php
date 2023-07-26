@extends('advertiserLayout')
@section('title', 'Category Report')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <form class="form" method="POST" action="{{ route('generateCategoryReport') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="from_date">From Date:</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" value="{{ old('from_date' , $fromDate) }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="to_date">To Date:</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" value="{{ old('toDate' , $toDate) }}">
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary" name="generate">Generate Report</button>
                        <button type="submit" class="btn btn-primary" name="download" formaction="" formtarget="_blank">Download Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Category Report</h3>

            <label>Start Date: {{ $fromDate }}</label>
            <br>
            <label>End Date: {{ $toDate }}</label>

            <br>
            <table class="table table-bordered">
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
            <div>
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

@endsection