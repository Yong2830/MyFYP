@extends('loginRegisterLayout')
@section('title', 'Tenant Registration')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@section('content')
    <div style="margin-top: 2rem;"></div>
    <h3 class="mb-4">Tenant Registration</h3>
    
    <form method="POST" action="{{ route('registerTenantStore') }}">
        @csrf

        <div class="mb-2">
            <label for="tenant_name" class="form-label">Name</label>
            <input type="text" name="tenant_name" id="tenant_name" class="form-control">

            @error('tenant_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        
        <div class="mb-2">
            <label for="tenant_email_address" class="form-label">Email Address</label>
            <input type="email" name="email" id="tenant_email_address" class="form-control">

            @error('tenant_email_address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-2">
            <label for="tenant_contact" class="form-label">Contact Number</label>
            <input type="text" name="tenant_contact" id="tenant_contact" class="form-control">

            @error('tenant_contact')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tenant_DOB" class="form-label">Date of Birth</label>
            <input type="date" name="tenant_DOB" id="tenant_DOB" class="form-control">

            @error('tenant_DOB')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div class="mb-4">
            <label for="tenant_password" class="form-label">Password</label>
            <input type="password" name="password" id="tenant_password" class="form-control">

            @error('tenant_password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-4 d-grid">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
    </form>
    
    <p class="text-center">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
@endsection

