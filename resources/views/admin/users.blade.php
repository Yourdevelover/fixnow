@extends('layouts.admin')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
        <h1 style="font-size:22px; font-weight:600; margin-bottom:4px;">User Monitoring</h1>
        <p style="color:#64748b; font-size:14px;">{{ $users->count() }} total pengguna terdaftar</p>
    </div>
    <a href="/admin/users/create"
        style="display:inline-flex; align-items:center; gap:8px; padding:10px 18px; background:#2563eb; color:white; text-decoration:none; border-radius:8px; font-size:14px; font-weight:500;">
        + Tambah User
    </a>
</div>

{{-- Flash messages --}}
@if(session('success'))
    <div style="background:#dcfce7; color:#166534; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:14px;">
        ✓ {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div style="background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:14px;">
        ✕ {{ session('error') }}
    </div>
@endif

<div style="background:white; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,.08); overflow:hidden;">

    {{-- Filter bar --}}
    <div style="padding:16px 20px; border-bottom:1px solid #f1f5f9; display:flex; gap:8px;">
        <span style="font-size:13px; font-weight:600; color:#1e293b; padding:6px 14px; border-radius:20px; background:#f1f5f9; cursor:pointer;"
            onclick="filterRole('all')" id="filter-all">Semua ({{ $users->count() }})</span>
        <span style="font-size:13px; color:#64748b; padding:6px 14px; border-radius:20px; cursor:pointer;"
            onclick="filterRole('user')" id="filter-user">User ({{ $users->where('role','user')->count() }})</span>
        <span style="font-size:13px; color:#64748b; padding:6px 14px; border-radius:20px; cursor:pointer;"
            onclick="filterRole('technician')" id="filter-technician">Teknisi ({{ $users->where('role','technician')->count() }})</span>
        <span style="font-size:13px; color:#64748b; padding:6px 14px; border-radius:20px; cursor:pointer;"
            onclick="filterRole('admin')" id="filter-admin">Admin ({{ $users->where('role','admin')->count() }})</span>
    </div>

    <table style="width:100%; border-collapse:collapse;" id="users-table">
        <thead>
            <tr style="background:#f8fafc; border-bottom:1px solid #e2e8f0;">
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">#</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Nama</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Email</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Role</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Bergabung</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $i => $user)
            <tr class="user-row" data-role="{{ $user->role }}"
                style="border-bottom:1px solid #f1f5f9; transition:background .1s;"
                onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background=''">

                <td style="padding:14px 20px; color:#94a3b8; font-size:13px;">{{ $i + 1 }}</td>

                <td style="padding:14px 20px;">
                    <div style="display:flex; align-items:center; gap:10px;">
                        {{-- Avatar inisial --}}
                        <div style="width:34px; height:34px; border-radius:50%; background:#eff6ff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:12px; color:#2563eb; flex-shrink:0;">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <span style="font-size:14px; font-weight:500; color:#1e293b;">{{ $user->name }}</span>
                    </div>
                </td>

                <td style="padding:14px 20px; font-size:14px; color:#475569;">{{ $user->email }}</td>

                <td style="padding:14px 20px;">
                    @if($user->role == 'admin')
                        <span style="background:#fef9c3; color:#854d0e; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">Admin</span>
                    @elseif($user->role == 'technician')
                        <span style="background:#dcfce7; color:#166534; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">Teknisi</span>
                    @else
                        <span style="background:#dbeafe; color:#1e40af; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">User</span>
                    @endif
                </td>

                <td style="padding:14px 20px; font-size:13px; color:#64748b;">
                    {{ $user->created_at->format('d M Y') }}
                </td>

                <td style="padding:14px 20px;">
                    <div style="display:flex; gap:8px;">
                        <a href="/admin/users/{{ $user->id }}/edit"
                            style="padding:6px 14px; background:#f1f5f9; color:#1e293b; text-decoration:none; border-radius:6px; font-size:13px; font-weight:500;">
                            Edit
                        </a>

                        @if($user->id !== auth()->id())
                            <form method="POST" action="/admin/users/{{ $user->id }}"
                                onsubmit="return confirm('Hapus user {{ $user->name }}? Tindakan ini tidak bisa dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="padding:6px 14px; background:#fee2e2; color:#dc2626; border:none; border-radius:6px; font-size:13px; font-weight:500; cursor:pointer;">
                                    Hapus
                                </button>
                            </form>
                        @else
                            <span style="padding:6px 14px; background:#f8fafc; color:#cbd5e1; border-radius:6px; font-size:13px;">Hapus</span>
                        @endif
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<script>
function filterRole(role) {
    // Update active pill
    ['all','user','technician','admin'].forEach(r => {
        const el = document.getElementById('filter-' + r);
        if (r === role) {
            el.style.background = '#1e293b';
            el.style.color = 'white';
            el.style.fontWeight = '600';
        } else {
            el.style.background = '';
            el.style.color = '#64748b';
            el.style.fontWeight = '';
        }
    });

    // Filter rows
    document.querySelectorAll('.user-row').forEach(row => {
        row.style.display = (role === 'all' || row.dataset.role === role) ? '' : 'none';
    });
}
</script>

@endsection