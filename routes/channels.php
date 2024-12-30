<?php

use App\Models\ChatRoom;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('staff-support', function ($user) {
    if ($user->roles()->count() > 0) {
        return $user;
    }
    return false;
});

Broadcast::channel('staff-private-channel-{staffId}', function ($user, $staffId) {

    return true;

});

Broadcast::channel('chat-support-{chatRoomId}', function ($user, $chatRoomId) {
    $chatRoom = ChatRoom::find($chatRoomId);
    $token = request()->cookie('guest_id');
    if (Auth::check() && ((int)$user->id == (int)$chatRoom->staff_id || (int)$user->id == (int)$chatRoom->customer_id)) {
        return true;
    } elseif (!Auth::check() && $token == $chatRoom->chat_session_id) {
        return true;
    } else {
        return false;
    }

});


//Broadcast::channel('chat-private-{chatRoomId}', function ($user, $chatRoomId) {
//
//});
