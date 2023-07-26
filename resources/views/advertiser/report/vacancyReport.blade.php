@extends('advertiserLayout')
@section('title', 'Vacancy Report')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <form class="form" method="POST" action="{{ route('generateVacancyReport') }}">
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
            <h3>Vacancy Report</h3>

            <label>Start Date: {{ $fromDate }}</label>
            <br>
            <label>End Date: {{ $toDate }}</label>

            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Property Name</th>
                        <th>Property Type</th>
                        <th>Property Status</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($properties as $index => $property)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $property->property_name }}</td>
                        <td>{{ $property->property_type }}</td>
                        <td>{{ $property->property_rental_status }}</td>
                        <td>{{ $property->property_address_state }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <h4>Summary Information</h4>
                <p>Total Number of Records: {{ $totalCount }}</p>
                <p>Total Number of Rented Unit: {{ $rentedCount }}</p>
                <p>Total Number of Vacant Unit: {{ $vacantCount }}</p>
                <p>Location with the Highest Vacancy Rate: <b>{{ $highestVacancyState }}</b></p>
            </div>
        </div>
    </div>

@endsection