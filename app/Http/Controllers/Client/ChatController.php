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
use Pusher\Pusher;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $staffOnline = $this->getOnlineStaff();
        // $staffOnlineLeastChatRoom = $this->getStaffOnlineAndLeastChatRoom();

        // dd($staffOnline);
        // dd($staffOnlineLeastChatRoom->id);

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
        try {
            $user = Auth::user();

            $chatRoom = ChatRoom::where('customer_id', '=', $user->id)->first();

            $staffOnline = $this->getOnlineStaff();

            $staffOnlineLeastChatRoom = $this->getStaffOnlineAndLeastChatRoom();

            if ($chatRoom != null) {

                if (in_array($chatRoom->staff_id, (array)$staffOnline)) {
                    $message = Message::create([
                        'chat_room_id' => $chatRoom->id,
                        'sender_id' => $user->id,
                        'sender_name' => $user->username,
                        'message' => $request->message
                    ]);
                }else{
                    $chatRoom->update([
                        'staff_id' => $staffOnlineLeastChatRoom->id,
                    ]);
                    $message = Message::create([
                        'chat_room_id' => $chatRoom->id,
                        'sender_id' => $user->id,
                        'sender_name' => $user->username,
                        'message' => $request->message
                    ]);
                }

            }else{
                $chatRoom = ChatRoom::create([
                    'chat_session_id' => null,
                    'customer_id' => $user->id,
                    'customer_name' => $user->username ?? 'client',
                    'customer_email' => $user->email,
                    'customer_phone' => $user->phone ?? '0123456789',
                    'staff_id' => $staffOnlineLeastChatRoom->id,
                ]);
                $message = Message::create([
                    'chat_room_id' => $chatRoom->id,
                    'sender_id' => $user->id,
                    'sender_name' => $user->username,
                    'message' => $request->message
                ]);
            }

            broadcast(new SendMessage($chatRoom, $user, $message));
//            broadcast(new StaffPrivateChannel('You have a new message!', $dataChatRooms['staff_id']));

            return response()->json([
                'success' => true,
                'staff_id' => $this->$staffOnlineLeastChatRoom->id,
                'chat_room_id' => $chatRoom->id,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }
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
