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

    .wrap { 
        max-width: 700px; 
        margin: 0 auto; 
        padding: 40px 20px;
    }

    .page-header { 
        margin-bottom: 32px;
    }
    
    .page-header h1 {
        font-size: 28px; 
        font-weight: 800; 
        color: var(--dark);
        letter-spacing: -0.5px; 
        margin-bottom: 8px;
    }
    
    .page-header p { 
        font-size: 15px; 
        color: var(--muted);
    }

    .profile-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(30, 64, 175, 0.08);
    }

    .profile-card-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 32px 28px 48px;
    }
    
    .profile-card-header .label {
        font-size: 11px; 
        font-weight: 700;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase; 
        letter-spacing: 1.2px;
        margin-bottom: 6px;
    }
    
    .profile-card-header h2 {
        font-size: 28px; 
        font-weight: 800; 
        color: white; 
        letter-spacing: -0.5px;
    }

    .avatar-row {
        padding: 0 28px;
        margin-top: -40px;
        margin-bottom: 24px;
        position: relative; 
        z-index: 1;
        display: flex; 
        align-items: flex-end; 
        justify-content: space-between;
    }
    
    .avatar-img {
        width: 80px; 
        height: 80px; 
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2);
    }
    
    .avatar-initials {
        width: 80px; 
        height: 80px; 
        border-radius: 50%;
        color: white; 
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-size: 32px; 
        font-weight: 800;
        border: 4px solid white;
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2);
    }
    
    .btn-edit {
        display: inline-flex; 
        align-items: center; 
        gap: 6px;
        padding: 10px 20px;
        background: var(--primary); 
        color: white;
        text-decoration: none; 
        border-radius: 8px;
        font-size: 14px; 
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(30, 64, 175, 0.2);
        transition: all 0.2s ease;
        margin-bottom: -12px;
    }
    
    .btn-edit:hover { 
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        padding: 0 28px 12px;
    }
    
    .info-item {
        padding: 16px 12px;
        border-bottom: 1px solid var(--border);
    }
    
    .info-item.full { 
        grid-column: span 2;
    }
    
    .info-item:last-child,
    .info-item.full:last-child { 
        border-bottom: none;
    }
    
    .info-label {
        font-size: 11px; 
        font-weight: 700; 
        color: var(--muted);
        text-transform: uppercase; 
        letter-spacing: 0.7px; 
        margin-bottom: 6px;
    }
    
    .info-value {
        font-size: 15px; 
        font-weight: 500; 
        color: var(--dark);
    }
    
    .info-value.empty { 
        color: #cbd5e1; 
        font-style: italic;
    }

    .status-badge {
        display: inline-flex; 
        align-items: center; 
        gap: 5px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 13px; 
        font-weight: 600;
    }
    
    .status-complete { 
        background: #f0fdf4; 
        color: #15803d; 
        border: 1px solid #86efac;
    }
    
    .status-incomplete { 
        background: #fefce8; 
        color: #854d0e; 
        border: 1px solid #fde047;
    }

    .warn-banner {
        margin: 0 28px 20px;
        background: #fefce8; 
        border: 1px solid #fde047;
        border-radius: 10px; 
        padding: 12px 16px;
        display: flex; 
        align-items: center; 
        gap: 10px;
        font-size: 14px; 
        color: #854d0e;
    }

    .cta-banner {
        margin: 0 28px 24px;
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.08) 0%, rgba(14, 165, 233, 0.08) 100%);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
    }
    
    .cta-banner .cta-text {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .cta-icon {
        width: 40px; 
        height: 40px;
        border-radius: 10px;
        background: var(--white);
        border: 1px solid var(--border);
        display: flex; 
        align-items: center; 
        justify-content: center;
        flex-shrink: 0;
    }
    
    .cta-text strong {
        display: block;
        font-size: 15px; 
        font-weight: 700; 
        color: var(--dark); 
        margin-bottom: 2px;
    }
    
    .cta-text span { 
        font-size: 13px; 
        color: var(--muted);
    }
    
    .btn-cta {
        display: inline-flex; 
        align-items: center; 
        gap: 6px;
        padding: 10px 20px;
        background: var(--primary); 
        color: white;
        text-decoration: none; 
        border-radius: 8px;
        font-size: 14px; 
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(30, 64, 175, 0.2);
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    
    .btn-cta:hover { 
        background: var(--primary-dark);
        transform: translateY(-1px);
    }
    
    .info-divider { 
        grid-column: span 2; 
        height: 1px; 
        background: var(--border);
    }

    /* ─── DARK THEME SUPPORT ─── */
    body.dark-theme .page-header h1 {
        color: white;
    }

    body.dark-theme .page-header p {
        color: #cbd5e1;
    }

    body.dark-theme .profile-card {
        background: #1e293b;
        border-color: #334155;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    body.dark-theme .info-item {
        border-bottom-color: #334155;
    }

    body.dark-theme .info-label {
        color: #94a3b8;
    }

    body.dark-theme .info-value {
        color: #e2e8f0;
    }

    body.dark-theme .info-value.empty {
        color: #64748b;
    }

    body.dark-theme .status-complete {
        background: rgba(16, 185, 129, 0.1);
        color: #86efac;
        border-color: #10b981;
    }

    body.dark-theme .status-incomplete {
        background: rgba(245, 158, 11, 0.1);
        color: #fbbf24;
        border-color: #f59e0b;
    }

    body.dark-theme .warn-banner {
        background: rgba(239, 68, 68, 0.1);
        border-color: #dc2626;
        color: #fca5a5;
    }

    body.dark-theme .cta-banner {
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.15) 0%, rgba(14, 165, 233, 0.15) 100%);
        border-color: #334155;
    }

    body.dark-theme .cta-icon {
        background: #334155;
        border-color: #475569;
    }

    body.dark-theme .cta-text strong {
        color: white;
    }

    body.dark-theme .cta-text span {
        color: #cbd5e1;
    }

    body.dark-theme .btn-edit,
    body.dark-theme .btn-cta {
        box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3);
    }

    body.dark-theme [style*="background:#f0fdf4"] {
        background: rgba(16, 185, 129, 0.1) !important;
        border-color: #10b981 !important;
        color: #86efac !important;
    }
</style>

<div class="wrap">

    <div class="page-header">
        <h1>Profil Saya</h1>
        <p>Informasi akun dan data kontak kamu</p>
    </div>

    @if(session('success'))
        <div style="display:flex; align-items:center; gap:8px; background:#f0fdf4;
                    border:1px solid #86efac; border-radius:10px; padding:12px 16px;
                    font-size:13px; color:#15803d; font-weight:600; margin-bottom:20px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:18px;height:18px;flex-shrink:0;"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-card">

        <div class="profile-card-header">
            <p class="label">Akun FixNow</p>
            <h2>{{ auth()->user()->name }}</h2>
        </div>

        <div class="avatar-row">
            @if(auth()->user()->photo)
                <img src="{{ auth()->user()->photo }}" alt="Foto" class="avatar-img">
            @else
                @php
                    $i  = strtoupper(substr(auth()->user()->name, 0, 1));
                    $cs = ['#235a9d','#7c3aed','#0891b2','#059669','#d97706','#dc2626'];
                    $bg = $cs[ord($i) % count($cs)];
                @endphp
                <div class="avatar-initials" style="background:{{ $bg }};">{{ $i }}</div>
            @endif

            <a href="{{ route('profile.edit') }}" class="btn-edit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:15px;height:15px;flex-shrink:0;"><path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z"/></svg>
                Edit Profil
            </a>
        </div>

        <div style="padding: 0 28px 16px;">
            @php
                $complete = auth()->user()->phone && auth()->user()->address && auth()->user()->photo;
            @endphp
            @if($complete)
                <span class="status-badge status-complete">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:14px;height:14px;"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/></svg>
                    Profil lengkap
                </span>
            @else
                <span class="status-badge status-incomplete">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:14px;height:14px;"><path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                    Profil belum lengkap
                </span>
            @endif
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value">{{ auth()->user()->name }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value">{{ auth()->user()->email }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">No. Handphone</div>
                @if(auth()->user()->phone)
                    <div class="info-value">{{ auth()->user()->phone }}</div>
                @else
                    <div class="info-value empty">Belum diisi</div>
                @endif
            </div>
            <div class="info-item">
                <div class="info-label">Role</div>
                <div class="info-value" style="text-transform:capitalize;">{{ auth()->user()->role }}</div>
            </div>

            @if(auth()->user()->role === 'technician' && isset($technician) && $technician)
            <div class="info-item">
                <div class="info-label">Spesialisasi</div>
                <div class="info-value">{{ $technician->specialist ?? '—' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Pengalaman</div>
                <div class="info-value">{{ $technician->experience ?? '—' }} tahun</div>
            </div>
            @endif

            <div class="info-item full">
                <div class="info-label">Alamat</div>
                @if(auth()->user()->address)
                    <div class="info-value">{{ auth()->user()->address }}</div>
                @else
                    <div class="info-value empty">Belum diisi</div>
                @endif
            </div>
        </div>

        @if(!$complete)
            <div class="warn-banner">
                <span style="display:flex;align-items:center;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:20px;height:20px;flex-shrink:0;"><path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                </span>
                <span>Profil kamu belum lengkap!</span>
            </div>
        @endif

    </div>

    @if(auth()->user()->role === 'user')
        <div class="cta-banner" style="margin-top:20px;">
            <div class="cta-text">
                <div class="cta-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:20px;height:20px;color:var(--navy);"><path fill-rule="evenodd" d="M19 5.5a4.5 4.5 0 01-4.791 4.49c-.873-.055-1.808.128-2.368.8l-6.024 7.23a2.724 2.724 0 11-3.837-3.837L9.21 8.16c.672-.56.855-1.495.8-2.368a4.5 4.5 0 015.873-4.575c.324.105.39.51.15.752L13.34 4.16a.75.75 0 00-.22.53v1.48c0 .414.336.75.75.75h1.48a.75.75 0 00.53-.22l1.69-1.69c.242-.24.647-.174.752.15.14.435.21.9.21 1.38a.75.75 0 000-.06zM4.5 16a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/></svg>
                </div>
                <div>
                    <strong>Mau jadi teknisi FixNow?</strong>
                    <span>Daftarkan dirimu dan mulai menerima order dari pengguna lain.</span>
                </div>
            </div>
            <a href="{{ url('/apply-technician') }}" class="btn-cta">
                Daftar Jadi Teknisi
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:15px;height:15px;"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/></svg>
            </a>
        </div>
    @endif

</div>

@endsection