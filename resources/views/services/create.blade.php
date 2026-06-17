@extends('layouts.admin')

@section('content')

<div style="max-width:560px; margin:0 auto;">

    <a href="/admin/services"
        style="display:inline-flex; align-items:center; gap:6px; font-size:13px; color:#64748b; text-decoration:none; margin-bottom:20px;">
        ← Kembali ke daftar service
    </a>

    <h1 style="font-size:22px; font-weight:600; margin-bottom:4px;">Tambah Service</h1>
    <p style="color:#64748b; font-size:14px; margin-bottom:24px;">Tambah layanan baru yang bisa dipesan oleh user.</p>

    @if($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:14px;">
            @foreach($errors->all() as $err)
                <div>✕ {{ $err }}</div>
            @endforeach
        </div>
    @endif

    <div style="background:white; border-radius:12px; padding:28px; box-shadow:0 1px 4px rgba(0,0,0,.08);">

        <form method="POST" action="/admin/services">
            @csrf

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Nama Layanan</label>
                <input type="text" name="service_name" value="{{ old('service_name') }}" required
                    placeholder="Contoh: Servis AC, Perbaikan Kulkas..."
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px;">
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Deskripsi</label>
                <textarea name="description" required rows="4"
                    placeholder="Jelaskan cakupan layanan ini..."
                    style="width:100%; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px; resize:vertical;">{{ old('description') }}</textarea>
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:14px; font-weight:500; margin-bottom:6px;">Harga Dasar</label>
                <div style="position:relative;">
                    <span style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:14px; color:#64748b; pointer-events:none;">Rp</span>
                    <input type="number" name="base_price" value="{{ old('base_price') }}" required min="0"
                        placeholder="0"
                        style="width:100%; padding:10px 12px 10px 36px; border:1px solid #e2e8f0; border-radius:8px; font-size:14px;">
                </div>
            </div>

            <div style="display:flex; gap:10px;">
                <button type="submit"
                    style="flex:1; padding:12px; background:#2563eb; color:white; border:none; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer;">
                    Simpan Service
                </button>
                <a href="/admin/services"
                    style="flex:1; padding:12px; background:#f1f5f9; color:#1e293b; text-decoration:none; border-radius:8px; font-size:14px; font-weight:500; text-align:center;">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>

@endsection