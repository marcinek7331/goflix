<?php

namespace App\Http\Controllers;

use App\Events\NotificationRead;
use App\Events\NotificationReadAll;
use App\Notifications\HelloNotification;
use Illuminate\Http\Request;
use NotificationChannels\WebPush\PushSubscription;
use Auth;
use Notification;
class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = $user->unreadNotifications();
        $limit = (int) $request->input('limit', 0);
        if ($limit) {
            $query = $query->limit($limit);
        }
        $notifications = $query->get()->each(function ($n) {
            $n->created = $n->created_at->toIso8601String();
        });
        $total = $user->unreadNotifications->count();
        return compact('notifications', 'total');
    }

    public function store(Request $request)
    {
        $request->user()->notify(new HelloNotification());
        return response()->json('Notification sent.', 200);
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = $request
            ->user()
            ->unreadNotifications()
            ->where('id', $id)
            ->first();
        if (is_null($notification)) {
            return response()->json('Notification not found.', 404);
        }
        $notification->markAsRead();
        event(new NotificationRead($request->user()->id, $id));
    }

    public function markAllRead(Request $request)
    {
        $request
            ->user()
            ->unreadNotifications()
            ->get()
            ->each(function ($n) {
                $n->markAsRead();
            });

        event(new NotificationReadAll($request->user()->id));
    }
}
