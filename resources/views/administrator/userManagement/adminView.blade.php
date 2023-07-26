@extends('administratorLayout')
@section('title', 'Admin List')

@section('content')
    <h1>Admin List</h1>

    <div class="row mb-3">
        <div class="d-grid gap-2 col-6 mx-auto">
            <a href="{{ 'adminCreate' }}" class="btn btn-primary btn-lg">Add Admin</a>
        </div>
    </div>
    <table style="border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 10px;">No.</th>
                <th style="border: 1px solid black; padding-right: 60px; padding-left:10px;">Administrator ID</th>
                <th style="border: 1px solid black; padding-right: 100px; padding-left:10px;">Administrator Name</th>
                <th style="border: 1px solid black; padding-right: 80px; padding-left:10px;">Administrator Email</th>
                <th style="border: 1px solid black; padding-right: 80px; padding-left:10px;">Administrator Phone No</th>
                <th style="border: 1px solid black; padding-right: 80px; padding-left:10px;">Administrator DOB</th>
                <th style="border: 1px solid black; padding-right: 100px; padding-left:10px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $index => $admin)
                <tr>
                    <td style="border: 1px solid black; padding: 10px;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $admin->administrator_id }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $admin->administrator_name }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $admin->email }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $admin->administrator_contact }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $admin->administrator_DOB }}</td>
                    <td style="border: 1px solid black; padding: 10px;">
                        @if (auth()->guard('administrator')->user()->administrator_id == 'AD0001')
                            @if ($index > 0)
                                {{-- Check if it's not the first admin --}}
                                <form action="{{ route('deleteAdmin', $admin->administrator_id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this admin')">Delete</button>
                                </form>
                            @else
                                <span class="text-muted">Not deletable</span>
                            @endif
                        @else
                            <span class="text-muted">Not deletable</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-12 ">
            {{ $admins->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
