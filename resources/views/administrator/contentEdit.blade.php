@extends('administratorLayout')
@section('title', 'Content Checker')

@section('content')
<h1>Edit Restricted Words</h1>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto mt-5">
            <a href="{{ route('viewCheckerForm') }}" class="btn btn-primary mb-3">Back to Index</a>
            <form class="form" method="POST" action="{{ route('administrator.update' , $word->word_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

    
                
                <div class="form-group row">
                    <label for="property_name" class="col-sm-3 col-form-label">Word Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="word_name" name="word_name" maxlength="50" value="{{ old('word_name' , $word->word_name) }}">
                        @error('property_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>     

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
        </div>
    </div>
</div>

@endsection