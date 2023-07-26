@extends('tenantLayout')
@section('title', 'Tenant')

@section('content')
    <br>

    <form action="{{ route('showHome') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search properties...">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    @foreach ($properties as $p)
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-auto">
                    <img src="{{ asset('images/' . $p->property_image1) }}" alt="Property Image">
                </div>
                <div class="col-md">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->property_name }}</h5>
                        <p class="card-text">{{ $p->property_feature }}</p>
                        <p class="card-text">Price: {{ $p->property_price }}</p>
                        <p class="card-text">Address: {{ $p->property_address }}</p>
                        <a href="{{ route('showHomeProperty', $p->property_id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-md-12 ">
            {{ $properties->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection