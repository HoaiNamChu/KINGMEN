<?php

namespace App\Http\Controllers\Client;

use App\Events\Admin\AdminLogin;
use App\Events\Admin\StaffPrivateChannel;
use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Pusher\Pusher;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!request()->hasCookie('guest_id')) {
            $guestId = (string)Str::uuid();
            cookie()->queue('guest_id', $guestId, 60 * 24);
        } else {
            $guestId = request()->cookie('guest_id');
        }

        if (Auth::check()) {

            $customerId = Auth::id();

            $chatRoom = ChatRoom::where('customer_id', $customerId)
                ->where('chat_session_id', $guestId)
                ->first();
            if ($chatRoom) {
                $messages = Message::where('chat_room_id', $chatRoom->id)->get();

                return response()->json([
                    'chat_room' => $chatRoom,
                    'messages' => $messages,
                ]);
            }

        } else {
            $chatRoom = ChatRoom::where('chat_session_id', $guestId)->first();

            if ($chatRoom) {
                $messages = Message::where('chat_room_id', $chatRoom->id)->get();

                return response()->json([
                    'chat_room' => $chatRoom,
                    'messages' => $messages,
                ]);
            }
        }

        return response()->json([
            'chat_room' => null,
            'messages' => null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $staffOnline = $this->getOnlineStaff();

        $staffOnlineLeastChatRoom = $this->getStaffOnlineAndLeastChatRoom();

        $chatRoom = ChatRoom::where('customer_id', Auth::id())->first();

        if ($chatRoom) {
            if ($chatRoom->staff_id != null && in_array($chatRoom->staff_id, (array)$staffOnline)) {
                $message = Message::create([
                    'chat_room_id' => $chatRoom->id,
                    'sender_id' => Auth::id(),
                    'sender_name' => $chatRoom->customer_name,
                    'message' => $request->message
                ]);
            } else {
                $chatRoom->update([
                    'staff_id' => $staffOnlineLeastChatRoom->id ?? null,
                ]);
                $message = Message::create([
                    'chat_room_id' => $chatRoom->id,
                    'sender_id' => Auth::id(),
                    'sender_name' => $chatRoom->customer_name,
                    'message' => $request->message
                ]);
            }
        } else {
            $chatRoom = ChatRoom::create([
                'chat_session_id' => null,
                'customer_id' => Auth::id(),
                'customer_name' => $request->username ?? 'client',
                'customer_email' => $request->email ?? 'client@gmail.com',
                'customer_phone' => $request->phone ?? '0123456789',
                'staff_id' => $staffOnlineLeastChatRoom->id ?? null,
            ]);
            $message = Message::create([
                'chat_room_id' => $chatRoom->id,
                'sender_id' => Auth::id(),
                'sender_name' => $chatRoom->customer_name,
                'message' => $request->message
            ]);
        }
        broadcast(new SendMessage($message, $chatRoom->staff_id))->toOthers();

        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function getOnlineStaff()
    {
        try {
            $pusher = new Pusher(
                config('broadcasting.connections.pusher.key'),
                config('broadcasting.connections.pusher.secret'),
                config('broadcasting.connections.pusher.app_id'),
                config('broadcasting.connections.pusher.options')
            );

            $response = $pusher->get('/channels/presence-staff-support/users');

            $resData = $response->users;

            $onlineStaff = collect($resData)->map(function ($user) {
                return $user->id;
            });

            return $onlineStaff;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không thể lấy danh sách online: ' . $e->getMessage()], 500);
        }
    }

    public function getStaffOnlineAndLeastChatRoom()
    {
        $staffOnline = $this->getOnlineStaff()->toArray();

        $staffWithChatRoomCounts = User::query()->whereIn('id', $staffOnline)
            ->with(['chatRooms' => function ($query) {
                $query->where('status', 1);
            }])
            ->get();

        $leastBusyStaff = $staffWithChatRoomCounts->sortBy('chat_rooms_count')->first();

        return $leastBusyStaff;
    }

}
