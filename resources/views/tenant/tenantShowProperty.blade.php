@extends('tenantLayout')
@section('title', 'Tenant')

@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-50" src="{{ asset('images/' . $property->property_image1) }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-50" src="{{ asset('images/' . $property->property_image1) }}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-50" src="{{ asset('images/' . $property->property_image1) }}" alt="Third slide">
                    </div>
                    </div>

                    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only"></span>
                    </a>

                    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only"></span>
                    </a>
                </div>
            
                <div class="property-details mt-4 shadow-sm">
                    <h2>{{ $property->property_name }}</h2>
                    <p class="text-primary">Price: ${{ $property->property_price }}/month</p>
                    <p class="text-secondary">Address: {{ $property->property_address }}</p>
                </div>
            </div>
        </div>
        
        <div class="row mt-2 justify-content-between"> 
            <div class="description col-md-8 shadow-sm">
                <h3>Description</h3>
                <p>{{ $property->property_description }}</p>
            </div>
                        
            <div class="col-md-3 shadow-sm" >
                <div class="advertiser-section mt-4">
                    <h3>Advertiser</h3>
                    <p>Name: {{ $advertiser->advertiser_name }}</p>
                    <p>Member since: {{ $advertiser->advertiser_DOB }}</p>
                </div>
      
                <div class="buttons mt-4">
                    @if (Auth::check() && !$chatList->where('advertiser_id', $advertiser->advertiser_id)->isEmpty())
                        <p>This Owner is already in your chat list.</p>
                    @else
                        <form action="{{ route('showChatHistory', $advertiser->advertiser_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Chat with Owner</button>
                        </form>
                    @endif
                    
                    <br>
                    @if (Auth::check() && !$property->reminder->where('tenant_id', Auth::user()->tenant_id)->isEmpty())
                        <p>This property is already in your reminder list.</p>
                    @else
                        <form action="{{ route('reminder.addReminder', $property->property_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add to Reminder</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        

        <div class="row mt-4 shadow">
          <div class="col-md-8">
            <div class="property-rental-details">
              <h3>Property &amp; Rental Details</h3>
              <p>Housing Type: {{ $property->property_housing_type }}</p>
              <p>Posted Date: {{ $property->property_post_date }}</p>
              <p>Property Type: {{ $property->property_type }}</p>
              <p>Rental Fee: ${{ $property->property_price }}</p>
              <p>Extra Feature: {{ $property->property_feature }}</p>
            </div>
          </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

