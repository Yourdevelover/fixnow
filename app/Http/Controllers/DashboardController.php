<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use App\Models\Technician;
use App\Models\Review;

class DashboardController extends Controller
{
    public function redirect()
    {
        $role = auth()->user()->role;

        // Default redirect needed for Breeze authentication tests.
        if (! $role) {
            return redirect('/dashboard');
        }

        if ($role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($role === 'technician') {
            return redirect('/technician/dashboard');
        }

        return redirect('/user/dashboard');
    }


    public function adminDashboard()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        $totalUsers      = $users->count();
        $totalTechnicians = Technician::count();
        $totalServices   = Service::count();
        $totalOrders     = Order::count();

        return view('admin.dashboard', compact(
            'users',
            'totalUsers',
            'totalTechnicians',
            'totalServices',
            'totalOrders'
        ));
    }

    public function adminUsers()
    {
        $users = \App\Models\User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function adminOrders()
    {
        $orders = \App\Models\Order::with('user', 'service', 'technician.user')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.orders', compact('orders'));
    }
    public function technicianDashboard()
    {
        $technician = Technician::where(
            'user_id',
            auth()->id()
        )->first();

        $totalOrders = 0;
        $completedOrders = 0;
        $ratingAverage = 0;
        $ratingCount = 0;

        if ($technician) {
            $totalOrders = Order::where(
                'technician_id',
                $technician->id
            )->count();

            $completedOrders = Order::where(
                'technician_id',
                $technician->id
            )
            ->where(
                'status',
                'completed'
            )
            ->count();

            $ratingCount = Review::where(
                'technician_id',
                $technician->id
            )->count();

            $ratingAverage = Review::where(
                'technician_id',
                $technician->id
            )->avg('rating') ?? 0;
        }

        return view(
            'dashboard.technician',
            compact(
                'technician',
                'totalOrders',
                'completedOrders',
                'ratingAverage',
                'ratingCount'
            )
        );
    }
    public function userDashboard()
    {
        $technician = \App\Models\Technician::where('user_id', auth()->id())->first();
        return view('dashboard.user', compact('technician'));
    }


    
}