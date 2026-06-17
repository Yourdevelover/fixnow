@extends('layouts.admin')

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
        --info:       #3b82f6;
    }

    .page-header {
        margin-bottom: 28px;
    }

    .page-header h1 {
        font-size: 28px;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 4px;
    }

    .page-header p {
        font-size: 14px;
        color: var(--muted);
    }

    .stat-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(30, 64, 175, 0.12);
        border-color: var(--primary-light);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 16px;
        position: relative;
        z-index: 1;
    }

    .stat-icon svg {
        width: 24px;
        height: 24px;
    }

    .stat-card.users .stat-icon       { background: rgba(30, 64, 175, 0.1); color: var(--primary); }
    .stat-card.technicians .stat-icon { background: rgba(16, 185, 129, 0.1); color: var(--success); }
    .stat-card.services .stat-icon    { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
    .stat-card.orders .stat-icon      { background: rgba(14, 165, 233, 0.1); color: var(--accent); }

    .stat-label {
        font-size: 12px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.7px;
        margin-bottom: 8px;
        position: relative;
        z-index: 1;
    }

    .stat-value {
        font-size: 34px;
        font-weight: 800;
        color: var(--dark);
        letter-spacing: -1px;
        position: relative;
        z-index: 1;
        margin-bottom: 4px;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        opacity: 0.05;
    }

    .stat-card.users::after       { background: var(--primary); }
    .stat-card.technicians::after { background: var(--success); }
    .stat-card.services::after    { background: var(--warning); }
    .stat-card.orders::after      { background: var(--accent); }
    .stat-card.orders::after      { background: #7c3aed; }

    @media (max-width: 1024px) {
        .stat-cards { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 560px) {
        .stat-cards { grid-template-columns: 1fr; }
    }

    /* ── SECTION TITLE ── */
    .section-title {
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
        margin: 28px 0 14px;
    }

    /* ── QUICK ACTIONS ── */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .quick-action {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        transition: all 0.18s;
        box-shadow: 0 1px 4px rgba(35, 90, 157, 0.06);
    }

    .quick-action:hover {
        border-color: var(--navy);
        background: var(--light);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(35, 90, 157, 0.12);
    }

    .quick-action-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: var(--light);
        color: var(--navy);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
    }

    .quick-action-icon svg {
        width: 18px;
        height: 18px;
    }

    .quick-action-text strong {
        display: block;
        font-size: 13.5px;
        font-weight: 700;
        color: #0f172a;
    }

    .quick-action-text span {
        font-size: 11.5px;
        color: var(--muted);
    }

    /* ── RECENT USERS ── */
    .table-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(35, 90, 157, 0.07);
        overflow: hidden;
    }

    .table-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 22px;
        border-bottom: 1px solid var(--border);
    }

    .table-card-header h3 {
        font-size: 14.5px;
        font-weight: 700;
        color: #0f172a;
    }

    .table-card-header a {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--navy);
        text-decoration: none;
    }

    .table-card-header a:hover {
        text-decoration: underline;
    }

    .recent-table {
        width: 100%;
        border-collapse: collapse;
    }

    .recent-table th {
        text-align: left;
        font-size: 11.5px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 10px 22px;
        background: var(--light);
        border-bottom: 1px solid var(--border);
    }

    .recent-table td {
        padding: 13px 22px;
        font-size: 13.5px;
        color: #1e293b;
        border-bottom: 1px solid var(--border);
    }

    .recent-table tr:last-child td {
        border-bottom: none;
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar-sm {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--light);
        color: var(--navy);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
        border: 1px solid var(--border);
    }

    .role-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
    }

    .role-badge.admin      { background: var(--light); color: var(--navy); }
    .role-badge.technician { background: #ecfdf5; color: #16a34a; }
    .role-badge.user       { background: #f5f3ff; color: #7c3aed; }

    @media (max-width: 1024px) {
        .quick-actions { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 560px) {
        .quick-actions { grid-template-columns: 1fr; }
        .recent-table th:nth-child(3),
        .recent-table td:nth-child(3) { display: none; }
    }
</style>

<div class="page-header">
    <h1>Dashboard</h1>
    <p>Ringkasan aktivitas platform FixNow</p>
</div>

<div class="stat-cards">

    <div class="stat-card users">
        <div class="stat-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 001.905 3.959c-.023.222-.014.442.025.654A4.97 4.97 0 011.49 15.326zM16.44 15.98a4.97 4.97 0 01-1.962.298 5.972 5.972 0 002.024-2.945 6.491 6.491 0 00-1.902-3.916 3 3 0 014.308 3.517.78.78 0 01-.358.442A4.97 4.97 0 0116.44 15.98zM18 8a2 2 0 11-4 0 2 2 0 014 0zM5.304 16.19a.844.844 0 01-.277-.71 5 5 0 019.947 0 .843.843 0 01-.277.71A6.975 6.975 0 0110 18a6.974 6.974 0 01-4.696-1.81z"/></svg></div>
        <div class="stat-label">Total Users</div>
        <div class="stat-value">{{ $totalUsers }}</div>
    </div>

    <div class="stat-card technicians">
        <div class="stat-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M14.5 10a4.5 4.5 0 004.284-5.882c-.105-.324-.51-.391-.752-.15L15.34 6.66a.454.454 0 01-.493.11 3.01 3.01 0 01-1.618-1.616.455.455 0 01.11-.494l2.694-2.692c.24-.241.174-.647-.15-.752a4.5 4.5 0 00-5.873 4.575c.055.873-.128 1.808-.8 2.368l-7.23 6.024a2.724 2.724 0 103.837 3.837l6.024-7.23c.56-.672 1.495-.855 2.368-.8.105.007.21.01.316.01zM5 16a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/></svg></div>
        <div class="stat-label">Total Technicians</div>
        <div class="stat-value">{{ $totalTechnicians }}</div>
    </div>

    <div class="stat-card services">
        <div class="stat-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.34 1.804A1 1 0 019.32 1h1.36a1 1 0 01.98.804l.295 1.473c.497.144.971.342 1.416.587l1.25-.834a1 1 0 011.262.125l.962.962a1 1 0 01.125 1.262l-.834 1.25c.245.445.443.919.587 1.416l1.473.294a1 1 0 01.804.98v1.361a1 1 0 01-.804.98l-1.473.295a6.95 6.95 0 01-.587 1.416l.834 1.25a1 1 0 01-.125 1.262l-.962.962a1 1 0 01-1.262.125l-1.25-.834a6.953 6.953 0 01-1.416.587l-.294 1.473a1 1 0 01-.98.804H9.32a1 1 0 01-.98-.804l-.295-1.473a6.957 6.957 0 01-1.416-.587l-1.25.834a1 1 0 01-1.262-.125l-.962-.962a1 1 0 01-.125-1.262l.834-1.25a6.957 6.957 0 01-.587-1.416l-1.473-.295A1 1 0 011 10.68V9.32a1 1 0 01.804-.98l1.473-.295c.144-.497.342-.971.587-1.416l-.834-1.25a1 1 0 01.125-1.262l.962-.962A1 1 0 015.38 3.03l1.25.834a6.957 6.957 0 011.416-.587l.294-1.473zM13 10a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd"/></svg></div>
        <div class="stat-label">Total Services</div>
        <div class="stat-value">{{ $totalServices }}</div>
    </div>

    <div class="stat-card orders">
        <div class="stat-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 5a4 4 0 118 0v1h2a1 1 0 01.997.917l.75 9A1 1 0 0116.75 17H3.25a1 1 0 01-.997-1.083l.75-9A1 1 0 014 5h2v-1zm2 1h4V5a2 2 0 10-4 0v1zm-1.75 4.5a.75.75 0 00-1.5 0v.25a3.25 3.25 0 006.5 0v-.25a.75.75 0 00-1.5 0v.25a1.75 1.75 0 01-3.5 0v-.25z" clip-rule="evenodd"/></svg></div>
        <div class="stat-label">Total Orders</div>
        <div class="stat-value">{{ $totalOrders }}</div>
    </div>

</div>

{{-- ── QUICK ACTIONS ── --}}
<div class="section-title">Akses Cepat</div>

<div class="quick-actions">

    <a href="/admin/services/create" class="quick-action">
        <div class="quick-action-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/></svg></div>
        <div class="quick-action-text">
            <strong>Tambah Layanan</strong>
            <span>Buat layanan baru</span>
        </div>
    </a>

    <a href="/admin/users" class="quick-action">
        <div class="quick-action-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 001.905 3.959c-.023.222-.014.442.025.654A4.97 4.97 0 011.49 15.326zM16.44 15.98a4.97 4.97 0 01-1.962.298 5.972 5.972 0 002.024-2.945 6.491 6.491 0 00-1.902-3.916 3 3 0 014.308 3.517.78.78 0 01-.358.442A4.97 4.97 0 0116.44 15.98zM18 8a2 2 0 11-4 0 2 2 0 014 0zM5.304 16.19a.844.844 0 01-.277-.71 5 5 0 019.947 0 .843.843 0 01-.277.71A6.975 6.975 0 0110 18a6.974 6.974 0 01-4.696-1.81z"/></svg></div>
        <div class="quick-action-text">
            <strong>User Monitoring</strong>
            <span>Kelola pengguna</span>
        </div>
    </a>

    <a href="/admin/technicians" class="quick-action">
        <div class="quick-action-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M14.5 10a4.5 4.5 0 004.284-5.882c-.105-.324-.51-.391-.752-.15L15.34 6.66a.454.454 0 01-.493.11 3.01 3.01 0 01-1.618-1.616.455.455 0 01.11-.494l2.694-2.692c.24-.241.174-.647-.15-.752a4.5 4.5 0 00-5.873 4.575c.055.873-.128 1.808-.8 2.368l-7.23 6.024a2.724 2.724 0 103.837 3.837l6.024-7.23c.56-.672 1.495-.855 2.368-.8.105.007.21.01.316.01zM5 16a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/></svg></div>
        <div class="quick-action-text">
            <strong>Technician Monitoring</strong>
            <span>Pantau teknisi</span>
        </div>
    </a>

    <a href="/admin/orders" class="quick-action">
        <div class="quick-action-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 5a4 4 0 118 0v1h2a1 1 0 01.997.917l.75 9A1 1 0 0116.75 17H3.25a1 1 0 01-.997-1.083l.75-9A1 1 0 014 5h2v-1zm2 1h4V5a2 2 0 10-4 0v1zm-1.75 4.5a.75.75 0 00-1.5 0v.25a3.25 3.25 0 006.5 0v-.25a.75.75 0 00-1.5 0v.25a1.75 1.75 0 01-3.5 0v-.25z" clip-rule="evenodd"/></svg></div>
        <div class="quick-action-text">
            <strong>Orders</strong>
            <span>Lihat semua order</span>
        </div>
    </a>

</div>

{{-- ── RECENT USERS ── --}}
<div class="section-title">Pengguna Terbaru</div>

<div class="table-card">
    <div class="table-card-header">
        <h3>5 Pengguna Terakhir Bergabung</h3>
        <a href="/admin/users">Lihat semua →</a>
    </div>

    <table class="recent-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users->take(5) as $user)
            <tr>
                <td>
                    <div class="user-cell">
                        <div class="user-avatar-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        {{ $user->name }}
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->role == 'admin')
                        <span class="role-badge admin">Admin</span>
                    @elseif($user->role == 'technician')
                        <span class="role-badge technician">Technician</span>
                    @else
                        <span class="role-badge user">User</span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center; color: var(--muted); padding: 24px;">Belum ada pengguna.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection