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

Broadcast::channel('chat-support-{userId}', function ($user, $userId) {
    return ((int)$userId === (int)$user->id);
});


//Broadcast::channel('chat-private-{chatRoomId}', function ($user, $chatRoomId) {
//
//});
