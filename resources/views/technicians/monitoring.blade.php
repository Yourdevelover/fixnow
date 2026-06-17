@extends('layouts.admin')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
        <h1 style="font-size:22px; font-weight:600; margin-bottom:4px;">Technician Monitoring</h1>
        <p style="color:#64748b; font-size:14px;">{{ $technicians->count() }} teknisi terdaftar</p>
    </div>
    <a href="/admin/technicians/create"
        style="display:inline-flex; align-items:center; gap:8px; padding:10px 18px; background:#2563eb; color:white; text-decoration:none; border-radius:8px; font-size:14px; font-weight:500;">
        + Tambah Teknisi
    </a>
</div>

@if(session('success'))
    <div style="background:#dcfce7; color:#166534; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:14px;">
        ✓ {{ session('success') }}
    </div>
@endif

{{-- Stat cards --}}
<div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:24px;">
    <div style="background:white; border-radius:12px; padding:20px; box-shadow:0 1px 4px rgba(0,0,0,.08);">
        <div style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; color:#94a3b8; margin-bottom:8px;">Total Teknisi</div>
        <div style="font-size:28px; font-weight:700; color:#1e293b;">{{ $technicians->count() }}</div>
    </div>
    <div style="background:white; border-radius:12px; padding:20px; box-shadow:0 1px 4px rgba(0,0,0,.08);">
        <div style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; color:#94a3b8; margin-bottom:8px;">Sedang Tersedia</div>
        <div style="font-size:28px; font-weight:700; color:#16a34a;">{{ $technicians->where('availability_status','available')->count() }}</div>
    </div>
    <div style="background:white; border-radius:12px; padding:20px; box-shadow:0 1px 4px rgba(0,0,0,.08);">
        <div style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; color:#94a3b8; margin-bottom:8px;">Sedang Sibuk</div>
        <div style="font-size:28px; font-weight:700; color:#dc2626;">{{ $technicians->where('availability_status','busy')->count() }}</div>
    </div>
</div>

<div style="background:white; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,.08); overflow:hidden;">

    {{-- Filter --}}
    <div style="padding:16px 20px; border-bottom:1px solid #f1f5f9; display:flex; gap:8px;">
        <span style="font-size:13px; font-weight:600; color:#1e293b; padding:6px 14px; border-radius:20px; background:#1e293b; color:white; cursor:pointer;"
            onclick="filterStatus('all')" id="filter-all">Semua</span>
        <span style="font-size:13px; color:#64748b; padding:6px 14px; border-radius:20px; cursor:pointer;"
            onclick="filterStatus('available')" id="filter-available">Tersedia</span>
        <span style="font-size:13px; color:#64748b; padding:6px 14px; border-radius:20px; cursor:pointer;"
            onclick="filterStatus('busy')" id="filter-busy">Sibuk</span>
    </div>

    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#f8fafc; border-bottom:1px solid #e2e8f0;">
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Teknisi</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Layanan</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Pengalaman</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Rating</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Order</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Status</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($technicians as $tech)
            <tr class="tech-row" data-status="{{ $tech->availability_status }}"
                style="border-bottom:1px solid #f1f5f9; transition:background .1s;"
                onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background=''">

                <td style="padding:14px 20px;">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <div style="width:36px; height:36px; border-radius:50%; background:#eff6ff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:12px; color:#2563eb; flex-shrink:0;">
                            {{ strtoupper(substr($tech->user->name, 0, 2)) }}
                        </div>
                        <div>
                            <div style="font-size:14px; font-weight:500; color:#1e293b;">{{ $tech->user->name }}</div>
                            <div style="font-size:12px; color:#94a3b8;">{{ $tech->user->email }}</div>
                        </div>
                    </div>
                </td>

                <td style="padding:14px 20px;">
                    <div style="font-size:13px; font-weight:500; color:#1e293b;">{{ $tech->service->service_name ?? '-' }}</div>
                    <div style="font-size:12px; color:#94a3b8;">{{ $tech->specialist }}</div>
                </td>

                <td style="padding:14px 20px; font-size:14px; color:#475569;">
                    {{ $tech->experience }} thn
                </td>

                <td style="padding:14px 20px;">
                    <div style="display:flex; align-items:center; gap:4px;">
                        <span style="color:#f59e0b; font-size:14px;">★</span>
                        <span style="font-size:14px; font-weight:600; color:#1e293b;">{{ number_format($tech->rating, 1) }}</span>
                    </div>
                </td>

                <td style="padding:14px 20px;">
                    <div style="font-size:13px; color:#1e293b;">
                        <span style="font-weight:600;">{{ $tech->orders_count }}</span> total
                    </div>
                    <div style="font-size:12px; color:#16a34a;">{{ $tech->completed_orders_count }} selesai</div>
                </td>

                <td style="padding:14px 20px;">
                    @if($tech->availability_status === 'available')
                        <span style="background:#dcfce7; color:#166534; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">Tersedia</span>
                    @else
                        <span style="background:#fee2e2; color:#991b1b; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">Sibuk</span>
                    @endif
                </td>

                <td style="padding:14px 20px;">
                    <form method="POST" action="/admin/technicians/{{ $tech->id }}/toggle-availability">
                        @csrf
                        <button type="submit"
                            style="padding:6px 14px; border:none; border-radius:6px; cursor:pointer; font-size:13px; font-weight:500;
                            background:{{ $tech->availability_status === 'available' ? '#fee2e2' : '#dcfce7' }};
                            color:{{ $tech->availability_status === 'available' ? '#dc2626' : '#16a34a' }};">
                            {{ $tech->availability_status === 'available' ? 'Set Sibuk' : 'Set Tersedia' }}
                        </button>
                    </form>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding:40px; text-align:center; color:#94a3b8; font-size:14px;">
                    Belum ada teknisi terdaftar.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function filterStatus(status) {
    ['all','available','busy'].forEach(s => {
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
    document.querySelectorAll('.tech-row').forEach(row => {
        row.style.display = (status === 'all' || row.dataset.status === status) ? '' : 'none';
    });
}
</script>

@endsection