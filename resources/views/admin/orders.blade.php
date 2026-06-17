@extends('layouts.admin')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
        <h1 style="font-size:22px; font-weight:600; margin-bottom:4px;">Order Monitoring</h1>
        <p style="color:#64748b; font-size:14px;">{{ $orders->count() }} total order</p>
    </div>
</div>

{{-- Stat cards --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">
    <div style="background:white; border-radius:12px; padding:20px; box-shadow:0 1px 4px rgba(0,0,0,.08);">
        <div style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; color:#94a3b8; margin-bottom:8px;">Total Order</div>
        <div style="font-size:28px; font-weight:700; color:#1e293b;">{{ $orders->count() }}</div>
    </div>
    <div style="background:white; border-radius:12px; padding:20px; box-shadow:0 1px 4px rgba(0,0,0,.08);">
        <div style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; color:#94a3b8; margin-bottom:8px;">Pending</div>
        <div style="font-size:28px; font-weight:700; color:#d97706;">{{ $orders->where('status','pending')->count() }}</div>
    </div>
    <div style="background:white; border-radius:12px; padding:20px; box-shadow:0 1px 4px rgba(0,0,0,.08);">
        <div style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; color:#94a3b8; margin-bottom:8px;">In Process</div>
        <div style="font-size:28px; font-weight:700; color:#2563eb;">{{ $orders->where('status','process')->count() }}</div>
    </div>
    <div style="background:white; border-radius:12px; padding:20px; box-shadow:0 1px 4px rgba(0,0,0,.08);">
        <div style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; color:#94a3b8; margin-bottom:8px;">Completed</div>
        <div style="font-size:28px; font-weight:700; color:#16a34a;">{{ $orders->where('status','completed')->count() }}</div>
    </div>
</div>

<div style="background:white; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,.08); overflow:hidden;">

    {{-- Filter --}}
    <div style="padding:16px 20px; border-bottom:1px solid #f1f5f9; display:flex; gap:8px; flex-wrap:wrap;">
        <span style="font-size:13px; font-weight:600; padding:6px 14px; border-radius:20px; background:#1e293b; color:white; cursor:pointer;"
            onclick="filterOrder('all')" id="filter-all">Semua ({{ $orders->count() }})</span>
        <span style="font-size:13px; color:#64748b; padding:6px 14px; border-radius:20px; cursor:pointer;"
            onclick="filterOrder('pending')" id="filter-pending">Pending ({{ $orders->where('status','pending')->count() }})</span>
        <span style="font-size:13px; color:#64748b; padding:6px 14px; border-radius:20px; cursor:pointer;"
            onclick="filterOrder('process')" id="filter-process">Process ({{ $orders->where('status','process')->count() }})</span>
        <span style="font-size:13px; color:#64748b; padding:6px 14px; border-radius:20px; cursor:pointer;"
            onclick="filterOrder('completed')" id="filter-completed">Completed ({{ $orders->where('status','completed')->count() }})</span>
        <span style="font-size:13px; color:#64748b; padding:6px 14px; border-radius:20px; cursor:pointer;"
            onclick="filterOrder('cancelled')" id="filter-cancelled">Cancelled ({{ $orders->where('status','cancelled')->count() }})</span>
    </div>

    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#f8fafc; border-bottom:1px solid #e2e8f0;">
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">#</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Customer</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Layanan & Teknisi</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Alamat</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Harga</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Status</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Bayar</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $i => $order)
            <tr class="order-row" data-status="{{ $order->status }}"
                style="border-bottom:1px solid #f1f5f9; transition:background .1s;"
                onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background=''">

                <td style="padding:14px 20px; color:#94a3b8; font-size:13px;">{{ $i + 1 }}</td>

                <td style="padding:14px 20px;">
                    <div style="font-size:14px; font-weight:500; color:#1e293b;">{{ $order->user->name }}</div>
                    <div style="font-size:12px; color:#94a3b8;">{{ $order->user->email }}</div>
                </td>

                <td style="padding:14px 20px;">
                    <div style="font-size:14px; font-weight:500; color:#1e293b;">{{ $order->service->service_name }}</div>
                    <div style="font-size:12px; color:#94a3b8;">
                        {{ $order->technician?->user->name ?? 'Belum ada teknisi' }}
                    </div>
                </td>

                <td style="padding:14px 20px; font-size:13px; color:#475569; max-width:180px;">
                    <div style="overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
                        {{ $order->address }}
                    </div>
                </td>

                <td style="padding:14px 20px;">
                    <span style="font-size:14px; font-weight:600; color:#2563eb;">
                        Rp {{ number_format($order->price) }}
                    </span>
                </td>

                <td style="padding:14px 20px;">
                    @if($order->status === 'pending')
                        <span style="background:#fef9c3; color:#854d0e; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">Pending</span>
                    @elseif($order->status === 'process')
                        <span style="background:#dbeafe; color:#1e40af; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">Process</span>
                    @elseif($order->status === 'completed')
                        <span style="background:#dcfce7; color:#166534; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">Completed</span>
                    @else
                        <span style="background:#fee2e2; color:#991b1b; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">Cancelled</span>
                    @endif
                </td>

                <td style="padding:14px 20px;">
                    @if($order->payment_status === 'paid')
                        <span style="background:#dcfce7; color:#166534; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">Paid</span>
                    @else
                        <span style="background:#fee2e2; color:#991b1b; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">Unpaid</span>
                    @endif
                </td>

                <td style="padding:14px 20px; font-size:13px; color:#64748b; white-space:nowrap;">
                    {{ $order->created_at->format('d M Y') }}
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="8" style="padding:40px; text-align:center; color:#94a3b8; font-size:14px;">
                    Belum ada order.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

<script>
function filterOrder(status) {
    ['all','pending','process','completed','cancelled'].forEach(s => {
        const el = document.getElementById('filter-' + s);
        if (s === status) {
            el.style.background = '#1e293b';
            el.style.color = 'white';
            el.style.fontWeight = '600';
        } else {
            el.style.background = '';
            el.style.color = '#64748b';
            el.style.fontWeight = '';
        }
    });
    document.querySelectorAll('.order-row').forEach(row => {
        row.style.display = (status === 'all' || row.dataset.status === status) ? '' : 'none';
    });
}
</script>

@endsection