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

    .page-header { 
        margin-bottom: 28px;
    }
    
    .page-header h1 { 
        font-size: 28px; 
        font-weight: 800; 
        color: var(--dark); 
        margin-bottom: 6px;
    }
    
    .page-header p { 
        font-size: 14px; 
        color: var(--muted);
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }
    
    .stat-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
    }
    
    .stat-card:hover {
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.1);
        transform: translateY(-2px);
    }
    
    .stat-label { 
        font-size: 11px; 
        font-weight: 700; 
        text-transform: uppercase; 
        letter-spacing: 0.7px; 
        color: var(--muted); 
        margin-bottom: 8px;
    }
    
    .stat-value { 
        font-size: 32px; 
        font-weight: 800; 
        color: var(--dark);
    }
    
    .stat-value.blue  { color: var(--primary); }
    .stat-value.amber { color: var(--warning); }
    .stat-value.green { color: var(--success); }

    .section-title {
        font-size: 12px; 
        font-weight: 700; 
        text-transform: uppercase;
        letter-spacing: 0.7px; 
        color: var(--primary); 
        margin-bottom: 16px;
        display: flex; 
        align-items: center; 
        gap: 8px;
    }
    
    .section-title::after { 
        content: ''; 
        flex: 1; 
        height: 1px; 
        background: var(--border);
    }

    .order-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
    }
    
    .order-card:hover { 
        box-shadow: 0 4px 16px rgba(30, 64, 175, 0.12);
        border-color: var(--primary-light);
    }
    
    .order-card.pending { border-left: 4px solid var(--warning); }
    .order-card.process { border-left: 4px solid var(--primary); }

    .card-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: flex-start; 
        margin-bottom: 16px;
    }
    
    .service-name { 
        font-size: 16px; 
        font-weight: 700; 
        color: var(--dark);
    }
    
    .order-id-text { 
        font-size: 13px; 
        color: var(--muted); 
        margin-top: 4px;
    }

    .badge { 
        padding: 5px 12px; 
        border-radius: 20px; 
        font-size: 12px; 
        font-weight: 700; 
        white-space: nowrap;
    }
    
    .badge.pending { 
        background: rgba(245, 158, 11, 0.1); 
        color: var(--warning);
    }
    
    .badge.process { 
        background: rgba(30, 64, 175, 0.1); 
        color: var(--primary);
    }

    .info-grid { 
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 12px 24px; 
        margin-bottom: 16px;
    }
    
    .info-item .lbl { 
        font-size: 11px; 
        font-weight: 700; 
        text-transform: uppercase; 
        letter-spacing: 0.7px; 
        color: var(--muted); 
        margin-bottom: 4px;
    }
    
    .info-item .val { 
        font-size: 14px; 
        color: var(--dark); 
        font-weight: 500;
    }
    
    .info-item.full { 
        grid-column: span 2;
    }

    .pay-badge { 
        display: inline-block; 
        padding: 4px 10px; 
        border-radius: 20px; 
        font-size: 12px; 
        font-weight: 600;
    }
    
    .pay-paid { 
        background: rgba(16, 185, 129, 0.1); 
        color: var(--success);
    }
    
    .pay-unpaid { 
        background: rgba(239, 68, 68, 0.1); 
        color: var(--error);
    }

    .divider { 
        border: none; 
        border-top: 1px solid var(--border); 
        margin: 0 0 16px;
    }

    .card-footer { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        flex-wrap: wrap; 
        gap: 12px;
    }
    
    .order-date { 
        font-size: 12px; 
        color: var(--muted);
    }

    .btn-update {
        display: inline-flex; 
        align-items: center; 
        gap: 8px;
        padding: 10px 20px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white; 
        text-decoration: none; 
        border-radius: 8px;
        font-size: 14px; 
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(30, 64, 175, 0.2);
        transition: all 0.2s ease;
    }
    
    .btn-update:hover { 
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        transform: translateY(-1px);
    }

    .empty-state {
        background: var(--white); 
        border: 1px dashed var(--border);
        border-radius: 12px; 
        padding: 60px 24px; 
        text-align: center;
    }
    
    .empty-icon { 
        font-size: 48px; 
        margin-bottom: 16px;
    }
    
    .empty-state h3 { 
        font-size: 17px; 
        font-weight: 700; 
        color: var(--dark); 
        margin-bottom: 8px;
    }
    
    .empty-state p { 
        font-size: 14px; 
        color: var(--muted);
    }
</style>

{{-- Header --}}
<div class="page-header">
    <h1>📥 Incoming Orders</h1>
    <p>Order aktif yang sedang ditangani. Update status sesuai progres pekerjaan.</p>
</div>

{{-- Stats --}}
@php
    $totalOrders   = $myOrders->count();
    $pendingOrders = $myOrders->where('status', 'pending')->count();
    $processOrders = $myOrders->where('status', 'process')->count();
@endphp

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-label">Total Aktif</div>
        <div class="stat-value blue">{{ $totalOrders }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Menunggu</div>
        <div class="stat-value amber">{{ $pendingOrders }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Sedang Dikerjakan</div>
        <div class="stat-value green">{{ $processOrders }}</div>
    </div>
</div>

@if($myOrders->isNotEmpty())

    @if($myOrders->where('status','process')->isNotEmpty())
        <div class="section-title">🔵 Sedang Dikerjakan</div>
        @foreach($myOrders->where('status','process') as $order)
            <div class="order-card process">
                <div class="card-header">
                    <div>
                        <div class="service-name">{{ $order->service?->service_name }}</div>
                        <div class="order-id-text">Order #{{ $order->id }}</div>
                    </div>
                    <span class="badge process">On Process</span>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="lbl">Customer</div>
                        <div class="val">{{ $order->user?->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Harga</div>
                        <div class="val">Rp {{ number_format($order->price) }}</div>
                    </div>
                    <div class="info-item full">
                        <div class="lbl">Alamat</div>
                        <div class="val">{{ $order->address }}</div>
                    </div>
                    <div class="info-item full">
                        <div class="lbl">Deskripsi Masalah</div>
                        <div class="val">{{ $order->problem_description }}</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Payment</div>
                        <div class="val">
                            <span class="pay-badge {{ $order->payment_status == 'paid' ? 'pay-paid' : 'pay-unpaid' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>
                <hr class="divider">
                <div class="card-footer">
                    <span class="order-date">🕒 {{ $order->created_at->format('d M Y, H:i') }}</span>
                    <a href="/orders/{{ $order->id }}/status" class="btn-update">
                        ✏️ Update Status
                    </a>
                </div>
            </div>
        @endforeach
    @endif

    @if($myOrders->where('status','pending')->isNotEmpty())
        <div class="section-title" style="margin-top:10px;">🟡 Menunggu Dikerjakan</div>
        @foreach($myOrders->where('status','pending') as $order)
            <div class="order-card pending">
                <div class="card-header">
                    <div>
                        <div class="service-name">{{ $order->service?->service_name }}</div>
                        <div class="order-id-text">Order #{{ $order->id }}</div>
                    </div>
                    <span class="badge pending">Pending</span>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="lbl">Customer</div>
                        <div class="val">{{ $order->user?->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Harga</div>
                        <div class="val">Rp {{ number_format($order->price) }}</div>
                    </div>
                    <div class="info-item full">
                        <div class="lbl">Alamat</div>
                        <div class="val">{{ $order->address }}</div>
                    </div>
                    <div class="info-item full">
                        <div class="lbl">Deskripsi Masalah</div>
                        <div class="val">{{ $order->problem_description }}</div>
                    </div>
                    <div class="info-item">
                        <div class="lbl">Payment</div>
                        <div class="val">
                            <span class="pay-badge {{ $order->payment_status == 'paid' ? 'pay-paid' : 'pay-unpaid' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>
                <hr class="divider">
                <div class="card-footer">
                    <span class="order-date">🕒 {{ $order->created_at->format('d M Y, H:i') }}</span>
                    <a href="/orders/{{ $order->id }}/status" class="btn-update">
                        ✏️ Update Status
                    </a>
                </div>
            </div>
        @endforeach
    @endif

@else
    <div class="empty-state">
        <div class="empty-icon">📭</div>
        <h3>Tidak ada order aktif</h3>
        <p>Semua order sudah selesai atau belum ada order masuk.</p>
    </div>
@endif

@endsection