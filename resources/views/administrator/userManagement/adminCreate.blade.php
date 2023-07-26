@extends('administratorLayout')
@section('title', 'Admin Registration')

@section('content')

<div style="margin-top: 2rem;"></div>
<a href="{{ route('viewAdmin') }}" class="btn btn-primary mb-3">Back</a>
<h3 class="mb-4">Admin Registration</h3>

<form method="POST" action="{{ route('adminStore') }}">
    @csrf

    <div class="mb-2">
        <label for="administrator_name" class="form-label">Name</label>
        <input type="text" name="administrator_name" id="administrator_name" class="form-control" required>
    </div>
    
    <div class="mb-2">
        <label for="administrator_email_address" class="form-label">Email Address</label>
        <input type="email" name="email" id="administrator_email_address" class="form-control" required>
    </div>
    
    <div class="mb-2">
        <label for="administrator_contact" class="form-label">Contact Number</label>
        <input type="text" name="administrator_contact" id="administrator_contact" class="form-control" required>
    </div>

    <div class="mb-4">
        <label for="administrator_DOB" class="form-label">Date of Birth</label>
        <input type="date" name="administrator_DOB" id="administrator_DOB" class="form-control" required>
    </div>

    <br>

    <div class="mb-1">
        <label for="administrator_password" class="form-label">Password</label>
        <input type="password" name="password" id="administrator_password" class="form-control" required>
    </div>
    
    <div class="mb-4 d-grid">
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </div>
</form>


@endsection