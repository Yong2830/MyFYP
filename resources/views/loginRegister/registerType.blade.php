@extends('loginRegisterLayout')
@section('title', 'Login')

@section('content')
    <div style="margin-top: 12rem;"></div>
    <h3 class="mb-4">Choose User Registration Type</h3>
        
    <div class="mb-4 d-grid">
        <a href="{{ route('registerTenant') }}" class="btn btn-primary btn-block">Register as Tenant</a>
    </div>

    <div class="mb-4 d-grid">
        <a href="{{ route('registerAdvertiser') }}" class="btn btn-primary btn-block">Register as Advertiser</a>
    </div>

    <p class="text-center">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>

@endsection