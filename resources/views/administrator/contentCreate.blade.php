@extends('administratorLayout')
@section('title', 'Content Checker')

@section('content')
<h1>Add Restricted Words</h1>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto mt-5">
            <a href="{{ route('viewCheckerForm') }}" class="btn btn-primary mb-3">Back</a>
            <form class="form" method="POST" action="{{ route('contentStore') }}" enctype="multipart/form-data">
                @csrf

                
                <div class="form-group row">
                    <label for="property_name" class="col-sm-3 col-form-label">Restricted Word:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="word_name" name="word_name" maxlength="50" value="{{ old('word_name') }}">
                        @error('word_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
        
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
        </div>
    </div>
</div>

@endsection