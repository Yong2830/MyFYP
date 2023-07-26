@extends('advertiserLayout')
@section('title', 'Advertiser')

@section('content')
Hi advertiser
{{-- @if (auth()->guard('administrator')->check())
    {{ auth()->guard('administrator')->user()->administrator_name }}
@endif

<form action="{{ route('logoutAdministrator') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form> --}}
@endsection