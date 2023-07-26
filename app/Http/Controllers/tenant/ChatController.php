<?php

namespace App\Http\Controllers\tenant;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Advertiser;
use App\Models\ChatHistory;
use App\Models\ChatList;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use App\Events\NewMessage;
use App\Events\TestMessage;
use PhpParser\Node\Expr\New_;

class ChatController extends Controller
{
    // Tenant Chat Message operation
    public function tenantViewChatList()
    {       
        $tenantId = auth()->guard('tenant')->user()->tenant_id;

        $chatList = ChatList::with('advertiser')
            ->where('tenant_id', $tenantId)
            ->get();
        
        return view('tenant.chat.chatList', ['chatList' => $chatList]);            
    }

    public function addChatList($advertiserId)
    {
        $tenantId = auth()->guard('tenant')->user()->tenant_id;
    
        $existingChatList = ChatList::where('advertiser_id', $advertiserId)
        ->where('tenant_id', $tenantId)
        ->first();

        if (!$existingChatList) {
            $latestChatList = ChatList::latest('chat_list_id')->first();
            $lastChatListId = $latestChatList ? $latestChatList->chat_list_id : 'CL0000';
            $chatListId = 'CL' . str_pad((int) substr($lastChatListId, 2) + 1, 4, '0', STR_PAD_LEFT);
    
            ChatList::create([
                'chat_list_id'  => $chatListId,
                'tenant_id'     => $tenantId,
                'advertiser_id' => $advertiserId,
            ]);
        }

        return redirect()->back()->with('info', 'Done add to Chat List!');
    }

    public function tenantViewChatHistory($chatListId)
    {
        $tenantId = auth()->guard('tenant')->user()->tenant_id;

        $chatList = ChatList::with('advertiser')
            ->where('tenant_id', $tenantId)
            ->findOrFail($chatListId);

        $chatHistory = $chatList->chatHistory;

        return view('tenant.chat.chatHistory', ['chatList'=>$chatList, 'chatHistory'=>$chatHistory]);
    }    

    public function tenantSendMessage(Request $request, $chatListId)
    {
        $request->validate([
            'chat_message_content'  => 'required|max:600',
        ]);

        $chatList = ChatList::findOrFail($chatListId);

        $senderId = null;
        $receiverId = null;
        $senderName = null;

        if(auth()->guard('tenant')->check()){
            $senderId = auth()->guard('tenant')->user()->tenant_id;
            $receiverId = $chatList->advertiser_id;
        }

        $latestChatMessage = ChatHistory::latest('chat_message_id')->first();
        $lastChatMessageId = $latestChatMessage ? $latestChatMessage->chat_message_id : 'CH0000';
        $chatMessageId = 'CH' . str_pad((int) substr($lastChatMessageId, 2) + 1, 4, '0', STR_PAD_LEFT);

        $chatMessage = ChatHistory::create([
            'chat_message_id'           => $chatMessageId,
            'chat_message_content'      => $request->chat_message_content,
            'chat_message_timestamp'    => Carbon::now(),
            'sender_id'                 => $senderId,
            'receiver_id'               => $receiverId,
            'chat_list_id'              => $chatListId,
        ]);

        // event(new TestMessage());
        broadcast(new NewMessage($chatMessage, $chatListId))->toOthers();
        
        // return redirect()->back();
        return response()->json([
            'message' => 'success',
            'chatMessage' => $chatMessage
        ]);
    }

    public function tenantEditMessage(Request $request, $chat_message_id)
    {
        $chatMessage = ChatHistory::findOrFail($chat_message_id);

        if(auth()->guard('tenant')->check() && $chatMessage->sender_id === auth()->guard('tenant')->user()->tenant_id)
        {
            $chatMessage->chat_message_content = $request->chat_message_content;
            $chatMessage->save();
        }

        return redirect()->back();
    }

    public function tenantDeleteMessage($chat_message_id)
    {
        $chatMessage = ChatHistory::findOrFail($chat_message_id);
        $chatMessage->delete();
        return redirect()->route('viewChatHistory')->with('info', 'The selected message has been deleted successfully.');
    }

// ====================================================================================================================

    // Advertiser Chat Message operation
    public function advertiserViewChatList()
    {
        $advertiserId = auth()->guard('advertiser')->user()->advertiser_id;
        
        $chatList = ChatList::with('tenant')
            ->where('advertiser_id', $advertiserId)
            ->get();

        return view('advertiser.chat.chatList', ['chatList' => $chatList]);   
    }

    public function advertiserViewChatHistory($chatListId)
    {
        $advertiserId = auth()->guard('advertiser')->user()->advertiser_id;
        
        $chatList = ChatList::with('tenant')
            ->where('advertiser_id', $advertiserId)
            ->findOrFail($chatListId);

        $chatHistory = $chatList->chatHistory;
            
        return view('advertiser.chat.chatHistory', ['chatList'=>$chatList, 'chatHistory'=>$chatHistory]);
    }

    public function advertiserSendMessage(Request $request, $chatListId)
    {
        $request->validate([
            'chat_message_content'  => 'required|max:600',
        ]);

        $chatList = ChatList::findOrFail($chatListId);

        $senderId = null;
        $receiverId = null;

        if(auth()->guard('advertiser')->check()){
            $senderId = auth()->guard('advertiser')->user()->advertiser_id;
            $receiverId = $chatList->tenant_id;
        }

        $latestChatMessage = ChatHistory::latest('chat_message_id')->first();
        $lastChatMessageId = $latestChatMessage ? $latestChatMessage->chat_message_id : 'CH0000';
        $chatMessageId = 'CH' . str_pad((int) substr($lastChatMessageId, 2) + 1, 4, '0', STR_PAD_LEFT);

        $chatMessage = ChatHistory::create([
            'chat_message_id'           => $chatMessageId,
            'chat_message_content'      => $request->chat_message_content,
            'chat_message_timestamp'    => Carbon::now(),
            'sender_id'                 => $senderId,
            'receiver_id'               => $receiverId,
            'chat_list_id'              => $chatListId,
        ]);

        // event(new TestMessage());
        broadcast(new NewMessage($chatMessage, $chatListId))->toOthers();

        // return redirect()->back();
        return response()->json([
            'message' => 'success',
            'chatMessage' => $chatMessage
        ]);
    }

    public function advertiserEditMessage(Request $request, $chat_message_id)
    {
        $chatMessage = ChatHistory::findOrFail($chat_message_id);

        if(auth()->guard('advertiser')->check() && $chatMessage->sender_id === auth()->guard('advertiser')->user()->advertiser_id){
            
            $chatMessage->chat_message_content = $request->chat_message_content;
            $chatMessage->save();
        }
    }
  

    public function advertiserDeleteMessage($chat_message_id)
    {
        $chatMessage = ChatHistory::findOrFail($chat_message_id);
        $chatMessage->delete();
        return redirect()->route('viewChatHistory')->with('info', 'The selected message has been deleted successfully.');
    }
    
}
