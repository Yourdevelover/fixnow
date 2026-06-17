<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\Service;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function index()
    {
        $technicians = Technician::with('user', 'service')->get();
        return view('technicians.index', compact('technicians'));
    }

    public function create()
    {
        // Hanya user dengan role 'user' yang bisa jadi teknisi (belum jadi teknisi)
        $users     = User::where('role', 'user')->get();
        $services  = Service::all();
        return view('technicians.create', compact('users', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'             => 'required|exists:users,id|unique:technicians,user_id',
            'service_id'          => 'required|exists:services,id',
            'specialist'          => 'required|string|max:255',
            'experience'          => 'required|integer|min:0',
            'availability_status' => 'required|in:available,busy',
        ]);

        Technician::create([
            'user_id'             => $request->user_id,
            'service_id'          => $request->service_id,
            'specialist'          => $request->specialist,
            'experience'          => $request->experience,
            'rating'              => 0,
            'availability_status' => $request->availability_status,
        ]);

        // Update role user jadi technician
        User::findOrFail($request->user_id)->update(['role' => 'technician']);

        return redirect('/admin/technicians')->with('success', 'Teknisi berhasil ditambahkan.');
    }

    public function monitoring()
    {
        $technicians = Technician::with('user', 'service')
            ->withCount([
                'orders',
                'orders as completed_orders_count' => fn($q) => $q->where('status', 'completed'),
            ])
            ->get();

        return view('technicians.monitoring', compact('technicians'));
    }

    public function toggleAvailability($id)
    {
        $technician = Technician::findOrFail($id);
        $technician->availability_status =
            $technician->availability_status === 'available' ? 'busy' : 'available';
        $technician->save();

        return redirect('/admin/technicians')->with('success', 'Status teknisi berhasil diubah.');
    }
}