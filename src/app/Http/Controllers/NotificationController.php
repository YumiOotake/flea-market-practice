<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function read(Notification $notification)
    {
        if ($notification->user_id !== auth()->id()) {
            return redirect()->route('mypage')->with('error', '通知ユーザーのみこの処理ができます');
        }

        $notification->update([
            'is_read' => 1,
        ]);

        return redirect()->route('mypage');
    }

    public function readAll()
    {

        $notifications = Notification::where('user_id', auth()->id());
        $notifications->update([
            'is_read' => 1,
        ]);

        return redirect()->route('mypage');
    }
}
