<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Technician;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page for authenticated users
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get stats based on user role
        if ($user->role === 'user') {
            $stats = $this->getUserStats($user);
            $recent_orders = Order::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        } elseif ($user->role === 'technician') {
            $stats = $this->getTechnicianStats($user);
            $recent_orders = Order::where('technician_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        } else {
            // Admin
            $stats = $this->getAdminStats();
            $recent_orders = Order::orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }

        // Get featured technicians (for users to see available technicians)
        $featured_technicians = Technician::with('user')
            ->orderBy('rating', 'desc')
            ->limit(6)
            ->get();

        return view('home', [
            'stats' => $stats,
            'recent_orders' => $recent_orders,
            'featured_technicians' => $featured_technicians
        ]);
    }

    /**
     * Get statistics for regular users
     */
    private function getUserStats($user)
    {
        $orders = Order::where('user_id', $user->id)->get();
        
        return [
            'total_orders' => $orders->count(),
            'completed_orders' => $orders->where('status', 'completed')->count(),
            'pending_orders' => $orders->where('status', 'pending')->count(),
            'process_orders' => $orders->where('status', 'process')->count(),
            'active_orders' => $orders->whereIn('status', ['pending', 'process'])->count(),
            'total_spending' => $orders->where('status', 'completed')->sum('price'),
            'user_rating' => $user->rating ?? 0,
        ];
    }

    /**
     * Get statistics for technicians
     */
    private function getTechnicianStats($user)
    {
        $orders = Order::where('technician_id', $user->id)->get();
        
        return [
            'total_orders' => $orders->count(),
            'completed_orders' => $orders->where('status', 'completed')->count(),
            'pending_orders' => $orders->where('status', 'pending')->count(),
            'process_orders' => $orders->where('status', 'process')->count(),
            'active_orders' => $orders->whereIn('status', ['pending', 'process'])->count(),
            'total_earning' => $orders->where('status', 'completed')->sum('price'),
            'user_rating' => $user->rating ?? 0,
        ];
    }

    /**
     * Get statistics for admin
     */
    private function getAdminStats()
    {
        return [
            'total_orders' => Order::count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'process_orders' => Order::where('status', 'process')->count(),
            'active_orders' => Order::whereIn('status', ['pending', 'process'])->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('price'),
        ];
    }
}
