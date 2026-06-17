<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\Technician;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create($orderId)
    {
        $order = Order::with('technician')->findOrFail($orderId);

        // BUG #6 FIX: pastikan order milik user yang sedang login
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Kamu tidak punya akses ke order ini.');
        }

        if (! $order->technician_id || ! $order->technician) {
            return redirect('/orders');
        }

        $review = Review::where('order_id', $order->id)
            ->where('user_id', auth()->id())
            ->first();

        return view('reviews.create', compact('order', 'review'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id'      => 'required|exists:orders,id',
            'technician_id' => 'required|exists:technicians,id',
            'rating'        => 'required|integer|min:1|max:5',
            'comment'       => 'nullable|string',
        ]);

        $order = Order::findOrFail($request->order_id);

        // BUG #6 FIX: pastikan order milik user yang sedang login
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Kamu tidak punya akses ke order ini.');
        }

        // BUG #6 FIX: hanya order yang sudah completed yang bisa diberi review
        if ($order->status !== 'completed') {
            return redirect('/orders')
                ->with('error', 'Hanya order yang sudah selesai yang bisa diberi review.');
        }

        Review::updateOrCreate(
            [
                'order_id' => $request->order_id,
                'user_id'  => auth()->id(),
            ],
            [
                'technician_id' => $request->technician_id,
                'rating'        => $request->rating,
                'comment'       => $request->comment,
            ]
        );

        // Update rata-rata rating teknisi
        $avg = Review::where('technician_id', $request->technician_id)->avg('rating');

        $ratingCount = Review::where('technician_id', $request->technician_id)->count();

        Technician::findOrFail($request->technician_id)
            ->update(['rating' => round($avg, 1)]);

        return redirect('/orders')
            ->with('success', 'Rating tersimpan. Total ulasan: ' . $ratingCount);
    }
}
