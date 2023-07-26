@extends('advertiserLayout')
@section('title', 'Index')
@if (session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif
@section('content')
<br>
    <div class="container">

        <div class="header">
            <h2>Propery Listings</h2>
            <hr class="solid">
        </div>

        <div class="row mb-3">
            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="{{ route('property.create') }}" class="btn btn-primary btn-lg">Create Property Listing</a>   
            </div>
        </div>

        <div class="row">
            {{-- <div class="col-md-8 offset-md-2"> --}}
                <table class="table table-bordered">
                    <tr>
                        <th>No.</th>
                        <th>Property Name</th>
                        <th style="width: 380px;">Property Address</th>
                        <th>Property Type</th>
                        <th>Posting Status</th>
                        <th>Property Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($properties as $index =>$p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->property_name }}</td>
                        <td style="width: 380px;">{{ $p->property_address }}</td>
                        <td>{{ $p->property_type }}</td>
                        <td>{{ $p->property_posting_status }}</td>
                        <td>{{ $p->property_rental_status }}</td>
                        <td>
                            <div class="d-inline-block">
                                <a href="{{ route('property.show', $p->property_id)}}" class="btn btn-info btn-sm"">Show</a>
                            </div>                 
                            <div class="d-inline-block">
                                <a href="{{ route('property.edit', $p->property_id)}}" class="btn btn-primary btn-sm"">Edit</a>  
                            </div>
                            <div class="d-inline-block">
                                <form method="post" action="/property/{{ $p->property_id }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this property listing?')">Delete</button>
                                </form>
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
                {{ $properties->links('pagination::bootstrap-5') }}
            </div>
        </div>
        
        <br>
@endsection