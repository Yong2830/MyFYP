@extends('tenantLayout')
@section('title', 'Chat List')

@section('content')

    <br>
    <h1>Chat List</h1>
    <br>

    <table class="table table-striped">

        <tr>
            <th scope="col">No.</th>
            <th scope="col">Advertiser Name</th>
            <th scope="col">Last Message Received</th>
            <th scope="col">Timestamp</th>
            <th scope="col">Action</th>
        </tr>

        @foreach ($chatList as $index => $chat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if (auth()->guard('tenant')->check())
                        {{ $chat->advertiser->advertiser_name }}
                    @else   
                        something is wrong motherfucker!
                    @endif
                </td>
                <td></td>
                <td></td>
                {{-- <td>{{ $chat->last_message_received }}</td> --}}
                {{-- <td>{{ $chat->updated_at }}</td> --}}
                <td>
                    <a href="{{ route('tenantViewChatHistory', $chat->chat_list_id) }}" class="btn btn-primary">View Chat</a>
                </td>
            </tr>
        @endforeach

    </table>

@endsection