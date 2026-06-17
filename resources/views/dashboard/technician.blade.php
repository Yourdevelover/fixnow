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
    }

    .dash-wrap {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .page-header {
        margin-bottom: 28px;
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

    /* ── STAT CARDS ── */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(30, 64, 175, 0.05);
        transition: all 0.2s ease;
    }

    .stat-card:hover {
        border-color: var(--primary-light);
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.1);
    }

    .stat-card .stat-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.7px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .stat-card .stat-value {
        font-size: 32px;
        font-weight: 800;
        color: var(--primary);
        letter-spacing: -1px;
        line-height: 1;
    }

    .stat-card .stat-sub {
        font-size: 12px;
        color: var(--muted);
        margin-top: 8px;
    }

    /* availability badge */
    .avail-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 10px;
    }

    .avail-badge.available {
        background: #f0fdf4;
        color: #16a34a;
        border: 1px solid #86efac;
    }

    .avail-badge.unavailable {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    /* ── SECTION CARD ── */
    .section-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(30, 64, 175, 0.05);
        margin-bottom: 20px;
    }

    .section-header {
        padding: 18px 20px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--bg-light);
    }

    .section-header-icon {
        width: 36px; 
        height: 36px;
        background: rgba(30, 64, 175, 0.1);
        border: 1px solid var(--border);
        border-radius: 8px;
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
        color: var(--primary);
    }

    .section-header-text h3 {
        font-size: 15px;
        font-weight: 700;
        color: var(--dark);
    }

    .section-header-text p {
        font-size: 12px;
        color: var(--muted);
        margin-top: 2px;
    }

    .section-body {
        padding: 20px;
    }

    /* ── INFO GRID ── */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .info-item label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.7px;
        margin-bottom: 6px;
    }

    .info-item p {
        font-size: 14px;
        font-weight: 500;
        color: var(--dark);
    }

    /* ── RATING ── */
    .rating-display {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .rating-score {
        font-size: 40px;
        font-weight: 800;
        color: var(--primary);
        letter-spacing: -1px;
        line-height: 1;
    }

    .rating-stars {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .stars {
        color: #f59e0b;
        font-size: 18px;
        letter-spacing: 1px;
    }

    .rating-count {
        font-size: 12px;
        color: var(--muted);
    }

    /* ── SHORTCUT CARDS ── */
    .shortcut-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 24px;
    }

    .shortcut-card {
        text-decoration: none;
        display: block;
        padding: 18px 20px;
        border-radius: 12px;
        border: 1.5px solid #d0e8f8;
        background: #ffffff;
        color: #1e293b;
        transition: transform 0.15s, box-shadow 0.15s, border-color 0.15s;
        box-shadow: 0 1px 3px rgba(35, 90, 157, 0.06);
    }

    .shortcut-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(35, 90, 157, 0.12);
        border-color: #aae0fc;
    }

    .shortcut-card.primary {
        background: linear-gradient(135deg, #235a9d 0%, #1a4a8a 100%);
        border-color: transparent;
        color: #ffffff;
    }

    .shortcut-card.primary:hover {
        box-shadow: 0 6px 20px rgba(35, 90, 157, 0.35);
    }

    .shortcut-card .sc-icon { font-size: 24px; margin-bottom: 8px; display: block; }
    .shortcut-card .sc-title { font-size: 14px; font-weight: 700; margin-bottom: 2px; }
    .shortcut-card .sc-desc { font-size: 12px; opacity: 0.65; }
    .shortcut-card.primary .sc-desc { color: #aae0fc; opacity: 1; }
</style>

<div class="dash-wrap">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <h1>Dashboard Teknisi</h1>
        <p>Selamat datang, {{ auth()->user()->name }}! Pantau order dan performa kamu di sini.</p>
    </div>

    {{-- STAT CARDS --}}
    <div class="stat-grid">

        <div class="stat-card">
            <div class="stat-label">📦 Total Orders</div>
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-sub">Semua order yang pernah masuk</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">✅ Selesai</div>
            <div class="stat-value">{{ $completedOrders }}</div>
            <div class="stat-sub">Order berhasil diselesaikan</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">🟢 Status</div>
            @if($technician)
                <div class="stat-value" style="font-size:18px; margin-top:4px;">
                    @if($technician->availability_status === 'available')
                        <span class="avail-badge available">● Tersedia</span>
                    @else
                        <span class="avail-badge unavailable">● Tidak Tersedia</span>
                    @endif
                </div>
            @else
                <div class="stat-value" style="font-size:14px; margin-top:4px; color:#94a3b8;">Belum ada profil</div>
            @endif
        </div>

    </div>

    {{-- SHORTCUT --}}
    <div class="shortcut-grid">
        <a href="/technician/orders" class="shortcut-card">
            <span class="sc-icon">📥</span>
            <div class="sc-title">Incoming Orders</div>
            <div class="sc-desc">Lihat & terima order masuk</div>
        </a>
        <a href="/orders" class="shortcut-card">
            <span class="sc-icon">📋</span>
            <div class="sc-title">Riwayat Pekerjaan</div>
            <div class="sc-desc">Semua order yang sudah dikerjakan</div>
        </a>
    </div>

    {{-- INFO TEKNISI --}}
    @if($technician)
    <div class="section-card">
        <div class="section-header">
            <div class="section-header-icon">🛠️</div>
            <div class="section-header-text">
                <h3>Info Teknisi</h3>
                <p>Data spesialisasi dan pengalaman kamu</p>
            </div>
        </div>
        <div class="section-body">
            <div class="info-grid">
                <div class="info-item">
                    <label>Spesialisasi</label>
                    <p>{{ $technician->specialist ?? '—' }}</p>
                </div>
                <div class="info-item">
                    <label>Pengalaman</label>
                    <p>{{ $technician->experience ?? '—' }} tahun</p>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="section-card">
        <div class="section-body" style="text-align:center; padding:32px 20px; color:#64748b;">
            <div style="font-size:36px; margin-bottom:12px;">🛠️</div>
            <p style="font-weight:600; color:#0f172a; margin-bottom:4px;">Profil teknisi belum ditemukan</p>
            <p style="font-size:13px;">Kalau akun ini sudah di-approve, data teknisi seharusnya sudah tersedia.</p>
        </div>
    </div>
    @endif

    {{-- RATING --}}
    <div class="section-card">
        <div class="section-header">
            <div class="section-header-icon">⭐</div>
            <div class="section-header-text">
                <h3>Rating</h3>
                <p>Penilaian dari pengguna yang pernah menggunakan jasamu</p>
            </div>
        </div>
        <div class="section-body">
            @if($technician && $ratingCount > 0)
                @php
                    $filled = (int) round($ratingAverage);
                    $empty  = max(0, 5 - $filled);
                @endphp
                <div class="rating-display">
                    <div class="rating-score">{{ number_format($ratingAverage, 1, ',', '') }}</div>
                    <div class="rating-stars">
                        <div class="stars">{{ str_repeat('★', $filled) }}{{ str_repeat('☆', $empty) }}</div>
                        <div class="rating-count">dari {{ $ratingCount }} ulasan pengguna</div>
                    </div>
                </div>
            @else
                <p style="color:#94a3b8; font-size:13.5px;">Belum ada rating dari pengguna.</p>
            @endif
        </div>
    </div>

</div>

@endsection