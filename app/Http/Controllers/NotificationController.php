<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', auth()->id())
            ->findOrFail($id);
        
        $notification->markAsRead();
        
        if ($notification->action_url) {
            return redirect($notification->action_url);
        }
        
        return back();
    }

    public function markAllAsRead()
    {
        auth()->user()
            ->unreadNotifications()
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        return back()->with('success', 'Todas las notificaciones marcadas como leídas');
    }

    public function getUnreadCount()
    {
        return response()->json([
            'count' => auth()->user()->unreadNotifications()->count()
        ]);
    }
}
