@extends('tenantLayout')
@section('title', 'Reminder')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto mt-5">
            <a href="{{ route('showReminder') }}" class="btn btn-primary mb-3">Back to Reminder List</a>
            <form class="form" method="POST" action="{{ route('editReminder' , $reminder->reminder_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="desired_price" class="col-sm-3 col-form-label">Desired Price:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="desired_price" name="desired_price" maxlength="50" value="{{ old('desired_price' , $reminder->desired_price) }}">
                        @error('desired_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <br>
                
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
        </div>
    </div>
</div>    

@endsection