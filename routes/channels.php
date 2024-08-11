<?php

use App\Models\Chat;
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
    return (int) $user->id === (int) $id;
});

Broadcast::channel('liveChat.{chat_id}', function ($user, $chat_id) {
    $current_chat = Chat::where('id', $chat_id)->first();
    return $user->id == $current_chat->contact_id || $current_chat->user_id;
});
Broadcast::channel('liveNotification.{id}', function ($user, $id) {
   return true;
});