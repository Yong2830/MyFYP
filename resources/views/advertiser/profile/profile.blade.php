@extends('advertiserLayout')
@section('title', ' Edit Profile Setting')

@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 mx-auto mt-5">
            <a href="{{ route('property.index') }}" class="btn btn-primary mb-3">Back to Index</a>
            <form class="form" method="POST" action="{{ route('updateProfile') }}">
                @csrf
                @method('PUT')
                
                @if(session('info'))
                    <div class="alert alert-success" id="alert">
                        {{ session('info') }}
                    </div>
                @endif

                <div class="form-group row">
                    <label for="advertiser_name" class="col-sm-3 col-form-label">advertiser Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="advertiser_name" name="advertiser_name" maxlength="50" value="{{ old('advertiser_name' , $advertiser->advertiser_name) }}">
                        @error('advertiser_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="advertiser_address" class="col-sm-3 col-form-label">Email Address:</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" maxlength="100" value="{{ old('email', $advertiser->email) }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="advertiser_contact" class="col-sm-3 col-form-label">Contact Number:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="advertiser_contact" name="advertiser_contact" maxlength="100" value="{{ old('advertiser_contact', $advertiser->advertiser_contact) }}">
                        @error('advertiser_contact')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="advertiser_DOB" class="col-sm-3 col-form-label">Date of Birth:</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="advertiser_DOB" name="advertiser_DOB" value="{{ old('advertiser_DOB', $advertiser->advertiser_DOB) }}">
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