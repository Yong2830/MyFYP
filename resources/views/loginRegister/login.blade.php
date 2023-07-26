@extends('loginRegisterLayout')
@section('title', 'Login')

@section('content')
    <div style="margin-top: 8rem;"></div>
    <h3 class="mb-4">Web Based Property Rental System</h3>
    
    <div style="margin-top: 8rem;"></div>
    <h4 class="mb-4">Choose User Login Type</h4>
        
    <div class="mb-4 d-grid">
        <a href="{{ route('loginTenantForm') }}" class="btn btn-primary btn-block">Login as Tenant</a>
    </div>

    <div class="mb-4 d-grid">
        <a href="{{ route('loginAdvertiserForm') }}" class="btn btn-primary btn-block">Login as Advertiser</a>
    </div>

    <div class="mb-4 d-grid">
        <a href="{{ route('loginAdministratorForm') }}" class="btn btn-primary btn-block">Login as Administrator</a>
    </div>
    
    <p class="text-center">Don't have an account? <a href="{{ route('registerType') }}">Sign Up</a></p>
@endsection