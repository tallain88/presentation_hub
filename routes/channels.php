<?php

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

Broadcast::channel('presentation-channel.{presentationId}', function($user) {
    // return dd($user);
    error_log($user);
    return['id' => $user->id, 'name' => $user->name];
});

Broadcast::channel('presentation-signal-channel.{userId}', function($user, $userId) {
    error_log("SIGNAL AWAYYY");
    error_log($user->id);
    return (int) $user->id === (int) $userId;
});
