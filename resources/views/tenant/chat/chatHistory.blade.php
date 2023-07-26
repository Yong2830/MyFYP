@extends('tenantLayout')
@section('title', 'Chat History')

@section('content')

    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('tenantViewChatList') }}" class="btn btn-primary mb-3">Back to Index</a>
                <div class="card">
                    <div class="card-header">
                        @if (auth()->guard('tenant')->check())
                            <p>Chatting with: {{ $chatList->advertiser->advertiser_name }}</p>
                        @endif    
                    </div>

                    <div class="card-body">
                        <ul id="chatHistoryList" class="list-unstyled" data-chat-list-id="{{ $chatList->chat_list_id }}" >
                            @foreach ($chatHistory as $message)
                                <li class="mb-3">
                                    <strong>
                                        @if (auth()->guard('tenant')->check() && $message->sender_id === auth()->guard('tenant')->user()->tenant_id)
                                            <strong>{{  $message->chatList->tenant->tenant_name  }}</strong>
                                        @elseif (auth()->guard('advertiser')->check() && $message->sender_id === auth()->guard('advertiser')->user()->advertiser_id)
                                            <strong>{{  $message->chatList->advertiser->advertiser_name  }}</strong>
                                        @endif
                                    </strong>:
                                    {{ $message->chat_message_content }}
                                    <span class="text-muted float-right">{{ $message->chat_message_timestamp }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="{{ route('tenantSendMessage' , $chatList->chat_list_id) }}" method="POST" id="tenantChatForm">
                            @csrf
                            <input type="hidden" name="recipient_id" value="">
                            <div class="form-group">
                                <textarea class="form-control" name="chat_message_content" rows="3" placeholder="Type your message here"></textarea>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="sendMessageBtn">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const tenantForm = document.getElementById('tenantChatForm');
        const chatHistoryList = document.getElementById('chatHistoryList');
        const chatListId = chatHistoryList.getAttribute('data-chat-list-id');

        tenantForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get the form data
            const formData = new FormData(tenantForm);

            // Send the form data using Axios (or any other HTTP library)
            axios.post(`/chatList/chat/${chatListId}/send`, formData)
                .then(response => {
                    // Handle the response if needed
                    console.log(response.data); // Assuming the response contains the chatMessage data
                })
                .catch(error => {
                    // Handle any errors if needed
                    console.error(error);
                });

        });

    </script>

@endsection