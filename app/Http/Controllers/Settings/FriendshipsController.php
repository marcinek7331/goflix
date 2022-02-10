<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\FavoriteGenres;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Notifications\FriendRequestNotification;
use App\Notifications\HelloNotification;

class FriendshipsController extends Controller {

    public function index(Request $request) {
      $user = $request->user();
      return $user -> getAcceptedFriendships ();
    }
    public function search($query) {
      $user = User::->where('name','LIKE',$query.'%');
      
    }

    public function beFriend(Request $request, $id) {
        $user = $request->user();
        $recipient = User::find($id);
        if(!$user->hasSentFriendRequestTo($recipient)) {
          $user->befriend($recipient);
          $recipient->notify(new FriendRequestNotification($user));
          return response()->json(['status' => 'ok'], 200);
        }
        //BLAD ZE WYSLAELS JUZ WIADOMOSC
    }

    public function acceptFriendRequest(Request $request) {
      $user = $request->user();
      $sender = User::find($request->sender);
      $user->acceptFriendRequest($sender);
      $sender->notify(new HelloNotification());
      return response()->json(['status' => 'ok'], 200);
    }

    public function denyFriendRequest(Request $request) {
      $user = $request->user();
      $sender = User::find($request->sender);
      $user->denyFriendRequest($sender);
      $sender->notify(new HelloNotification());
      return response()->json(['status' => 'ok'], 200);
    }
}
