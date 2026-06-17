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
        --error:      #ef4444;
    }

    .wrap { 
        max-width: 800px; 
        margin: 0 auto; 
        padding: 0 0 48px;
    }

    /* PAGE HEADER */
    .page-header { 
        margin-bottom: 28px;
    }
    
    .page-header h1 {
        font-size: 28px; 
        font-weight: 800; 
        color: var(--dark);
        letter-spacing: -0.5px; 
        margin-bottom: 6px;
    }
    
    .page-header p { 
        font-size: 14px; 
        color: var(--muted);
    }

    /* FORM CARD */
    .form-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .form-card-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 32px;
    }
    
    .form-card-header .label {
        font-size: 11px; 
        font-weight: 700;
        color: rgba(59, 130, 246, 0.7);
        text-transform: uppercase; 
        letter-spacing: 1.2px;
        margin-bottom: 6px;
    }
    
    .form-card-header h2 {
        font-size: 24px; 
        font-weight: 800; 
        color: white; 
        letter-spacing: -0.5px;
    }
    
    .form-card-header p {
        font-size: 14px; 
        color: rgba(255, 255, 255, 0.75); 
        margin-top: 8px; 
        max-width: 480px; 
        line-height: 1.6;
    }

    .form-body { padding: 28px; }

    .field-group { margin-bottom: 20px; }

    .field-group label {
        display: block;
        font-size: 12.5px; font-weight: 700; color: #0f172a;
        margin-bottom: 8px;
    }

    .field-group .hint {
        font-size: 12px; color: var(--muted); margin-top: 6px;
    }

    .field-group select,
    .field-group input,
    .field-group textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        color: #0f172a;
        background: var(--white);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .field-group select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 16px;
        padding-right: 40px;
    }

    .field-group textarea {
        min-height: 130px;
        resize: vertical;
        line-height: 1.6;
    }

    .field-group select:focus,
    .field-group input:focus,
    .field-group textarea:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(35, 90, 157, 0.10);
    }

    .field-group.has-error select,
    .field-group.has-error input,
    .field-group.has-error textarea {
        border-color: var(--error);
    }

    .field-error {
        font-size: 12px;
        color: var(--error);
        margin-top: 6px;
    }

    /* INFO BANNER */
    .info-banner {
        margin-bottom: 24px;
        background: var(--light);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 12px 16px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 13px;
        color: #334155;
        line-height: 1.6;
    }
    .info-banner span.icon { font-size: 16px; flex-shrink: 0; }

    /* ACTIONS */
    .form-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .btn-submit {
        padding: 12px 24px;
        background: var(--primary); color: white;
        border: none;
        border-radius: 10px;
        font-size: 14px; font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        box-shadow: 0 3px 10px rgba(35,90,157,0.25);
        transition: background 0.18s, box-shadow 0.18s, transform 0.1s;
    }
    .btn-submit:hover {
        background: var(--primary-dark);
        box-shadow: 0 5px 16px rgba(35,90,157,0.35);
    }
    .btn-submit:active { transform: scale(0.98); }

    .btn-cancel {
        display: inline-flex; align-items: center;
        padding: 12px 24px;
        background: var(--white); color: #475569;
        text-decoration: none;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-size: 14px; font-weight: 600;
        transition: all 0.18s;
    }
    .btn-cancel:hover {
        background: var(--light);
        border-color: var(--navy);
        color: var(--primary);
    }

    @media (max-width: 560px) {
        .form-card-header, .form-body { padding: 22px; }
        .form-actions { flex-direction: column; align-items: stretch; }
        .form-actions .btn-submit,
        .form-actions .btn-cancel { text-align: center; justify-content: center; }
    }
</style>

<div class="wrap">

    <div class="page-header">
        <h1>Daftar Jadi Teknisi</h1>
        <p>Lengkapi data di bawah untuk mengajukan diri sebagai teknisi FixNow.</p>
    </div>

    <div class="form-card">

        <div class="form-card-header">
            <p class="label">Lamaran Teknisi</p>
            <h2>Formulir Pengajuan</h2>
            <p>Tim kami akan meninjau lamaranmu. Setelah disetujui, kamu bisa mulai menerima order sesuai layanan yang dipilih.</p>
        </div>

        <div class="form-body">

            <div class="info-banner">
                <span class="icon">ℹ️</span>
                <span>Satu teknisi hanya dapat memilih satu jenis layanan. Pastikan kamu memilih layanan yang paling sesuai dengan keahlianmu.</span>
            </div>

            <form method="POST" action="/apply-technician">
                @csrf

                {{-- Jenis Layanan --}}
                <div class="field-group @error('service_id') has-error @enderror">
                    <label for="service_id">Jenis Layanan</label>
                    <select name="service_id" id="service_id" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>
                                {{ $service->service_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Pengalaman --}}
                <div class="field-group @error('experience') has-error @enderror">
                    <label for="experience">Pengalaman (tahun)</label>
                    <input type="number" name="experience" id="experience" min="0" value="{{ old('experience') }}" placeholder="Contoh: 2" required>
                    @error('experience')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="field-group @error('description') has-error @enderror">
                    <label for="description">Deskripsi / Keahlian</label>
                    <textarea name="description" id="description" rows="4"
                        placeholder="Ceritakan pengalaman dan keahlian kamu...">{{ old('description') }}</textarea>
                    <p class="hint">Opsional, tapi sangat membantu proses peninjauan lamaranmu.</p>
                    @error('description')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Submit Lamaran</button>
                    <a href="{{ url('/dashboard') }}" class="btn-cancel">Batal</a>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection