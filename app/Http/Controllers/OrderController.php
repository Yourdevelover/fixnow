<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Technician;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $orders = Order::with('user', 'service', 'technician.user')->get();
        } elseif (auth()->user()->role == 'user') {
            // BUG #3 FIX: tampilkan pending, process, dan cancelled
            // sebelumnya cancelled tidak muncul di mana pun
            $orders = Order::with('user', 'service', 'technician.user')
                ->where('user_id', auth()->id())
                ->whereIn('status', ['pending', 'process', 'cancelled'])
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif (auth()->user()->role == 'technician') {
            $technician = Technician::where('user_id', auth()->id())->first();
            $orders = Order::with('user', 'service', 'technician.user')
                ->where('technician_id', $technician->id ?? 0)
                ->get();
        }

        return view('orders.index', compact('orders'));
    }

    public function history()
    {
        // BUG #3 FIX: tampilkan completed DAN cancelled agar tidak ada
        // order yang hilang sama sekali dari semua halaman
        $orders = Order::with('service', 'technician.user')
            ->where('user_id', auth()->id())
            ->whereIn('status', ['completed', 'cancelled'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('orders.history', compact('orders'));
    }

    public function create()
    {
        $services          = Service::all();
        $selectedServiceId = request('service_id');

        $technicians = Technician::with('user', 'service')
            ->where('availability_status', 'available');

        if ($selectedServiceId) {
            $technicians->where('service_id', $selectedServiceId);
        }

        $technicians = $technicians->get();

        return view('orders.create', compact('services', 'technicians', 'selectedServiceId'));
    }

    public function preview(Request $request)
    {
        $request->validate([
            'service_id'          => 'required|exists:services,id',
            'technician_id'       => 'required|exists:technicians,id',
            'address'             => 'required|string|max:255',
            'problem_description' => 'required|string',
        ]);

        $service = Service::findOrFail($request->service_id);

        $technician = Technician::with('user')
            ->where('id', $request->technician_id)
            ->where('service_id', $service->id)
            ->where('availability_status', 'available')
            ->firstOrFail();

        return view('orders.summary', [
            'service'             => $service,
            'technician'          => $technician,
            'address'             => $request->address,
            'problem_description' => $request->problem_description,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id'          => 'required|exists:services,id',
            'technician_id'       => 'required|exists:technicians,id',
            'address'             => 'required|string|max:255',
            'problem_description' => 'required|string',
        ]);

        $service    = Service::findOrFail($request->service_id);
        $technician = Technician::findOrFail($request->technician_id);

        Order::create([
            'user_id'             => auth()->id(),
            'service_id'          => $service->id,
            'technician_id'       => $technician->id,
            'address'             => $request->address,
            'problem_description' => $request->problem_description,
            'price'               => $service->base_price,
            'status'              => 'pending',
            'payment_status'      => 'paid',
        ]);

        return redirect('/orders')->with('success', 'Order berhasil dibuat! Teknisi akan segera menghubungi kamu.');
    }

    public function editStatus($id)
    {
        $order = Order::with('service', 'user', 'technician.user')->findOrFail($id);

        $hasReview = \App\Models\Review::where('order_id', $order->id)->exists();

        return view('orders.status', compact('order', 'hasReview'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:process,completed',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect('/technician/orders');
    }

    public function incomingOrders()
    {
        $technician = Technician::where('user_id', auth()->id())->first();

        $myOrders = collect();

        if ($technician) {
            $myOrders = Order::with('user', 'service')
                ->where('technician_id', $technician->id)
                ->whereIn('status', ['pending', 'process'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('orders.incoming', compact('technician', 'myOrders'));
    }

    public function acceptOrder($id)
    {
        $technician = Technician::where('user_id', auth()->id())->first();

        if (! $technician) {
            abort(403, 'Kamu bukan teknisi terdaftar.');
        }

        $order = Order::findOrFail($id);

        // BUG #4 FIX: cegah teknisi lain men-overwrite order yang sudah diambil
        if ($order->technician_id && $order->technician_id !== $technician->id) {
            return redirect('/technician/orders')
                ->with('error', 'Order ini sudah diambil oleh teknisi lain.');
        }

        $order->update([
            'technician_id' => $technician->id,
            'status'        => 'process',
        ]);

        // BUG #4 FIX: redirect ke halaman teknisi, bukan halaman user (/orders)
        return redirect('/technician/orders')
            ->with('success', 'Order berhasil diterima.');
    }
}
