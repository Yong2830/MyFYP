@extends('loginRegisterLayout')
@section('title', 'Advertiser Registration')
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
    <h3 class="mb-4">Advertiser Registration</h3>
    
    <form method="POST" action="{{ route('registerAdvertiserStore') }}">
        @csrf

        <div class="mb-2">
            <label for="advertiser_name" class="form-label">Name</label>
            <input type="text" name="advertiser_name" id="advertiser_name" class="form-control" required>
        </div>
        
        <div class="mb-2">
            <label for="advertiser_email_address" class="form-label">Email Address</label>
            <input type="email" name="email" id="advertiser_email_address" class="form-control" required>
        </div>
        
        <div class="mb-2">
            <label for="advertiser_contact" class="form-label">Contact Number</label>
            <input type="text" name="advertiser_contact" id="advertiser_contact" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="advertiser_DOB" class="form-label">Date of Birth</label>
            <input type="date" name="advertiser_DOB" id="advertiser_DOB" class="form-control" required>
        </div>

        <br>

        <div class="mb-1">
            <label for="advertiser_password" class="form-label">Password</label>
            <input type="password" name="password" id="advertiser_password" class="form-control" required>
        </div>
        
        <div class="mb-4 d-grid">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
    </form>
    
    <p class="text-center">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
@endsection