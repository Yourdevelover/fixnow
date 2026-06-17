@extends('layouts.admin')

@section('content')

<div style="max-width:560px; margin:0 auto;">

    <a href="/admin/users"
        style="display:inline-flex; align-items:center; gap:6px; font-size:13px; color:#64748b; text-decoration:none; margin-bottom:20px;">
        ← Kembali ke daftar user
    </a>

    <h1 style="font-size:22px; font-weight:600; margin-bottom:4px;">Edit User</h1>
    <p style="color:#64748b; font-size:14px; margin-bottom:24px;">Mengubah data akun <strong>{{ $user->name }}</strong>.</p>

    @if($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:14px;">
            @foreach($errors->all() as $err)
                <div>✕ {{ $err }}</div>
            @endforeach
        </div>
    @endif

    <div style="background:white; border-radius:12px; padding:28px; box-shadow:0 1px 4px rgba(0,0,0,.08);">

        <form method="POST" action="/admin/users/{{ $user->id }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px;">
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px;">
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">
                    Password Baru
                    <span style="font-weight:400; color:#94a3b8; font-size:12px;">— kosongkan jika tidak ingin mengubah</span>
                </label>
                <input type="password" name="password"
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px;">
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                    autocomplete="new-password"
                    placeholder="Ulangi password baru"
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px;">
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Role</label>
                <select name="role" required
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px; background:white;">
                    <option value="user"       {{ old('role', $user->role) == 'user'       ? 'selected' : '' }}>User</option>
                    <option value="technician" {{ old('role', $user->role) == 'technician' ? 'selected' : '' }}>Teknisi</option>
                    <option value="admin"      {{ old('role', $user->role) == 'admin'      ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            {{-- Info akun --}}
            <div style="padding:12px 14px; background:#f8fafc; border-radius:8px; font-size:13px; color:#64748b; margin-bottom:20px;">
                Bergabung: {{ $user->created_at->format('d M Y, H:i') }}
            </div>

            <div style="display:flex; gap:10px;">
                <button type="submit"
                    style="flex:1; padding:12px; background:#2563eb; color:white; border:none; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer;">
                    Simpan Perubahan
                </button>
                <a href="/admin/users"
                    style="flex:1; padding:12px; background:#f1f5f9; color:#1e293b; text-decoration:none; border-radius:8px; font-size:14px; font-weight:500; text-align:center;">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>

@endsection