@extends('administratorLayout')
@section('title', 'All Property')

@section('content')
<div class="container">

    <div class="header">
        <h2>All Pending Property Listings</h2>
        <hr class="solid">
    </div>

    <div class="row">
        {{-- <div class="col-md-8 offset-md-2"> --}}
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Property Name</th>
                    <th>Property Address</th>
                    <th>Property Type</th>
                    <th>Posting Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($property as $index =>$p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->property_name }}</td>
                    <td>{{ $p->property_address }}</td>
                    <td>{{ $p->property_type }}</td>
                    <td>{{ $p->property_posting_status }}</td>
                    <td>
                        <div class="d-inline-block">
                            <a href="{{ route('showProperty', $p->property_id)}}" class="btn btn-info btn-sm"">Show</a>
                        </div>                 
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    
    {{-- For showing pagination --}}
    <div class="row">
        <div class="col-md-12 ">
            {{ $property->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection