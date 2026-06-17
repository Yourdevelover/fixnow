@extends('layouts.app')

@section('content')

<style>
    .page-header { margin-bottom: 24px; }
    .page-header h1 { font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
    .page-header p  { font-size: 13.5px; color: #64748b; }

    .back-link {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 13px; font-weight: 600; color: #235a9d;
        text-decoration: none; margin-bottom: 20px;
    }
    .back-link:hover { color: #0f3668; }

    .detail-card {
        background: white;
        border: 1px solid #d0e8f8;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(35,90,157,0.07);
        margin-bottom: 20px;
    }
    .detail-card-header {
        background: linear-gradient(135deg, #235a9d 0%, #0f3668 100%);
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .detail-card-header .title { font-size: 17px; font-weight: 800; color: white; }
    .detail-card-header .order-num { font-size: 12.5px; color: rgba(170,224,252,0.8); margin-top: 2px; }

    .badge { padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; white-space: nowrap; }
    .badge.pending { background: #fef9c3; color: #854d0e; }
    .badge.process { background: #dbeafe; color: #1e40af; }
    .badge.completed { background: #dcfce7; color: #166534; }

    .detail-body { padding: 24px; }

    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px 24px; }
    .info-item .lbl {
        font-size: 11px; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.7px; color: #94a3b8; margin-bottom: 4px;
    }
    .info-item .val { font-size: 14px; color: #0f172a; font-weight: 500; line-height: 1.5; }
    .info-item.full { grid-column: span 2; }

    .pay-badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .pay-paid   { background: #dcfce7; color: #166534; }
    .pay-unpaid { background: #fee2e2; color: #991b1b; }

    .divider { border: none; border-top: 1px solid #e8f2fc; margin: 20px 0; }

    /* Update form card */
    .form-card {
        background: white;
        border: 1px solid #d0e8f8;
        border-radius: 14px;
        padding: 24px;
        box-shadow: 0 1px 4px rgba(35,90,157,0.07);
    }
    .form-card h2 {
        font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 20px;
        display: flex; align-items: center; gap: 8px;
    }

    .status-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 22px;
    }
    .status-option {
        position: relative;
    }
    .status-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0; height: 0;
    }
    .status-option label {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        cursor: pointer;
        transition: border-color 0.18s, background 0.18s;
        font-size: 14px;
        font-weight: 600;
        color: #475569;
    }
    .status-option input:checked + label {
        border-color: #235a9d;
        background: #eff6ff;
        color: #235a9d;
    }
    .status-option label:hover {
        border-color: #93c5fd;
        background: #f8fbff;
    }
    .status-icon { font-size: 20px; }
    .status-desc { font-size: 11.5px; font-weight: 400; color: #94a3b8; margin-top: 2px; }

    .btn-save {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #235a9d 0%, #0f3668 100%);
        color: white; border: none; border-radius: 10px;
        font-size: 15px; font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        box-shadow: 0 3px 10px rgba(35,90,157,0.30);
        transition: opacity 0.18s, box-shadow 0.18s;
    }
    .btn-save:hover { opacity: 0.88; box-shadow: 0 5px 16px rgba(35,90,157,0.40); }

    /* Locked state */
    .locked-box {
        display: flex; align-items: flex-start; gap: 14px;
        background: #f0fdf4; border: 1px solid #bbf7d0;
        border-radius: 12px; padding: 18px 20px;
    }
    .locked-icon { font-size: 22px; flex-shrink: 0; margin-top: 1px; }
    .locked-title { font-size: 14px; font-weight: 700; color: #166534; margin-bottom: 4px; }
    .locked-desc  { font-size: 13px; color: #14532d; }
</style>

{{-- Back --}}
<a href="/technician/orders" class="back-link">← Kembali ke Incoming Orders</a>

{{-- Header --}}
<div class="page-header">
    <h1>✏️ Update Status Order</h1>
    <p>Perbarui status pekerjaan sesuai progres di lapangan.</p>
</div>

{{-- Detail card --}}
<div class="detail-card">
    <div class="detail-card-header">
        <div>
            <div class="title">{{ $order->service->service_name }}</div>
            <div class="order-num">Order #{{ $order->id }}</div>
        </div>
        @php $s = $order->status; @endphp
        <span class="badge {{ $s }}">{{ ucfirst($s) }}</span>
    </div>
    <div class="detail-body">
        <div class="info-grid">
            <div class="info-item">
                <div class="lbl">Customer</div>
                <div class="val">{{ $order->user->name }}</div>
            </div>
            <div class="info-item">
                <div class="lbl">Teknisi</div>
                <div class="val">{{ $order->technician->user->name }}</div>
            </div>
            <div class="info-item full">
                <div class="lbl">Alamat</div>
                <div class="val">{{ $order->address }}</div>
            </div>
            <div class="info-item full">
                <div class="lbl">Deskripsi Masalah</div>
                <div class="val">{{ $order->problem_description }}</div>
            </div>
            <div class="info-item">
                <div class="lbl">Harga</div>
                <div class="val">Rp {{ number_format($order->price) }}</div>
            </div>
            <div class="info-item">
                <div class="lbl">Payment</div>
                <div class="val">
                    <span class="pay-badge {{ $order->payment_status == 'paid' ? 'pay-paid' : 'pay-unpaid' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>
            <div class="info-item">
                <div class="lbl">Dibuat</div>
                <div class="val">{{ $order->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div class="info-item">
                <div class="lbl">Terakhir Diupdate</div>
                <div class="val">{{ $order->updated_at->format('d M Y, H:i') }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Update status / locked --}}
@if($order->status === 'completed' && $hasReview)
    <div class="locked-box">
        <div class="locked-icon">✅</div>
        <div>
            <div class="locked-title">Order sudah selesai & dirating</div>
            <div class="locked-desc">Status tidak bisa diubah lagi karena customer sudah memberikan ulasan.</div>
        </div>
    </div>
@else
    <div class="form-card">
        <h2>🔄 Ubah Status</h2>
        <form action="/orders/{{ $order->id }}/status" method="POST">
            @csrf
            @method('PUT')

            <div class="status-options">
                <div class="status-option">
                    <input type="radio" name="status" id="s_process" value="process"
                        {{ $order->status === 'process' ? 'checked' : '' }}>
                    <label for="s_process">
                        <span class="status-icon">🔵</span>
                        <div>
                            <div>On Process</div>
                            <div class="status-desc">Sedang dikerjakan di lapangan</div>
                        </div>
                    </label>
                </div>
                <div class="status-option">
                    <input type="radio" name="status" id="s_completed" value="completed"
                        {{ $order->status === 'completed' ? 'checked' : '' }}>
                    <label for="s_completed">
                        <span class="status-icon">✅</span>
                        <div>
                            <div>Completed</div>
                            <div class="status-desc">Pekerjaan sudah selesai</div>
                        </div>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </form>
    </div>
@endif

@endsection