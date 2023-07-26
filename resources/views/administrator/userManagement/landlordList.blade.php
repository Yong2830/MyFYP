@extends('administratorLayout')
@section('title', 'Advertiser List')

@section('content')
    <h1>Advertiser List</h1>

    <table style="border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 10px;">No.</th>
                <th style="border: 1px solid black; padding-right: 60px; padding-left:10px;">Advertiser ID</th>
                <th style="border: 1px solid black; padding-right: 100px; padding-left:10px;">Advertiser Name</th>
                <th style="border: 1px solid black; padding-right: 40px; padding-left:10px;">Advertiser Email</th>
                <th style="border: 1px solid black; padding-right: 40px; padding-left:10px;">Advertiser Phone No</th>
                <th style="border: 1px solid black; padding-right: 40px; padding-left:10px;">Advertiser DOB</th>
                <th style="border: 1px solid black; padding-right: 40px; padding-left:10px;">Advertiser Status</th>
                <th style="border: 1px solid black; padding-right: 40px; padding-left:10px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($advertisers as $index => $advertiser)
                <tr>
                    <td style="border: 1px solid black; padding: 10px;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $advertiser->advertiser_id }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $advertiser->advertiser_name }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $advertiser->email }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $advertiser->advertiser_contact }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $advertiser->advertiser_DOB }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $advertiser->advertiser_status }}</td>
                    <td style="border: 1px solid black; padding: 10px;">

                        <div class="d-inline-block">
                            <a href="{{ route('showAdvertiser', $advertiser->advertiser_id)}}" class="btn btn-info btn-sm">View</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12 ">
            {{ $advertisers->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
