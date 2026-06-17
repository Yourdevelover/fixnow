@extends('layouts.admin')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
        <h1 style="font-size:22px; font-weight:600; margin-bottom:4px;">Services Management</h1>
        <p style="color:#64748b; font-size:14px;">{{ count($services) }}
    </div>
    <a href="/admin/services/create"
        style="display:inline-flex; align-items:center; gap:8px; padding:10px 18px; background:#2563eb; color:white; text-decoration:none; border-radius:8px; font-size:14px; font-weight:500;">
        + Tambah Service
    </a>
</div>

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

    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#f8fafc; border-bottom:1px solid #e2e8f0;">
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em; width:40px;">#</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Nama Layanan</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Deskripsi</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Harga Dasar</th>
                <th style="padding:12px 20px; text-align:left; font-size:12px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.05em;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $i => $service)
            <tr style="border-bottom:1px solid #f1f5f9; transition:background .1s;"
                onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background=''">

                <td style="padding:14px 20px; color:#94a3b8; font-size:13px;">{{ $i + 1 }}</td>

                <td style="padding:14px 20px;">
                    <div style="font-size:14px; font-weight:600; color:#1e293b;">{{ $service->service_name }}</div>
                    <div style="font-size:12px; color:#94a3b8; margin-top:2px;">{{ $service->slug }}</div>
                </td>

                <td style="padding:14px 20px; font-size:13px; color:#475569; max-width:300px;">
                    <div style="overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">
                        {{ $service->description }}
                    </div>
                </td>

                <td style="padding:14px 20px;">
                    <span style="font-size:14px; font-weight:600; color:#2563eb;">
                        Rp {{ number_format($service->base_price) }}
                    </span>
                </td>

                <td style="padding:14px 20px;">
                    <div style="display:flex; gap:8px;">
                        <a href="/admin/services/{{ $service->id }}/edit"
                            style="padding:6px 14px; background:#f1f5f9; color:#1e293b; text-decoration:none; border-radius:6px; font-size:13px; font-weight:500;">
                            Edit
                        </a>
                        <form method="POST" action="/admin/services/{{ $service->id }}"
                            onsubmit="return confirm('Hapus layanan \'{{ $service->service_name }}\'? Tindakan ini tidak bisa dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="padding:6px 14px; background:#fee2e2; color:#dc2626; border:none; border-radius:6px; font-size:13px; font-weight:500; cursor:pointer;">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding:40px; text-align:center; color:#94a3b8; font-size:14px;">
                    Belum ada layanan. <a href="/admin/services/create" style="color:#2563eb;">Tambah sekarang</a>.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection