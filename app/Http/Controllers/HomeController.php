<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $total_notification = Notification::where('user_id', $user->id)->where('read', 0)->get();

        return view('admin.dashboard.index', compact('notifications','total_notification'));
    }
}
