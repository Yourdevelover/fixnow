<!DOCTYPE html>
<html lang="id">
<head>

    <title>FixNow</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        *, *::before, *::after {
            margin: 0; padding: 0; box-sizing: border-box;
        }

        :root {
            --primary:    #1e40af;
            --primary-dark: #1a3f8a;
            --primary-light: #3b82f6;
            --accent:     #0ea5e9;
            --white:      #ffffff;
            --bg-light:   #f9fafb;
            --dark:       #111827;
            --dark-alt:   #1f2937;
            --muted:      #6b7280;
            --muted-light:#9ca3af;
            --border:     #e5e7eb;
            --success:    #10b981;
            --warning:    #f59e0b;
            --error:      #ef4444;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            display: flex;
            min-height: 100vh;
            background: var(--bg-light);
            transition: background-color 0.25s ease;
        }

        body.dark-theme {
            background: #0f172a;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow: hidden;
            box-shadow: 2px 0 8px rgba(30, 64, 175, 0.15);
            transition: transform 0.3s ease, width 0.3s ease, background 0.25s ease;
            border-radius: 0 12px 12px 0;
        }

        body.dark-theme .sidebar {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.3);
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
            position: fixed;
            left: 0;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                z-index: 999;
                width: 260px;
            }

            .sidebar.collapsed {
                transform: translateX(-100%);
            }
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            pointer-events: none;
        }

        /* Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 24px 20px;
            position: relative;
            z-index: 1;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: border-color 0.25s ease;
        }

        body.dark-theme .sidebar-brand {
            border-bottom-color: rgba(255, 255, 255, 0.05);
        }

        .brand-logo {
            height: 48px;
            width: auto;
            max-width: 200px;
            object-fit: contain;
            object-position: center;
            flex-shrink: 0;
            background: var(--white);
            border-radius: 8px;
            padding: 6px 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .brand-name {
            font-size: 18px;
            font-weight: 800;
            color: var(--white);
            letter-spacing: -0.5px;
        }

        /* Nav sections */
        .sidebar-nav {
            flex: 1;
            padding: 24px 12px;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
            overflow-y: auto;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .nav-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.3px;
            color: rgba(255, 255, 255, 0.6);
            padding: 0 12px;
            margin-bottom: 8px;
            margin-top: 16px;
        }

        .nav-label:first-child {
            margin-top: 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 11px 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 2px;
            position: relative;
        }

        .sidebar-nav a .nav-icon {
            width: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: rgba(255, 255, 255, 0.7);
        }

        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, 0.12);
            color: var(--white);
        }

        .sidebar-nav a:hover .nav-icon {
            color: var(--white);
        }

        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
            font-weight: 600;
        }

        .sidebar-nav a.active .nav-icon {
            color: var(--white);
        }

        .sidebar-nav a.active::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background: var(--accent);
            border-radius: 0 4px 4px 0;
        }

        body.dark-theme .sidebar-nav a.active::before {
            background: #0ea5e9;
        }

        .sidebar-nav a.nav-cta {
            background: rgba(255, 255, 255, 0.2);
            color: var(--accent);
            font-weight: 700;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .sidebar-nav a.nav-cta:hover {
            background: rgba(255, 255, 255, 0.3);
            color: var(--white);
        }

        /* Sidebar footer */
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 1;
            transition: border-color 0.25s ease;
        }

        body.dark-theme .sidebar-footer {
            border-top-color: rgba(255, 255, 255, 0.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            cursor: pointer;
        }

        .user-avatar {
            width: 40px; 
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            display: flex; 
            align-items: center; 
            justify-content: center;
            font-size: 16px;
            font-weight: 700;
            flex-shrink: 0;
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: var(--white);
        }

        .user-details { 
            overflow: hidden;
            flex: 1;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--white);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.7);
            text-transform: capitalize;
            font-weight: 500;
        }

        .btn-logout {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px;
            background: rgba(239, 68, 68, 0.2);
            color: #fecaca;
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.35);
            color: var(--white);
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .topbar {
            background: var(--white);
            padding: 18px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: background-color 0.25s ease, border-color 0.25s ease;
        }

        body.dark-theme .topbar {
            background: #1e293b;
            border-bottom-color: #334155;
        }

        .topbar-left {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .topbar-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-toggle-sidebar {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            background: var(--white);
            border-radius: 8px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            color: var(--dark);
            transition: all 0.2s ease;
        }

        .btn-toggle-sidebar:hover {
            background: var(--bg-light);
            border-color: var(--primary);
        }

        body.dark-theme .btn-toggle-sidebar {
            background: #334155;
            border-color: #475569;
            color: white;
        }

        body.dark-theme .btn-toggle-sidebar:hover {
            background: #475569;
            border-color: var(--primary);
        }

        .btn-theme-toggle {
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            background: var(--white);
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark);
            transition: all 0.2s ease;
        }

        .btn-theme-toggle:hover {
            background: var(--bg-light);
            border-color: var(--primary);
        }

        body.dark-theme .btn-theme-toggle {
            background: #334155;
            border-color: #475569;
            color: #fbbf24;
        }

        body.dark-theme .btn-theme-toggle:hover {
            background: #475569;
            border-color: var(--primary);
        }

        @media (max-width: 768px) {
            .btn-toggle-sidebar {
                display: flex;
            }

            .topbar {
                padding: 16px 20px;
            }

            .topbar-name {
                font-size: 16px;
            }

            .topbar-greeting {
                font-size: 12px;
            }
        }

        .topbar-greeting {
            font-size: 13px;
            color: var(--muted);
            font-weight: 400;
            transition: color 0.25s ease;
        }

        body.dark-theme .topbar-greeting {
            color: #94a3b8;
        }

        .topbar-name {
            font-size: 18px;
            font-weight: 800;
            color: var(--dark);
            transition: color 0.25s ease;
        }

        body.dark-theme .topbar-name {
            color: white;
        }

        .topbar-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(30, 64, 175, 0.08);
            color: var(--primary);
            border: 1px solid var(--border);
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
            transition: all 0.25s ease;
        }

        body.dark-theme .topbar-badge {
            background: rgba(59, 130, 246, 0.15);
            border-color: #475569;
            color: #93c5fd;
        }

        .page-content {
            flex: 1;
            padding: 32px;
            background: var(--bg-light);
            overflow-y: auto;
            transition: background-color 0.25s ease;
        }

        body.dark-theme .page-content {
            background: #0f172a;
        }

        .card {
            background: var(--white);
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        body.dark-theme .card {
            background: #1e293b;
            border-color: #334155;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        body.dark-theme .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

    </style>

</head>
<body>

<!-- ── SIDEBAR ── -->
<div class="sidebar">

    <div class="sidebar-brand">
        {{-- Kalau logo PNG/JPG mengandung teks "FixNow", hapus span brand-name di bawah --}}
        <img src="{{ asset('images/logo.png') }}" alt="FixNow Logo" class="brand-logo">
        {{-- Hapus baris ini kalau logo sudah include teks --}}
        {{-- <span class="brand-name">FixNow</span> --}}
    </div>

    <nav class="sidebar-nav">

        <div class="nav-label">Main</div>

        <a href="/home" class="{{ request()->is('home') ? 'active' : '' }}">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd"/></svg></span> Menu Utama
        </a>

        <a href="/user/dashboard" class="{{ request()->is('user/dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z"/></svg></span> Profile
        </a>

        @if(auth()->user()->role === 'user')

            <div class="nav-label">Orders</div>

            <a href="/orders/create" class="nav-cta {{ request()->is('orders/create') ? 'active' : '' }}">
                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/></svg></span> Pesan Teknisi
            </a>

            <a href="/orders" class="{{ request()->is('orders') ? 'active' : '' }}">
                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path fill-rule="evenodd" d="M15.988 3.012A2.25 2.25 0 0118 5.25v6.5A2.25 2.25 0 0115.75 14H13.5v-3.379a3 3 0 00-.879-2.121l-3.12-3.121a3 3 0 00-1.402-.791V2.998c.106-.027.215-.052.329-.068A2.25 2.25 0 0112 .75h1.5a2.25 2.25 0 012.488 2.262zM10.5 4.375a1.875 1.875 0 10-3.75 0 1.875 1.875 0 003.75 0z" clip-rule="evenodd"/><path d="M5.625 6a1.875 1.875 0 00-1.875 1.875v9.25C3.75 18.16 4.59 19 5.625 19h6.75c1.035 0 1.875-.84 1.875-1.875v-9.25A1.875 1.875 0 0012.375 6h-6.75z"/></svg></span> My Orders
            </a>

            <a href="/orders/history" class="{{ request()->is('orders/history') ? 'active' : '' }}">
                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg></span> Riwayat Order
            </a>

        @elseif(auth()->user()->role === 'technician')

            <div class="nav-label">Pekerjaan</div>

            <a href="/technician/orders" class="{{ request()->is('technician/orders') ? 'active' : '' }}">
                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path fill-rule="evenodd" d="M2.5 3A1.5 1.5 0 001 4.5v4.75a.75.75 0 001.5 0V4.5a.75.75 0 01.75-.75h13.5a.75.75 0 01.75.75v4.75a.75.75 0 001.5 0V4.5A1.5 1.5 0 0017.5 3h-15zm-.75 9.5a.75.75 0 01.75-.75h6.5a.75.75 0 010 1.5H3a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h4a.75.75 0 000-1.5H2.5zm9.22-2.53a.75.75 0 011.06 0l1.97 1.97 1.97-1.97a.75.75 0 111.06 1.06l-1.97 1.97 1.97 1.97a.75.75 0 11-1.06 1.06L14.75 16.06l-1.97 1.97a.75.75 0 11-1.06-1.06l1.97-1.97-1.97-1.97a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg></span> Incoming Orders
            </a>

            <a href="/orders" class="{{ request()->is('orders') ? 'active' : '' }}">
                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path fill-rule="evenodd" d="M15.988 3.012A2.25 2.25 0 0118 5.25v6.5A2.25 2.25 0 0115.75 14H13.5v-3.379a3 3 0 00-.879-2.121l-3.12-3.121a3 3 0 00-1.402-.791V2.998c.106-.027.215-.052.329-.068A2.25 2.25 0 0112 .75h1.5a2.25 2.25 0 012.488 2.262zM10.5 4.375a1.875 1.875 0 10-3.75 0 1.875 1.875 0 003.75 0z" clip-rule="evenodd"/><path d="M5.625 6a1.875 1.875 0 00-1.875 1.875v9.25C3.75 18.16 4.59 19 5.625 19h6.75c1.035 0 1.875-.84 1.875-1.875v-9.25A1.875 1.875 0 0012.375 6h-6.75z"/></svg></span> Riwayat Pekerjaan
            </a>

            <a href="/technician/dashboard" class="{{ request()->is('technician/dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path d="M15.5 2A1.5 1.5 0 0014 3.5v13a1.5 1.5 0 003 0v-13A1.5 1.5 0 0015.5 2zM9.5 6A1.5 1.5 0 008 7.5v9a1.5 1.5 0 003 0v-9A1.5 1.5 0 009.5 6zM3.5 10A1.5 1.5 0 002 11.5v5a1.5 1.5 0 003 0v-5A1.5 1.5 0 003.5 10z"/></svg></span> Technician Dashboard
            </a>

        @elseif(auth()->user()->role === 'admin')

            <div class="nav-label">Admin</div>

            <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path d="M15.5 2A1.5 1.5 0 0014 3.5v13a1.5 1.5 0 003 0v-13A1.5 1.5 0 0015.5 2zM9.5 6A1.5 1.5 0 008 7.5v9a1.5 1.5 0 003 0v-9A1.5 1.5 0 009.5 6zM3.5 10A1.5 1.5 0 002 11.5v5a1.5 1.5 0 003 0v-5A1.5 1.5 0 003.5 10z"/></svg></span> Dashboard
            </a>

            <a href="/admin/applications" class="{{ request()->is('admin/applications') ? 'active' : '' }}">
                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg></span> Applications
            </a>

            <a href="/admin/orders" class="{{ request()->is('admin/orders') ? 'active' : '' }}">
                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path d="M3.105 2.289a.75.75 0 00-.826.95l1.414 4.925A1.5 1.5 0 005.135 9.25h9.73a1.5 1.5 0 001.442-1.086l1.414-4.926a.75.75 0 00-.826-.95 28.896 28.896 0 01-15.789 0z"/><path fill-rule="evenodd" d="M5.135 10.75a1.5 1.5 0 00-1.442 1.086l-.64 2.228A1.5 1.5 0 004.495 16h11.01a1.5 1.5 0 001.442-1.936l-.64-2.228a1.5 1.5 0 00-1.442-1.086H5.135z" clip-rule="evenodd"/></svg></span> Orders
            </a>

            <a href="/admin/services" class="{{ request()->is('admin/services*') ? 'active' : '' }}">
                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path fill-rule="evenodd" d="M19 5.5a4.5 4.5 0 01-4.791 4.49c-.873-.055-1.808.128-2.368.8l-6.024 7.23a2.724 2.724 0 11-3.837-3.837L9.21 8.16c.672-.56.855-1.495.8-2.368a4.5 4.5 0 015.873-4.575c.324.105.39.51.15.752L13.34 4.16a.75.75 0 00-.22.53v1.48c0 .414.336.75.75.75h1.48a.75.75 0 00.53-.22l1.69-1.69c.242-.24.647-.174.752.15.14.435.21.9.21 1.38a.75.75 0 000-.06zM4.5 16a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/></svg></span> Services
            </a>

            <a href="/admin/technicians" class="{{ request()->is('admin/technicians') ? 'active' : '' }}">
                <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path fill-rule="evenodd" d="M10 2a8 8 0 00-8 8c0 .552.045 1.093.131 1.619A1.5 1.5 0 003.62 13H4v.5A1.5 1.5 0 005.5 15h9a1.5 1.5 0 001.5-1.5V13h.38a1.5 1.5 0 001.489-1.381A8.01 8.01 0 0118 10a8 8 0 00-8-8zm0 2a6 6 0 015.917 5H4.083A6 6 0 0110 4z" clip-rule="evenodd"/></svg></span> Technicians
            </a>

        @endif

    </nav>

    <!-- User info + logout -->
    <div class="sidebar-footer">

        <a href="{{ route('profile.edit') }}" style="text-decoration:none;">
            <div class="user-info" style="cursor:pointer; border-radius:10px; padding:6px 4px; transition:background 0.18s;"
                onmouseover="this.style.background='rgba(255,255,255,0.08)'"
                onmouseout="this.style.background='transparent'">

                @if(auth()->user()->photo)
                    <img src="{{ auth()->user()->photo }}"
                        alt="Foto"
                        style="width:36px; height:36px; border-radius:50%; object-fit:cover;
                                border:2px solid rgba(170,224,252,0.40); flex-shrink:0;">
                @else
                    <div class="user-avatar" style="background:rgba(170,224,252,0.20); color:var(--sky);
                                font-weight:700; font-size:15px; border:1.5px solid rgba(170,224,252,0.30);">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif

                <div class="user-details">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role" style="display:flex; align-items:center; gap:4px;">
                        {{ auth()->user()->role }}
                        <span style="font-size:10px; color:rgba(170,224,252,0.45);">· Edit profil</span>
                    </div>
                </div>
            </div>
        </a>

        <form action="/logout" method="POST" style="margin-top:8px;">
            @csrf
            <button type="submit" class="btn-logout">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:16px;height:16px;flex-shrink:0;"><path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M6 10a.75.75 0 01.75-.75h9.546l-1.048-.943a.75.75 0 111.004-1.114l2.5 2.25a.75.75 0 010 1.114l-2.5 2.25a.75.75 0 11-1.004-1.114l1.048-.943H6.75A.75.75 0 016 10z" clip-rule="evenodd"/></svg>
                Keluar
            </button>
        </form>

    </div>

</div>

<!-- ── MAIN CONTENT ── -->
<div class="main-content">

    <div class="topbar">
        <div class="topbar-left">
            <span class="topbar-greeting">Selamat datang kembali,</span>
            <span class="topbar-name">{{ auth()->user()->name }}</span>
        </div>
        <div class="topbar-controls">
            <button class="btn-toggle-sidebar" id="sidebarToggle" type="button" title="Toggle Sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;"><path fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z" clip-rule="evenodd"/></svg>
            </button>
            <button class="btn-theme-toggle" id="themeToggle" type="button" title="Toggle Dark/Light Mode">
                <svg id="sunIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l-2.83-2.83a1 1 0 111.414-1.414l2.83 2.83a1 1 0 11-1.414 1.414zM2.05 6.464A1 1 0 013.464 5.05l2.83 2.83a1 1 0 11-1.414 1.414L2.05 6.464zm9.9-9.9a1 1 0 111.414 1.414L12.464 5.05a1 1 0 11-1.414-1.414L11.95 2.464zM5.05 12.464a1 1 0 111.414-1.414l2.83 2.83a1 1 0 11-1.414 1.414l-2.83-2.83z" clip-rule="evenodd"/></svg>
                <svg id="moonIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;display:none;"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
            </button>
            <span class="topbar-badge">{{ auth()->user()->role }}</span>
        </div>
    </div>

    <div class="page-content">
        @yield('content')
    </div>

</div>

</body>

<script>
    // Theme Toggle
    const themeToggle = document.getElementById('themeToggle');
    const sunIcon = document.getElementById('sunIcon');
    const moonIcon = document.getElementById('moonIcon');
    const html = document.documentElement;

    // Load theme preference
    const savedTheme = localStorage.getItem('theme') || 'light';
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-theme');
        sunIcon.style.display = 'none';
        moonIcon.style.display = 'block';
    }

    themeToggle.addEventListener('click', function() {
        document.body.classList.toggle('dark-theme');
        const isDark = document.body.classList.contains('dark-theme');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        sunIcon.style.display = isDark ? 'none' : 'block';
        moonIcon.style.display = isDark ? 'block' : 'none';
    });

    // Sidebar Toggle with Responsive Auto-Management
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const DESKTOP_BREAKPOINT = 1024;

    // Function to update sidebar state based on screen width
    function updateSidebarState() {
        const isDesktop = window.innerWidth >= DESKTOP_BREAKPOINT;
        const userPreference = localStorage.getItem('sidebarCollapsed');
        
        if (isDesktop) {
            // Desktop: always open sidebar (ignore user preference on desktop)
            sidebar.classList.remove('collapsed');
        } else {
            // Mobile/Tablet: respect user preference, default to collapsed
            if (userPreference === 'true') {
                sidebar.classList.add('collapsed');
            } else if (userPreference === 'false') {
                sidebar.classList.remove('collapsed');
            } else {
                // First time on mobile: collapse sidebar
                sidebar.classList.add('collapsed');
            }
        }
    }

    // Initialize sidebar state on page load
    updateSidebarState();

    // Toggle sidebar on button click (only works on mobile/tablet)
    sidebarToggle.addEventListener('click', function() {
        if (window.innerWidth < DESKTOP_BREAKPOINT) {
            sidebar.classList.toggle('collapsed');
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        }
    });

    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            updateSidebarState();
        }, 100);
    });

    // Close sidebar on mobile/tablet when clicking a link
    const sidebarLinks = sidebar.querySelectorAll('a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < DESKTOP_BREAKPOINT) {
                sidebar.classList.add('collapsed');
                localStorage.setItem('sidebarCollapsed', 'true');
            }
        });
    });
</script>

</html>