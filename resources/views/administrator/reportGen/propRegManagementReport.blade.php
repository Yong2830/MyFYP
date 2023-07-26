@extends('administratorLayout')
@section('title', 'Property Registration Management Report')

@section('content')
    <h1>Property Registration Management Report</h1>

    <form class="form" method="POST" action="{{ route('generatePropRegManagementReport') }}">
        @csrf

        <div class="form-group">
            <label for="property_posting_status">Property Posting Status:</label>
            <select class="form-control" id="property_posting_status" name="property_posting_status">
                <option value="All" {{ $propertyType == 'All' ? 'selected' : '' }}>All</option>
                <option value="Pending" {{ $propertyType == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Rejected" {{ $propertyType == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="Success" {{ $propertyType == 'Success' ? 'selected' : '' }}>Success</option>
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
            <h3>Property Registration Management Report</h3>

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

            <div>
                <h4>Summary Information</h4>
                <p>Total Number of Records: {{ $propertyCount }}</p>
                <p>Total Number of Approved Property: {{ $successPropertyCount }}</p>
                <p>Total Number of Rejected Property: {{ $rejectedPropertyCount }}</p>
                <p>Total Number of Pending Property: {{ $pendingPropertyCount }}</p>
                <br>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 ">
            {{ $property->links('pagination::bootstrap-5') }}
        </div>
    </div>


@endsection
