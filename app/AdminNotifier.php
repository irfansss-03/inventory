<?php

namespace App;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as NotificationFacade;

class AdminNotifier
{
    public static function send(Notification $notification): void
    {
        $admins = User::where('role', 'admin')->whereNotNull('email')->get();

        if ($admins->isEmpty()) {
            return;
        }

        NotificationFacade::send($admins, $notification);
    }
}
