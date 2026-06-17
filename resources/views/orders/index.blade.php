@extends('layouts.app')

@section('content')

<style>
    :root {
        --primary:    #1e40af;
        --primary-dark: #1a3f8a;
        --primary-light: #3b82f6;
        --accent:     #0ea5e9;
        --white:      #ffffff;
        --bg-light:   #f9fafb;
        --dark:       #111827;
        --muted:      #6b7280;
        --border:     #e5e7eb;
        --success:    #10b981;
        --warning:    #f59e0b;
        --error:      #ef4444;
    }

    .orders-wrap { 
        max-width: 1000px; 
        margin: 0 auto; 
        padding: 0 0 40px;
    }

    .page-header { 
        display: flex; 
        align-items: flex-start; 
        justify-content: space-between; 
        gap: 20px; 
        margin-bottom: 28px; 
        flex-wrap: wrap;
    }
    
    .page-header h1 { 
        font-size: 28px; 
        font-weight: 800; 
        color: var(--dark); 
        letter-spacing: -0.5px; 
        margin-bottom: 6px;
    }
    
    .page-header p { 
        font-size: 14px; 
        color: var(--muted);
    }

    .btn-new-order {
        padding: 12px 24px; 
        background: var(--primary); 
        color: var(--white);
        border: none; 
        border-radius: 8px; 
        font-size: 14px; 
        font-weight: 700;
        font-family: 'Inter', sans-serif; 
        text-decoration: none; 
        white-space: nowrap;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(30, 64, 175, 0.2); 
        display: inline-flex; 
        align-items: center; 
        gap: 8px;
    }
    
    .btn-new-order:hover { 
        background: var(--primary-dark); 
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        transform: translateY(-1px);
    }

    /* ── ORDER CARD ── */
    .order-card {
        background: var(--white); 
        border: 1px solid var(--border); 
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); 
        margin-bottom: 20px; 
        overflow: hidden;
        transition: all 0.2s ease;
    }
    
    .order-card:hover { 
        box-shadow: 0 8px 24px rgba(30, 64, 175, 0.12); 
        transform: translateY(-2px);
        border-color: var(--primary-light);
    }

    /* left border by status */
    .order-card.status-pending { border-left: 4px solid var(--warning); }
    .order-card.status-process { border-left: 4px solid var(--primary); }

    .order-card-header {
        display: flex; 
        align-items: center; 
        justify-content: space-between;
        gap: 16px; 
        padding: 20px 24px; 
        border-bottom: 1px solid var(--border); 
        flex-wrap: wrap;
    }
    
    .order-service-info { 
        display: flex; 
        align-items: center; 
        gap: 14px;
    }
    
    .order-service-icon {
        width: 48px; 
        height: 48px; 
        background: rgba(30, 64, 175, 0.1); 
        border: 1px solid var(--border);
        border-radius: 10px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        flex-shrink: 0;
    }
    
    .order-service-icon svg { 
        width: 22px; 
        height: 22px; 
        stroke: var(--primary); 
        fill: none; 
        stroke-width: 2; 
        stroke-linecap: round; 
        stroke-linejoin: round;
    }
    
    .order-service-info strong { 
        display: block; 
        font-size: 15px; 
        font-weight: 700; 
        color: var(--dark);
    }
    
    .order-service-info span { 
        font-size: 13px; 
        color: var(--muted);
    }

    .status-badge {
        display: inline-flex; 
        align-items: center; 
        gap: 6px;
        padding: 5px 12px; 
        border-radius: 20px; 
        font-size: 12px; 
        font-weight: 700; 
        white-space: nowrap;
    }
    
    .status-badge.pending   { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
    .status-badge.process   { background: rgba(30, 64, 175, 0.1); color: var(--primary); }
    .status-badge.completed { background: rgba(16, 185, 129, 0.1); color: var(--success); }
    .status-badge.cancelled { background: rgba(239, 68, 68, 0.1); color: var(--error); }

    /* ── BODY ── */
    .order-card-body { 
        padding: 20px 24px;
    }
    
    .order-detail-grid { 
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 16px 24px; 
        margin-bottom: 18px;
    }
    
    .order-detail-item .detail-label { 
        font-size: 11px; 
        font-weight: 700; 
        color: var(--muted); 
        text-transform: uppercase; 
        letter-spacing: 0.7px; 
        margin-bottom: 6px;
    }
    
    .order-detail-item .detail-value { 
        font-size: 14px; 
        font-weight: 600; 
        color: var(--dark);
    }
    
    .order-detail-item.full { 
        grid-column: 1 / -1;
    }

    .order-problem-box {
        background: var(--bg-light); 
        border: 1px solid var(--border); 
        border-radius: 10px; 
        padding: 16px;
    }
    
    .order-problem-box .detail-label { 
        font-size: 11px; 
        font-weight: 700; 
        color: var(--muted); 
        text-transform: uppercase; 
        letter-spacing: 0.7px; 
        margin-bottom: 8px;
    }
    
    .order-problem-box p { 
        font-size: 14px; 
        color: var(--dark); 
        line-height: 1.6;
    }

    /* ── FOOTER ── */
    .order-card-footer {
        display: flex; 
        align-items: center; 
        justify-content: space-between;
        gap: 14px; 
        padding: 16px 24px; 
        border-top: 1px solid var(--border);
        background: var(--bg-light); 
        flex-wrap: wrap;
    }
    
    .footer-left { 
        display: flex; 
        align-items: center; 
        gap: 16px; 
        flex-wrap: wrap;
    }
    
    .footer-right { 
        display: flex; 
        align-items: center; 
        gap: 12px; 
        flex-wrap: wrap;
    }

    .order-price { 
        font-size: 14px; 
        color: var(--muted);
    }
    
    .order-price strong { 
        font-size: 18px; 
        font-weight: 800; 
        color: var(--primary); 
        margin-left: 4px; 
        letter-spacing: -0.5px;
    }

    .payment-badge {
        display: inline-flex; 
        align-items: center; 
        gap: 6px;
        padding: 5px 12px; 
        border-radius: 20px; 
        font-size: 12px; 
        font-weight: 700; 
        white-space: nowrap;
    }
    
    .payment-badge.paid   { background: rgba(16, 185, 129, 0.1); color: var(--success); }
    .payment-badge.unpaid { background: rgba(239, 68, 68, 0.1); color: var(--error); }

    /* ── WA BUTTON ── */
    .btn-wa {
        display: inline-flex; 
        align-items: center; 
        gap: 8px;
        padding: 10px 18px;
        background: #25d366; 
        color: var(--white);
        border-radius: 8px; 
        text-decoration: none;
        font-size: 13px; 
        font-weight: 700;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(37, 211, 102, 0.2);
        white-space: nowrap;
    }
    
    .btn-wa:hover { 
        background: #1ebe5d; 
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        transform: translateY(-1px);
    }
    
    .btn-wa svg { 
        width: 16px; 
        height: 16px; 
        fill: white; 
        flex-shrink: 0;
    }

    /* no-phone notice */
    .no-phone {
        display: inline-flex; 
        align-items: center; 
        gap: 8px;
        padding: 8px 14px; 
        background: var(--bg-light); 
        border: 1px solid var(--border);
        border-radius: 8px; 
        font-size: 12px; 
        color: var(--muted); 
        font-weight: 500;
    }

    /* ── EMPTY ── */
    .empty-state {
        text-align: center; 
        padding: 60px 20px; 
        color: var(--muted);
        background: var(--white); 
        border: 1px solid var(--border); 
        border-radius: 12px;
    }
    
    .empty-state svg { 
        width: 48px; 
        height: 48px; 
        stroke: #cbd5e1; 
        fill: none; 
        stroke-width: 1.5; 
        margin-bottom: 16px;
    }
    
    .empty-state p { 
        font-size: 15px; 
        margin-bottom: 12px;
        color: var(--dark);
    }
    
    .empty-state a { 
        color: var(--primary); 
        font-size: 14px; 
        font-weight: 700; 
        text-decoration: none;
    }
    
    .empty-state a:hover { 
        text-decoration: underline;
    }

    @media (max-width: 560px) {
        .order-detail-grid { 
            grid-template-columns: 1fr;
        }
        
        .page-header { 
            align-items: stretch;
        }
        
        .btn-new-order { 
            text-align: center;
            width: 100%;
        }
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

    body.dark-theme .order-problem-box { 
        background: rgba(30, 64, 175, 0.1); 
        border-color: #334155;
    }

    body.dark-theme .order-problem-box p { 
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

    body.dark-theme .no-phone { 
        background: rgba(30, 64, 175, 0.1); 
        border-color: #334155; 
        color: #cbd5e1;
    }
</style>

<div class="orders-wrap">

    {{-- PAGE HEADER --}}
    @if(auth()->user()->role == 'user')
        <div class="page-header">
            <div>
                <h1>My Orders</h1>
                <p>Order yang sedang berjalan (pending & on process).</p>
            </div>
            <a href="/orders/create" class="btn-new-order">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                Pesan Teknisi
            </a>
        </div>
    @else
        <div class="page-header">
            <div>
                <h1>Riwayat Pekerjaan</h1>
                <p>Order yang sudah selesai dikerjakan.</p>
            </div>
        </div>
    @endif

    {{-- ORDER LIST --}}
    @forelse($orders as $order)
    <div class="order-card status-{{ $order->status }}">

        {{-- HEADER --}}
        <div class="order-card-header">
            <div class="order-service-info">
                <div class="order-service-icon">
                    <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
                </div>
                <div>
                    <strong>{{ $order->service?->service_name }}</strong>
                    <span>Order #{{ $order->id }} · {{ $order->created_at?->format('d M Y, H:i') }}</span>
                </div>
            </div>

            @if($order->status == 'pending')
                <span class="status-badge pending">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    Menunggu Teknisi
                </span>
            @elseif($order->status == 'process')
                <span class="status-badge process">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="M23 4v6h-6"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
                    Sedang Dikerjakan
                </span>
            @elseif($order->status == 'completed')
                <span class="status-badge completed">Selesai</span>
            @elseif($order->status == 'cancelled')
                <span class="status-badge cancelled">Dibatalkan</span>
            @endif
        </div>

        {{-- BODY --}}
        <div class="order-card-body">
            <div class="order-detail-grid">

                @if(auth()->user()->role == 'technician')
                <div class="order-detail-item">
                    <div class="detail-label">Customer</div>
                    <div class="detail-value">{{ $order->user?->name }}</div>
                </div>
                @endif

                <div class="order-detail-item">
                    <div class="detail-label">Teknisi</div>
                    <div class="detail-value">{{ $order->technician?->user?->name ?? 'Belum Ada Teknisi' }}</div>
                </div>

                <div class="order-detail-item full">
                    <div class="detail-label">Alamat</div>
                    <div class="detail-value">{{ $order->address }}</div>
                </div>

            </div>

            <div class="order-problem-box">
                <div class="detail-label">Deskripsi Masalah</div>
                <p>{{ $order->problem_description }}</p>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="order-card-footer">
            <div class="footer-left">
                <div class="order-price">
                    Total Biaya <strong>Rp {{ number_format($order->price) }}</strong>
                </div>
                @if($order->payment_status == 'paid')
                    <span class="payment-badge paid">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                        Lunas
                    </span>
                @else
                    <span class="payment-badge unpaid">Belum Dibayar</span>
                @endif
            </div>

            {{-- TOMBOL CHAT WA — hanya muncul saat status 'process' --}}
            @if(auth()->user()->role == 'user' && $order->status == 'process')
                <div class="footer-right">
                    @php
                        $techPhone = $order->technician?->user?->phone;
                        $waNumber  = preg_replace('/[^0-9]/', '', $techPhone ?? '');
                        if (str_starts_with($waNumber, '0')) {
                            $waNumber = '62' . substr($waNumber, 1);
                        }
                        $waMsg = urlencode('Halo, saya ' . auth()->user()->name . ' ingin menanyakan progress order servis ' . ($order->service?->service_name ?? '') . ' (Order #' . $order->id . ').');
                        $waUrl = 'https://wa.me/' . $waNumber . '?text=' . $waMsg;
                    @endphp

                    @if($techPhone)
                        <a href="{{ $waUrl }}" target="_blank" class="btn-wa">
                            {{-- WhatsApp SVG logo --}}
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M16 .5C7.44.5.5 7.44.5 16c0 2.83.74 5.49 2.04 7.8L.5 31.5l7.93-2.07A15.45 15.45 0 0016 31.5c8.56 0 15.5-6.94 15.5-15.5S24.56.5 16 .5zm0 28.3a12.73 12.73 0 01-6.5-1.78l-.46-.28-4.71 1.23 1.26-4.6-.3-.48A12.8 12.8 0 113.2 16c0-7.06 5.74-12.8 12.8-12.8S28.8 8.94 28.8 16 23.06 28.8 16 28.8zm7.02-9.57c-.38-.19-2.27-1.12-2.62-1.25-.35-.13-.6-.19-.86.19-.25.38-.98 1.25-1.2 1.5-.22.26-.44.29-.82.1a10.4 10.4 0 01-3.07-1.9 11.56 11.56 0 01-2.13-2.65c-.22-.38-.02-.58.17-.77.17-.17.38-.44.57-.66.19-.22.25-.38.38-.63.13-.25.06-.47-.03-.66-.1-.19-.86-2.08-1.18-2.84-.31-.74-.63-.64-.86-.65h-.73c-.25 0-.66.1-1.01.47-.35.38-1.33 1.3-1.33 3.17s1.37 3.67 1.56 3.92c.19.25 2.7 4.12 6.54 5.78.91.4 1.63.63 2.18.8.92.29 1.75.25 2.41.15.74-.11 2.27-.93 2.59-1.83.32-.9.32-1.67.22-1.83-.09-.17-.35-.26-.73-.45z"/></svg>
                            Chat Teknisi
                        </a>
                    @else
                        <span class="no-phone">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            No. HP teknisi belum terdaftar
                        </span>
                    @endif
                </div>
            @endif

        </div>

    </div>
    @empty
        <div class="empty-state">
            <svg viewBox="0 0 24 24"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            <p>Tidak ada order aktif saat ini.</p>
            @if(auth()->user()->role == 'user')
                <a href="/orders/create">Buat order sekarang →</a>
            @endif
        </div>
    @endforelse

</div>

@endsection