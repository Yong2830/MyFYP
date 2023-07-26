@extends('administratorLayout')
@section('title', 'Admin Profile Settings')

@section('content')

<div class="row">
    <div class="col-md-6 mx-auto mt-5">
        <form class="form" method="POST" action="{{ route('updateAdminProfile') }}">
            @csrf
            @method('PUT')
            
            @if(session('info'))
                <div class="alert alert-success" id="alert">
                    {{ session('info') }}
                </div>
            @endif

            <div class="form-group row">
                <label for="administrator_name" class="col-sm-3 col-form-label">advertiser Name:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="administrator_name" name="administrator_name" maxlength="50" value="{{ old('administrator_name' , $administrator->administrator_name) }}">
                    @error('advertiser_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="administrator_address" class="col-sm-3 col-form-label">Email Address:</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" maxlength="100" value="{{ old('email', $administrator->email) }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="administrator_contact" class="col-sm-3 col-form-label">Contact Number:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="administrator_contact" name="administrator_contact" maxlength="100" value="{{ old('administrator_contact', $administrator->administrator_contact) }}">
                    @error('administrator_contact')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="administrator_DOB" class="col-sm-3 col-form-label">Date of Birth:</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="administrator_DOB" name="administrator_DOB" value="{{ old('administrator_DOB', $administrator->administrator_DOB) }}">
                    @error('advertiser_DOB')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Change Password:</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm New Password:</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="mb-4 d-grid">
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </div>
        </form>
    </div>
</div>


@endsection