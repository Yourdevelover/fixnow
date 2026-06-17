<!DOCTYPE html>
<html lang="id">
<head>

    <title>FixNow Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

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

        body { 
            font-family: 'Inter', sans-serif; 
            display: flex; 
            min-height: 100vh; 
            background: var(--bg-light);
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 60%, #0f3668 100%);
            display: flex; 
            flex-direction: column; 
            flex-shrink: 0;
            position: sticky; 
            top: 0; 
            height: 100vh; 
            overflow: hidden;
        }
        
        .sidebar::before {
            content: ''; 
            position: absolute; 
            top: -60px; 
            right: -60px;
            width: 220px; 
            height: 220px; 
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1); 
            pointer-events: none;
        }
        
        .sidebar::after {
            content: ''; 
            position: absolute; 
            bottom: -40px; 
            left: -40px;
            width: 180px; 
            height: 180px; 
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.07); 
            pointer-events: none;
        }

        /* Brand */
        .sidebar-brand {
            display: flex; 
            align-items: center; 
            justify-content: center; 
            gap: 10px;
            padding: 24px 20px; 
            position: relative; 
            z-index: 1;
            border-bottom: 1px solid rgba(59, 130, 246, 0.15);
        }
        
        .brand-logo {
            height: 48px; 
            width: auto; 
            max-width: 200px;
            object-fit: contain; 
            object-position: center; 
            flex-shrink: 0;
            background: var(--white); 
            border-radius: 10px; 
            padding: 8px 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        /* Nav */
        .sidebar-nav {
            flex: 1; 
            padding: 20px 14px; 
            position: relative; 
            z-index: 1;
            display: flex; 
            flex-direction: column; 
            gap: 2px; 
            overflow-y: auto;
        }
        
        .nav-label {
            font-size: 10px; 
            font-weight: 700; 
            text-transform: uppercase;
            letter-spacing: 1.2px; 
            color: rgba(59, 130, 246, 0.6);
            padding: 0 8px; 
            margin-bottom: 8px; 
            margin-top: 14px;
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
            padding: 10px 12px; 
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
        }
        
        .sidebar-nav a:hover { 
            background: rgba(255, 255, 255, 0.1); 
            color: var(--white);
        }
        
        .sidebar-nav a.active {
            background: rgba(59, 130, 246, 0.25); 
            color: var(--accent); 
            font-weight: 600;
        }
        
        .sidebar-nav a.active::before {
            content: ''; 
            position: absolute; 
            left: 0; 
            top: 25%; 
            bottom: 25%;
            width: 3px; 
            background: var(--accent); 
            border-radius: 0 3px 3px 0;
        }

        /* Sidebar footer */
        .sidebar-footer {
            padding: 16px 14px; 
            border-top: 1px solid rgba(59, 130, 246, 0.15);
            position: relative; 
            z-index: 1;
        }
        
        .user-info { 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            margin-bottom: 12px;
        }
        
        .user-avatar {
            width: 40px; 
            height: 40px; 
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.2);
            display: flex; 
            align-items: center; 
            justify-content: center;
            font-size: 15px; 
            flex-shrink: 0;
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: var(--accent); 
            font-weight: 700;
        }
        
        .user-details { 
            overflow: hidden;
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
            color: rgba(59, 130, 246, 0.7); 
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
            background: rgba(239, 68, 68, 0.15); 
            color: #fecaca;
            border: 1px solid rgba(239, 68, 68, 0.25); 
            border-radius: 8px;
            font-size: 13px; 
            font-weight: 600; 
            font-family: 'Inter', sans-serif;
            cursor: pointer; 
            transition: all 0.2s ease;
        }
        
        .btn-logout:hover { 
            background: rgba(239, 68, 68, 0.28); 
            color: #fff;
        }

        /* ── MAIN ── */
        .main-content { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            min-width: 0;
        }

        .topbar {
            background: var(--white); 
            padding: 16px 28px;
            display: flex; 
            align-items: center; 
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .topbar-left { 
            display: flex; 
            flex-direction: column;
        }
        
        .topbar-greeting { 
            font-size: 13px; 
            color: var(--muted);
        }
        
        .topbar-name { 
            font-size: 16px; 
            font-weight: 700; 
            color: var(--dark);
        }
        
        .topbar-right { 
            display: flex; 
            align-items: center; 
            gap: 12px;
        }
        
        .topbar-badge {
            display: inline-block; 
            padding: 4px 12px; 
            background: var(--bg-light);
            color: var(--primary); 
            border: 1px solid var(--border);
            border-radius: 20px; 
            font-size: 12px; 
            font-weight: 600;
        }
        
        .btn-landing {
            display: flex; 
            align-items: center; 
            gap: 6px; 
            padding: 8px 14px;
            background: var(--bg-light); 
            color: var(--primary); 
            border: 1px solid var(--border);
            border-radius: 8px; 
            font-size: 13px; 
            font-weight: 600; 
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .btn-landing:hover { 
            background: var(--border);
            border-color: var(--primary);
        }
        
        .btn-landing svg { 
            width: 14px; 
            height: 14px;
        }

        .page-content { 
            flex: 1; 
            padding: 28px; 
            background: var(--bg-light);
        }

        .card {
            background: var(--white); 
            padding: 24px; 
            border-radius: 12px;
            margin-bottom: 20px; 
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }
        
        .cards { 
            display: grid; 
            grid-template-columns: repeat(4, 1fr); 
            gap: 20px;
        }
    </style>

</head>
<body>

<!-- ── SIDEBAR ── -->
<div class="sidebar">

    <div class="sidebar-brand">
        <img src="{{ asset('images/logo.png') }}" alt="FixNow Logo" class="brand-logo">
    </div>

    <nav class="sidebar-nav">

        <div class="nav-label">Main</div>

        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;"><path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd"/></svg></span>
            Landing Page
        </a>

        <div class="nav-label">Admin</div>

        <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;"><path d="M15.5 2A1.5 1.5 0 0014 3.5v13a1.5 1.5 0 003 0v-13A1.5 1.5 0 0015.5 2zM9.5 6A1.5 1.5 0 008 7.5v9a1.5 1.5 0 003 0v-9A1.5 1.5 0 009.5 6zM3.5 10A1.5 1.5 0 002 11.5v5a1.5 1.5 0 003 0v-5A1.5 1.5 0 003.5 10z"/></svg></span>
            Dashboard
        </a>

        <a href="/admin/users" class="{{ request()->is('admin/users') ? 'active' : '' }}">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;"><path d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z"/></svg></span>
            User Monitoring
        </a>

        <a href="/admin/technicians" class="{{ request()->is('admin/technicians') ? 'active' : '' }}">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;"><path fill-rule="evenodd" d="M19 5.5a4.5 4.5 0 01-4.791 4.49c-.873-.055-1.808.128-2.368.8l-6.024 7.23a2.724 2.724 0 11-3.837-3.837L9.21 8.16c.672-.56.855-1.495.8-2.368a4.5 4.5 0 015.873-4.575c.324.105.39.51.15.752L13.34 4.16a.75.75 0 00-.22.53v1.48c0 .414.336.75.75.75h1.48a.75.75 0 00.53-.22l1.69-1.69c.242-.24.647-.174.752.15.14.435.21.9.21 1.38a.75.75 0 000-.06zM4.5 16a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/></svg></span>
            Technician Monitoring
        </a>

        <a href="/admin/services" class="{{ request()->is('admin/services*') ? 'active' : '' }}">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;"><path fill-rule="evenodd" d="M15.988 3.012A2.25 2.25 0 0118 5.25v6.5A2.25 2.25 0 0115.75 14H13.5v-3.379a3 3 0 00-.879-2.121l-3.12-3.121a3 3 0 00-1.402-.791V2.998c.106-.027.215-.052.329-.068A2.25 2.25 0 0112 .75h1.5a2.25 2.25 0 012.488 2.262zM10.5 4.375a1.875 1.875 0 10-3.75 0 1.875 1.875 0 003.75 0z" clip-rule="evenodd"/><path d="M5.625 6a1.875 1.875 0 00-1.875 1.875v9.25C3.75 18.16 4.59 19 5.625 19h6.75c1.035 0 1.875-.84 1.875-1.875v-9.25A1.875 1.875 0 0012.375 6h-6.75z"/></svg></span>
            Services
        </a>

        <a href="/admin/orders" class="{{ request()->is('admin/orders') ? 'active' : '' }}">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;"><path d="M3.105 2.289a.75.75 0 00-.826.95l1.414 4.925A1.5 1.5 0 005.135 9.25h9.73a1.5 1.5 0 001.442-1.086l1.414-4.926a.75.75 0 00-.826-.95 28.896 28.896 0 01-15.789 0z"/><path fill-rule="evenodd" d="M5.135 10.75a1.5 1.5 0 00-1.442 1.086l-.64 2.228A1.5 1.5 0 004.495 16h11.01a1.5 1.5 0 001.442-1.936l-.64-2.228a1.5 1.5 0 00-1.442-1.086H5.135z" clip-rule="evenodd"/></svg></span>
            Orders
        </a>

        <a href="/admin/applications" class="{{ request()->is('admin/applications') ? 'active' : '' }}">
            <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg></span>
            Applications
        </a>

    </nav>

    <!-- User info + logout -->
    <div class="sidebar-footer">

        <a href="{{ route('profile.edit') }}" style="text-decoration:none;">
            <div class="user-info" style="cursor:pointer; border-radius:10px; padding:6px 4px; transition:background 0.18s;"
                onmouseover="this.style.background='rgba(255,255,255,0.08)'"
                onmouseout="this.style.background='transparent'">

                @if(auth()->user()->photo)
                    <img src="{{ auth()->user()->photo }}" alt="Foto"
                        style="width:36px;height:36px;border-radius:50%;object-fit:cover;border:2px solid rgba(170,224,252,0.40);flex-shrink:0;">
                @else
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif

                <div class="user-details">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role" style="display:flex;align-items:center;gap:4px;">
                        Administrator
                        <span style="font-size:10px;color:rgba(170,224,252,0.45);">· Edit profil</span>
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
        <div class="topbar-right">
            <span class="topbar-badge">Admin</span>
        </div>
    </div>

    <div class="page-content">
        @yield('content')
    </div>

</div>

</body>
</html>