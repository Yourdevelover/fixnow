@extends('layouts.admin')

@section('content')

<style>
    .page-header {
        margin-bottom: 22px;
    }

    .page-header h1 {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
    }

    .page-header p {
        font-size: 13px;
        color: var(--muted);
        margin-top: 2px;
    }

    /* ── ALERT ── */
    .alert-success {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #ecfdf5;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 12px 18px;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    /* ── SUMMARY CARDS ── */
    .stat-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 26px;
    }

    .stat-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 1px 4px rgba(35, 90, 157, 0.07);
        position: relative;
        overflow: hidden;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 14px;
        position: relative;
        z-index: 1;
    }

    .stat-card.total .stat-icon    { background: var(--light); color: var(--navy); }
    .stat-card.pending .stat-icon  { background: #fffbeb; color: #d97706; }
    .stat-card.approved .stat-icon { background: #ecfdf5; color: #16a34a; }
    .stat-card.rejected .stat-icon { background: #fef2f2; color: #dc2626; }

    .stat-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
        position: relative;
        z-index: 1;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -1px;
        position: relative;
        z-index: 1;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 90px; height: 90px;
        border-radius: 50%;
        opacity: 0.06;
    }

    .stat-card.total::after    { background: var(--navy); }
    .stat-card.pending::after  { background: #d97706; }
    .stat-card.approved::after { background: #16a34a; }
    .stat-card.rejected::after { background: #dc2626; }

    /* ── APPLICATION CARD ── */
    .application-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(35, 90, 157, 0.07);
        margin-bottom: 18px;
        overflow: hidden;
        transition: box-shadow 0.18s;
    }

    .application-card:hover {
        box-shadow: 0 6px 18px rgba(35, 90, 157, 0.10);
    }

    .application-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 18px 22px;
        border-bottom: 1px solid var(--border);
    }

    .applicant-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .applicant-avatar {
        width: 42px; height: 42px;
        border-radius: 50%;
        background: var(--light);
        color: var(--navy);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 16px;
        flex-shrink: 0;
    }

    .applicant-info strong {
        display: block;
        font-size: 14.5px;
        font-weight: 700;
        color: #0f172a;
    }

    .applicant-info span {
        font-size: 12.5px;
        color: var(--muted);
    }

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

    .status-badge.pending  { background: #fffbeb; color: #d97706; }
    .status-badge.approved { background: #ecfdf5; color: #16a34a; }
    .status-badge.rejected { background: #fef2f2; color: #dc2626; }

    .application-body {
        padding: 18px 22px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 16px;
    }

    .detail-item .detail-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .detail-item .detail-value {
        font-size: 14px;
        font-weight: 600;
        color: #0f172a;
    }

    .description-box {
        background: var(--light);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 14px 16px;
    }

    .description-box .detail-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .description-box p {
        font-size: 13.5px;
        color: #334155;
        line-height: 1.6;
    }

    .application-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 14px 22px;
        border-top: 1px solid var(--border);
        background: #fafcff;
    }

    .btn-approve, .btn-reject {
        padding: 9px 22px;
        border: none;
        border-radius: 9px;
        font-size: 13.5px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: background 0.18s, box-shadow 0.18s, transform 0.1s;
    }

    .btn-approve {
        background: #16a34a;
        color: white;
        box-shadow: 0 3px 10px rgba(22, 163, 74, 0.25);
    }

    .btn-approve:hover { background: #15803d; }

    .btn-reject {
        background: white;
        color: #dc2626;
        border: 1.5px solid #fecaca;
    }

    .btn-reject:hover { background: #fef2f2; }

    .btn-approve:active, .btn-reject:active { transform: scale(0.98); }

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

    @media (max-width: 1024px) {
        .stat-cards { grid-template-columns: repeat(2, 1fr); }
        .detail-grid { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 640px) {
        .stat-cards { grid-template-columns: 1fr; }
        .detail-grid { grid-template-columns: 1fr; }
        .application-header { flex-direction: column; align-items: flex-start; }
    }
</style>

<div class="page-header">
    <h1>Technician Applications</h1>
    <p>Tinjau dan kelola lamaran teknisi yang masuk</p>
</div>

@if(session('success'))
    <div class="alert-success">✅ {{ session('success') }}</div>
@endif

@php
    $pendingCount  = $applications->where('status', 'pending')->count();
    $approvedCount = $applications->where('status', 'approved')->count();
    $rejectedCount = $applications->where('status', 'rejected')->count();
@endphp

<div class="stat-cards">
    <div class="stat-card total">
        <div class="stat-icon">📋</div>
        <div class="stat-label">Total Lamaran</div>
        <div class="stat-value">{{ $applications->count() }}</div>
    </div>
    <div class="stat-card pending">
        <div class="stat-icon">⏳</div>
        <div class="stat-label">Pending</div>
        <div class="stat-value">{{ $pendingCount }}</div>
    </div>
    <div class="stat-card approved">
        <div class="stat-icon">✅</div>
        <div class="stat-label">Approved</div>
        <div class="stat-value">{{ $approvedCount }}</div>
    </div>
    <div class="stat-card rejected">
        <div class="stat-icon">❌</div>
        <div class="stat-label">Rejected</div>
        <div class="stat-value">{{ $rejectedCount }}</div>
    </div>
</div>

@forelse($applications as $app)
<div class="application-card">

    <div class="application-header">
        <div class="applicant-info">
            <div class="applicant-avatar">{{ strtoupper(substr($app->user->name, 0, 1)) }}</div>
            <div>
                <strong>{{ $app->user->name }}</strong>
                <span>{{ $app->user->email }} &nbsp;•&nbsp; Mendaftar {{ $app->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>

        @if($app->status === 'pending')
            <span class="status-badge pending">⏳ Pending</span>
        @elseif($app->status === 'approved')
            <span class="status-badge approved">✅ Approved</span>
        @else
            <span class="status-badge rejected">❌ Rejected</span>
        @endif
    </div>

    <div class="application-body">
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Service Dipilih</div>
                <div class="detail-value">{{ $app->service->service_name ?? '-' }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Pengalaman</div>
                <div class="detail-value">{{ $app->experience }} tahun</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Spesialisasi</div>
                <div class="detail-value">{{ $app->specialist }}</div>
            </div>
        </div>

        <div class="description-box">
            <div class="detail-label">Deskripsi</div>
            <p>{{ $app->description ?: '-' }}</p>
        </div>
    </div>

    @if($app->status === 'pending')
    <div class="application-footer">
        <form method="POST" action="/admin/applications/{{ $app->id }}/reject">
            @csrf
            @method('PUT')
            <button type="submit" class="btn-reject">Reject</button>
        </form>

        <form method="POST" action="/admin/applications/{{ $app->id }}/approve">
            @csrf
            @method('PUT')
            <button type="submit" class="btn-approve">Approve</button>
        </form>
    </div>
    @endif

</div>
@empty
<div class="empty-state">
    <div class="empty-icon">📭</div>
    <p>Belum ada lamaran masuk.</p>
</div>
@endforelse

@endsection