<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() 
    {

        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $total_notification = Notification::where('user_id', $user->id)->where('read', 0)->get();

        return view('admin.dashboard.index', compact('notifications', 'total_notification'));
    }

    public function getData()
    {
        // Query untuk mengambil data jumlah order per hari
        $data = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->get();

        // Mengubah format data menjadi format yang diterima oleh Highcharts
        $chartData = [];
        foreach ($data as $row) {
            $chartData[] = [
                'date' => Carbon::parse($row->date)->format('Y-m-d'),
                'total' => $row->total
            ];
        }

        return response()->json($chartData);
    }
}
