@extends('layouts.app')

@section('content')

<style>
    .orders-wrap {
        max-width: 880px;
        margin: 0 auto;
        padding: 8px 0 40px;
    }

    /* ── PAGE HEADER ── */
    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .page-header h1 {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
        margin-bottom: 4px;
    }

    .page-header p {
        font-size: 13.5px;
        color: var(--muted);
    }

    .btn-secondary-link {
        padding: 9px 18px;
        background: var(--white);
        color: #475569;
        text-decoration: none;
        border-radius: 9px;
        font-size: 13.5px;
        font-weight: 600;
        border: 1.5px solid var(--border);
        white-space: nowrap;
        transition: all 0.18s;
        display: inline-block;
    }

    .btn-secondary-link:hover {
        background: var(--light);
        border-color: var(--navy);
        color: var(--navy);
    }

    /* ── ORDER CARD ── */
    .order-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(35, 90, 157, 0.07);
        margin-bottom: 18px;
        overflow: hidden;
        transition: box-shadow 0.18s, transform 0.18s;
    }

    .order-card:hover {
        box-shadow: 0 6px 18px rgba(35, 90, 157, 0.10);
        transform: translateY(-2px);
    }

    /* BUG #8 FIX: border kiri per status */
    .order-card.status-completed { border-left: 4px solid #16a34a; }
    .order-card.status-cancelled { border-left: 4px solid #dc2626; }

    .order-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 18px 22px;
        border-bottom: 1px solid var(--border);
        flex-wrap: wrap;
    }

    .order-service-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .order-service-icon {
        width: 42px; height: 42px;
        background: var(--light);
        border: 1px solid var(--border);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
    }

    .order-service-info strong {
        display: block;
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
    }

    .order-service-info span {
        font-size: 12px;
        color: var(--muted);
    }

    /* BUG #8 FIX: tambah badge cancelled */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-badge.completed { background: #ecfdf5; color: #16a34a; }
    .status-badge.cancelled { background: #fef2f2; color: #dc2626; }

    /* ── ORDER BODY ── */
    .order-card-body {
        padding: 18px 22px;
    }

    .order-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px 24px;
        margin-bottom: 16px;
    }

    .order-detail-item .detail-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .order-detail-item .detail-value {
        font-size: 14px;
        font-weight: 600;
        color: #0f172a;
    }

    .order-detail-item.full {
        grid-column: 1 / -1;
    }

    .order-problem-box {
        background: var(--light);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 14px 16px;
    }

    .order-problem-box .detail-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .order-problem-box p {
        font-size: 13.5px;
        color: #334155;
        line-height: 1.6;
    }

    /* ── FOOTER ── */
    .order-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 14px 22px;
        border-top: 1px solid var(--border);
        background: #fafcff;
        flex-wrap: wrap;
    }

    .order-price {
        font-size: 13.5px;
        color: var(--muted);
    }

    .order-price strong {
        font-size: 18px;
        font-weight: 800;
        color: var(--navy);
        margin-left: 4px;
        letter-spacing: -0.5px;
    }

    .footer-meta {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .completed-date {
        font-size: 12px;
        color: var(--muted);
    }

    .payment-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .payment-badge.paid   { background: #ecfdf5; color: #16a34a; }
    .payment-badge.unpaid { background: #fef2f2; color: #dc2626; }

    .btn-review {
        padding: 9px 18px;
        background: var(--navy);
        color: var(--white);
        border: none;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        text-decoration: none;
        white-space: nowrap;
        transition: background 0.18s, box-shadow 0.18s, transform 0.1s;
        box-shadow: 0 3px 10px rgba(35, 90, 157, 0.25);
        display: inline-block;
    }

    .btn-review:hover {
        background: var(--navy-mid, #1a4a8a);
        box-shadow: 0 5px 16px rgba(35, 90, 157, 0.35);
    }

    .btn-review:active {
        transform: scale(0.98);
    }

    /* ── CANCELLED NOTICE ── */
    .cancelled-notice {
        font-size: 13px;
        color: #dc2626;
        font-weight: 600;
    }

    /* ── EMPTY STATE ── */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--muted);
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
    }

    .empty-state .empty-icon {
        font-size: 40px;
        margin-bottom: 12px;
    }

    .empty-state p {
        font-size: 14px;
        margin-bottom: 8px;
    }

    .empty-state a {
        color: var(--navy);
        font-size: 13.5px;
        font-weight: 700;
        text-decoration: none;
    }

    .empty-state a:hover {
        text-decoration: underline;
    }

    @media (max-width: 560px) {
        .order-detail-grid { grid-template-columns: 1fr; }
        .order-card-footer { flex-direction: column; align-items: stretch; }
        .footer-meta { justify-content: space-between; }
        .btn-review { text-align: center; }
    }

    /* ─── DARK THEME SUPPORT ─── */
    body.dark-theme .page-header h1 { 
        color: white; 
    }

    body.dark-theme .page-header p { 
        color: #cbd5e1;
    }

    body.dark-theme .order-card { 
        background: #1e293b; 
        border-color: #334155; 
    }

    body.dark-theme .order-card:hover { 
        box-shadow: 0 8px 24px rgba(30, 64, 175, 0.25);
        border-color: #3b82f6;
    }

    body.dark-theme .order-card-header { 
        border-bottom-color: #334155; 
    }

    body.dark-theme .order-service-info strong { 
        color: white;
    }

    body.dark-theme .order-service-info span { 
        color: #cbd5e1;
    }

    body.dark-theme .order-service-icon { 
        background: rgba(30, 64, 175, 0.15); 
        border-color: #334155;
    }

    body.dark-theme .order-detail-item .detail-label { 
        color: #cbd5e1;
    }

    body.dark-theme .order-detail-item .detail-value { 
        color: white;
    }

    body.dark-theme .order-review-box { 
        background: rgba(30, 64, 175, 0.1); 
        border-color: #334155;
    }

    body.dark-theme .order-review-box p { 
        color: #e2e8f0;
    }

    body.dark-theme .order-card-footer { 
        border-top-color: #334155; 
        background: rgba(30, 64, 175, 0.05);
    }

    body.dark-theme .order-price { 
        color: #cbd5e1;
    }

    body.dark-theme .order-price strong { 
        color: #3b82f6;
    }

    body.dark-theme .empty-state { 
        background: #1e293b; 
        border-color: #334155; 
        color: #cbd5e1;
    }

    body.dark-theme .empty-state p { 
        color: #e2e8f0;
    }

    body.dark-theme .empty-state a { 
        color: #3b82f6;
    }

    body.dark-theme .footer-meta { 
        color: #cbd5e1;
    }

    body.dark-theme .btn-review { 
        background: var(--primary); 
        color: white;
    }

    body.dark-theme .btn-review:hover { 
        background: var(--primary-dark);
    }
</style>

<div class="orders-wrap">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1>Riwayat Order</h1>
            <p>Order yang sudah selesai atau dibatalkan.</p>
        </div>
        <a href="/orders" class="btn-secondary-link">← My Orders</a>
    </div>

    {{-- ORDER LIST --}}
    @forelse($orders as $order)
    {{-- BUG #8 FIX: tambahkan class status ke card untuk border warna --}}
    <div class="order-card status-{{ $order->status }}">

        <div class="order-card-header">
            <div class="order-service-info">
                <div class="order-service-icon">🔧</div>
                <div>
                    <strong>{{ $order->service?->service_name }}</strong>
                    <span>{{ $order->created_at?->format('d M Y, H:i') }}</span>
                </div>
            </div>

            {{-- BUG #8 FIX: tampilkan badge sesuai status, bukan hardcode completed --}}
            @if($order->status === 'completed')
                <span class="status-badge completed">✅ Completed</span>
            @elseif($order->status === 'cancelled')
                <span class="status-badge cancelled">❌ Cancelled</span>
            @endif
        </div>

        <div class="order-card-body">
            <div class="order-detail-grid">

                <div class="order-detail-item">
                    <div class="detail-label">Teknisi</div>
                    <div class="detail-value">{{ $order->technician?->user?->name ?? '-' }}</div>
                </div>

                <div class="order-detail-item">
                    <div class="detail-label">
                        {{ $order->status === 'cancelled' ? 'Dibatalkan' : 'Selesai' }}
                    </div>
                    <div class="detail-value">{{ $order->updated_at->format('d M Y, H:i') }}</div>
                </div>

                <div class="order-detail-item full">
                    <div class="detail-label">Alamat</div>
                    <div class="detail-value">{{ $order->address }}</div>
                </div>

            </div>

            <div class="order-problem-box">
                <div class="detail-label">Problem</div>
                <p>{{ $order->problem_description }}</p>
            </div>
        </div>

        <div class="order-card-footer">
            <div class="footer-meta">
                <div class="order-price">
                    Total <strong>Rp {{ number_format($order->price) }}</strong>
                </div>

                @if($order->payment_status == 'paid')
                    <span class="payment-badge paid">✅ Paid</span>
                @else
                    <span class="payment-badge unpaid">⚠️ {{ ucfirst($order->payment_status) }}</span>
                @endif
            </div>

            {{-- BUG #8 FIX: tombol review hanya muncul untuk order completed --}}
            @if($order->status === 'completed')
                <a href="/reviews/{{ $order->id }}/create" class="btn-review">⭐ Beri Review</a>
            @else
                <span class="cancelled-notice">Order ini dibatalkan</span>
            @endif
        </div>

    </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <p>Belum ada riwayat order.</p>
            <a href="/orders/create">Buat order sekarang →</a>
        </div>
    @endforelse

</div>

@endsection
