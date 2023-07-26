@extends('loginRegisterLayout')
@section('title', 'Login')

@section('content')
    <div style="margin-top: 12rem;"></div>
    <h3 class="mb-4">Web Based Property Rental System</h3>
    
    <form method="POST" action="{{ route('loginAdministratorAction') }}">
        @csrf
        
        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" autofocus>

            @error('tenant_email_address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">

            @error('tenant_password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-4 d-grid">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
    </form>
    
    <p class="text-center">Don't have an account? <a href="{{ route('registerType') }}">Sign Up</a></p>
@endsection