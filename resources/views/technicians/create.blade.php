@extends('layouts.admin')

@section('content')

<div style="max-width:560px; margin:0 auto;">

    <a href="/admin/technicians"
        style="display:inline-flex; align-items:center; gap:6px; font-size:13px; color:#64748b; text-decoration:none; margin-bottom:20px;">
        ← Kembali ke monitoring
    </a>

    <h1 style="font-size:22px; font-weight:600; margin-bottom:4px;">Tambah Teknisi</h1>
    <p style="color:#64748b; font-size:14px; margin-bottom:24px;">Daftarkan user sebagai teknisi secara manual.</p>

    @if($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:14px;">
            @foreach($errors->all() as $err)
                <div>✕ {{ $err }}</div>
            @endforeach
        </div>
    @endif

    @if($users->isEmpty())
        <div style="background:#fef9c3; color:#854d0e; padding:16px; border-radius:10px; font-size:14px;">
            ⚠ Tidak ada user yang bisa didaftarkan sebagai teknisi. Semua user aktif sudah menjadi teknisi atau admin.
        </div>
    @else

    <div style="background:white; border-radius:12px; padding:28px; box-shadow:0 1px 4px rgba(0,0,0,.08);">

        <form method="POST" action="/admin/technicians">
            @csrf

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">User</label>
                <select name="user_id" required
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px; background:white;">
                    <option value="">-- Pilih user --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} — {{ $user->email }}
                        </option>
                    @endforeach
                </select>
                <p style="font-size:12px; color:#94a3b8; margin-top:4px;">Hanya user dengan role 'user' yang ditampilkan.</p>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Layanan</label>
                <select name="service_id" required
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px; background:white;">
                    <option value="">-- Pilih layanan --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->service_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Spesialisasi</label>
                <input type="text" name="specialist" value="{{ old('specialist') }}" required
                    placeholder="Contoh: AC Inverter, Kulkas 2 Pintu..."
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px;">
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Pengalaman (tahun)</label>
                <input type="number" name="experience" value="{{ old('experience', 0) }}" required min="0"
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px;">
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Status Awal</label>
                <select name="availability_status" required
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px; background:white;">
                    <option value="available" {{ old('availability_status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="busy"      {{ old('availability_status') == 'busy'      ? 'selected' : '' }}>Sibuk</option>
                </select>
            </div>

            <div style="padding:12px 14px; background:#eff6ff; border-radius:8px; font-size:13px; color:#1d4ed8; margin-bottom:20px;">
                ℹ Role user akan otomatis berubah menjadi <strong>technician</strong> setelah disimpan.
            </div>

            <div style="display:flex; gap:10px;">
                <button type="submit"
                    style="flex:1; padding:12px; background:#2563eb; color:white; border:none; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer;">
                    Simpan Teknisi
                </button>
                <a href="/admin/technicians"
                    style="flex:1; padding:12px; background:#f1f5f9; color:#1e293b; text-decoration:none; border-radius:8px; font-size:14px; font-weight:500; text-align:center;">
                    Batal
                </a>
            </div>

        </form>
    </div>
    @endif

</div>

@endsection