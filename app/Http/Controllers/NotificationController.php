<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use App\Models\Notification;
use Auth;

class NotificationController extends Controller
{

    public function markNotificationAsRead()
    {
        // Cari notifikasi yang belum dibaca untuk pengguna saat ini
        $notifications = Notification::where('user_id', Auth::id())
                                    ->where('read', false)
                                    ->get();

        // Tandai notifikasi sebagai sudah dibaca
        foreach ($notifications as $notification) {
            $notification->read = true;
            $notification->save();
        }

        // Kembalikan respons JSON dengan informasi sukses
        return Response::json(['success' => true]);
    }
}


