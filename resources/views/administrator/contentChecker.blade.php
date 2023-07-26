@extends('administratorLayout')
@section('title', 'Content Checker')

@section('content')
<h1>Restricted Words</h1>

<div class="row mb-3">
    <div class="d-grid gap-2 col-6 mx-auto">
        <a href="{{ route('createContent') }}" class="btn btn-primary btn-lg">Add New Restricted Words</a>   
    </div>
</div>
<table style="border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border: 1px solid black; padding: 10px;">No.</th>
            <th style="border: 1px solid black; padding-right: 60px; padding-left:10px;">Word ID</th>
            <th style="border: 1px solid black; padding-right: 100px; padding-left:10px;">Word Name</th>
            <th style="border: 1px solid black; padding-right: 100px; padding-left:10px;">Administrator ID</th>
            <th style="border: 1px solid black; padding-right: 100px; padding-left:10px;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($words as $index => $word)
            <tr>
                <td style="border: 1px solid black; padding: 10px;">{{ $index + 1 }}</td>
                <td style="border: 1px solid black; padding: 10px;">{{ $word->word_id }}</td>
                <td style="border: 1px solid black; padding: 10px;">{{ $word->word_name }}</td>
                <td style="border: 1px solid black; padding: 10px;">{{ $word->administrator_id }}</td>
                <td style="border: 1px solid black; padding: 10px;">
                    <a href="{{ route('administrator.edit', $word->word_id)}}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('deleteWord', $word->word_id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this restricted word?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
        <div class="col-md-12 ">
            {{ $words->links('pagination::bootstrap-5') }}
        </div>
    </div>


@endsection