<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar — FixNow</title>
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
            --error:      #dc2626;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--bg-light);
        }

        /* LEFT PANEL */
        .left-panel {
            width: 40%;
            background: linear-gradient(135deg, #1e40af 0%, #1a3f8a 25%, #0f3668 60%, #0a2848 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 52px;
            position: relative;
            overflow: hidden;
            box-shadow: inset -1px 0 2px rgba(0,0,0,0.2);
        }
        .left-panel::before {
            content: '';
            position: absolute;
            top: -120px; right: -120px;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, rgba(59, 130, 246, 0.08) 70%, transparent 100%);
            animation: float 8s ease-in-out infinite;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -100px; left: -100px;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.15) 0%, rgba(14, 165, 233, 0.05) 70%, transparent 100%);
            animation: float 10s ease-in-out infinite 1s;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .brand {
            display: flex; align-items: center; gap: 10px;
            position: relative; z-index: 1;
        }
        .brand-logo {
            height: 40px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
            object-position: center;
            flex-shrink: 0;
            background: #ffffff;
            border-radius: 12px;
            padding: 6px 14px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }

        .brand-logo:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
        }
        .left-content { position: relative; z-index: 1; }
        .left-content h1 {
            font-size: 42px;
            font-weight: 900;
            color: white;
            line-height: 1.15;
            letter-spacing: -1.5px;
            margin-bottom: 16px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        .left-content h1 span {
            color: #aaf0fc;
            background: linear-gradient(135deg, #aaf0fc 0%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .left-content p {
            font-size: 15px;
            color: rgba(255,255,255,0.75);
            line-height: 1.7;
            max-width: 320px;
            font-weight: 500;
        }
        .steps-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: relative;
            z-index: 1;
        }
        .step-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            cursor: default;
        }
        .step-item:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(170, 224, 252, 0.3);
            transform: translateX(4px);
        }
        .step-num {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(170, 224, 252, 0.25), rgba(96, 165, 250, 0.15));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: #aaf0fc;
            flex-shrink: 0;
        }
        .step-text {
            font-size: 13.5px;
            color: rgba(255,255,255,0.90);
            font-weight: 500;
            line-height: 1.4;
        }

        /* RIGHT PANEL */
        .right-panel {
            flex: 1;
            overflow-y: auto;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 40px 32px;
        }
        .register-box { width: 100%; max-width: 460px; }
        .sky-strip {
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--primary));
            border-radius: 10px 10px 0 0;
            margin-bottom: 28px;
        }
        .register-box h2 {
            font-size: 24px; font-weight: 800; color: #0f172a;
            letter-spacing: -0.5px; margin-bottom: 4px;
        }
        .register-box .subtitle { font-size: 13px; color: var(--muted); margin-bottom: 24px; }

        /* FIELDS */
        .field { margin-bottom: 14px; }
        .field label {
            display: block; font-size: 12px; font-weight: 600;
            color: #374151; text-transform: uppercase;
            letter-spacing: 0.6px; margin-bottom: 6px;
        }
        .field label .req { color: var(--error); }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute; left: 13px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8; font-size: 15px; pointer-events: none;
            display: flex;
        }
        .input-icon svg { width: 15px; height: 15px; display: block; }
        .input-icon-top {
            position: absolute; left: 13px; top: 13px;
            font-size: 15px; pointer-events: none;
            color: #94a3b8;
            display: flex;
        }
        .input-icon-top svg { width: 15px; height: 15px; display: block; }
        .field input,
        .field textarea {
            width: 100%;
            padding: 11px 14px 11px 40px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 13.5px;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            background: white;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .field textarea {
            resize: none; min-height: 80px; padding-top: 11px;
        }
        .field input:focus,
        .field textarea:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(35,90,157,0.10);
        }
        .field input.is-error,
        .field textarea.is-error { border-color: var(--error); }
        .field-error { font-size: 11.5px; color: var(--error); margin-top: 4px; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        /* FOTO UPLOAD */
        .photo-upload-wrap {
            border: 2px dashed var(--border);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            background: white;
            position: relative;
        }
        .photo-upload-wrap:hover { border-color: var(--primary); background: var(--bg-light); }
        .photo-upload-wrap input[type=file] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .photo-preview {
            width: 72px; height: 72px; border-radius: 50%;
            object-fit: cover; margin: 0 auto 8px;
            border: 3px solid var(--border);
            display: none;
        }
        .photo-placeholder {
            font-size: 36px; margin-bottom: 6px;
            display: flex; justify-content: center;
            color: var(--navy);
        }
        .photo-placeholder svg { width: 36px; height: 36px; }
        .photo-upload-wrap p {
            font-size: 12.5px; color: var(--muted); margin: 0;
        }
        .photo-upload-wrap strong { color: var(--primary); }

        /* SUBMIT */
        .btn-register {
            width: 100%; padding: 13px;
            background: var(--primary); color: white;
            border: none; border-radius: 10px;
            font-size: 15px; font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(35,90,157,0.30);
            margin-top: 6px;
        }
        .btn-register:hover { background: var(--navy-dark); }

        .divider {
            display: flex; align-items: center; gap: 12px; margin: 18px 0;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: var(--border);
        }
        .divider span { font-size: 12px; color: #94a3b8; }
        .login-row { text-align: center; font-size: 13px; color: var(--muted); }
        .login-row a { color: var(--primary); font-weight: 700; text-decoration: none; }
        .login-row a:hover { text-decoration: underline; }

        .section-label {
            font-size: 11px; font-weight: 700; color: var(--primary);
            text-transform: uppercase; letter-spacing: 1px;
            margin: 18px 0 12px;
            display: flex; align-items: center; gap: 8px;
        }
        .section-label::after {
            content: ''; flex: 1; height: 1px; background: var(--border);
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left-panel { width: 100%; padding: 28px 24px; }
            .left-content h1 { font-size: 24px; }
            .steps-list, .left-content p { display: none; }
            .form-row { grid-template-columns: 1fr; }
        }

        /* ── DARK THEME ── */
        body.dark-theme {
            background: #0f172a;
        }

        body.dark-theme .right-panel {
            background: #0f172a;
        }

        body.dark-theme .register-box h2 {
            color: white;
        }

        body.dark-theme .register-box .subtitle {
            color: #cbd5e1;
        }

        body.dark-theme .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
            color: #86efac;
        }

        body.dark-theme .field label {
            color: #e2e8f0;
        }

        body.dark-theme .input-icon {
            color: #64748b;
        }

        body.dark-theme .field input,
        body.dark-theme .field select,
        body.dark-theme .field textarea {
            background: #1e293b;
            border-color: #334155;
            color: white;
        }

        body.dark-theme .field input::placeholder,
        body.dark-theme .field select::placeholder,
        body.dark-theme .field textarea::placeholder {
            color: #64748b;
        }

        body.dark-theme .field input:focus,
        body.dark-theme .field select:focus,
        body.dark-theme .field textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.2);
        }

        body.dark-theme .field input.error,
        body.dark-theme .field textarea.error {
            border-color: #ef4444;
        }

        body.dark-theme .field-error {
            color: #fca5a5;
        }

        body.dark-theme .divider::before,
        body.dark-theme .divider::after {
            background: #334155;
        }

        body.dark-theme .divider span {
            color: #94a3b8;
        }

        body.dark-theme .login-row {
            color: #cbd5e1;
        }

        body.dark-theme .login-row a {
            color: #3b82f6;
        }

        body.dark-theme .login-row a:hover {
            color: #60a5fa;
        }

        body.dark-theme .section-label {
            color: #3b82f6;
        }

        body.dark-theme .section-label::after {
            background: #334155;
        }

        body.dark-theme .photo-upload-wrap {
            border-color: #334155;
            background: #1e293b;
        }

        body.dark-theme .photo-upload-wrap strong {
            color: white;
        }

        body.dark-theme .photo-upload-wrap p {
            color: #cbd5e1;
        }

        body.dark-theme .sky-strip {
            background: linear-gradient(90deg, #3b82f6, #1e40af);
        }

        /* Theme toggle button */
        .theme-toggle-btn {
            position: fixed;
            top: 24px;
            right: 24px;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: white;
            border: 1.5px solid var(--border);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            font-weight: 600;
        }

        .theme-toggle-btn:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
            border-color: var(--primary);
        }

        .theme-toggle-btn:active {
            transform: translateY(0);
        }

        .theme-toggle-btn svg {
            width: 24px;
            height: 24px;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .theme-toggle-btn.rotating svg {
            animation: rotate-icon 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes rotate-icon {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        body.dark-theme .theme-toggle-btn {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-color: #475569;
            color: #fbbf24;
        }

        body.dark-theme .theme-toggle-btn:hover {
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.2);
            border-color: #3b82f6;
        }
    </style>
</head>
<body>

<div class="left-panel">
    <div class="brand">
        <img src="{{ asset('images/logo.png') }}" alt="FixNow Logo" class="brand-logo">
    </div>
    <div class="left-content">
        <h1>Mulai dalam<br><span>3 Langkah.</span></h1>
        <p>Daftar sekarang dan dapatkan akses ke ratusan teknisi terverifikasi siap membantu kamu.</p>
    </div>
    <div class="steps-list">
        <div class="step-item">
            <div class="step-num">1</div>
            <span class="step-text">Buat akun gratis kamu</span>
        </div>
        <div class="step-item">
            <div class="step-num">2</div>
            <span class="step-text">Pilih layanan dan deskripsikan masalah</span>
        </div>
        <div class="step-item">
            <div class="step-num">3</div>
            <span class="step-text">Teknisi datang ke lokasi kamu</span>
        </div>
    </div>
</div>

<div class="right-panel">
    <div class="register-box">
        <div class="sky-strip"></div>
        <h2>Buat Akun Baru</h2>
        <p class="subtitle">Lengkapi semua data di bawah untuk mendaftar</p>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            {{-- Foto Profil --}}
            <div class="field">
                <label>Foto Profil <span class="req">*</span></label>
                <div class="photo-upload-wrap" onclick="document.getElementById('photoInput').click()">
                    <input type="file" id="photoInput" name="photo"
                        accept="image/jpg,image/jpeg,image/png,image/webp"
                        onchange="previewPhoto(this)" style="display:none;">
                    <img id="photoPreview" class="photo-preview" src="" alt="Preview">
                    <div id="photoPlaceholder">
                        <div class="photo-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M1 8a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 018.07 3h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0016.07 6H17a2 2 0 012 2v7a2 2 0 01-2 2H3a2 2 0 01-2-2V8zm13.5 3a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM10 14a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/></svg></div>
                        <p><strong>Klik untuk upload foto</strong></p>
                        <p>JPG, PNG, WEBP — maks. 2MB</p>
                    </div>
                </div>
                @error('photo')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="section-label">Informasi Akun</div>

            {{-- Nama --}}
            <div class="field">
                <label>Nama Lengkap <span class="req">*</span></label>
                <div class="input-wrap">
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z"/></svg></span>
                    <input type="text" name="name" value="{{ old('name') }}"
                        placeholder="Nama lengkap kamu"
                        class="{{ $errors->has('name') ? 'is-error' : '' }}"
                        required autofocus autocomplete="name">
                </div>
                @error('name') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            {{-- Email --}}
            <div class="field">
                <label>Email <span class="req">*</span></label>
                <div class="input-wrap">
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z"/><path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z"/></svg></span>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="kamu@email.com"
                        class="{{ $errors->has('email') ? 'is-error' : '' }}"
                        required autocomplete="username">
                </div>
                @error('email') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                {{-- Password --}}
                <div class="field">
                    <label>Password <span class="req">*</span></label>
                    <div class="input-wrap">
                        <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd"/></svg></span>
                        <input type="password" name="password"
                            placeholder="Min. 8 karakter"
                            class="{{ $errors->has('password') ? 'is-error' : '' }}"
                            required autocomplete="new-password">
                    </div>
                    @error('password') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="field">
                    <label>Konfirmasi Password <span class="req">*</span></label>
                    <div class="input-wrap">
                        <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd"/></svg></span>
                        <input type="password" name="password_confirmation"
                            placeholder="Ulangi password"
                            class="{{ $errors->has('password_confirmation') ? 'is-error' : '' }}"
                            required autocomplete="new-password">
                    </div>
                    @error('password_confirmation') <div class="field-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="section-label">Informasi Kontak</div>

            {{-- No. HP --}}
            <div class="field">
                <label>No. Handphone <span class="req">*</span></label>
                <div class="input-wrap">
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 1a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V3a2 2 0 00-2-2H5zm5 16a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg></span>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        placeholder="08xx xxxx xxxx"
                        class="{{ $errors->has('phone') ? 'is-error' : '' }}"
                        required>
                </div>
                @error('phone') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            {{-- Alamat --}}
            <div class="field">
                <label>Alamat <span class="req">*</span></label>
                <div class="input-wrap">
                    <span class="input-icon-top"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 003 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd"/></svg></span>
                    <textarea name="address"
                        placeholder="Jl. Contoh No. 1, RT/RW, Kelurahan, Kecamatan, Kota"
                        style="padding-left:40px;"
                        class="{{ $errors->has('address') ? 'is-error' : '' }}"
                        required>{{ old('address') }}</textarea>
                </div>
                @error('address') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn-register">Buat Akun Sekarang</button>

            <div class="divider"><span>Sudah punya akun?</span></div>
            <div class="login-row">
                <a href="{{ route('login') }}">Masuk di sini</a> — langsung lanjut!
            </div>

        </form>
    </div>
</div>

<script>
    function previewPhoto(input) {
        const preview     = document.getElementById('photoPreview');
        const placeholder = document.getElementById('photoPlaceholder');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src           = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<!-- Theme Toggle Button -->
<button class="theme-toggle-btn" id="themeToggle" title="Toggle dark/light mode" aria-label="Toggle theme">
    <svg id="sunIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
        <circle cx="12" cy="12" r="5"></circle>
        <line x1="12" y1="1" x2="12" y2="3"></line>
        <line x1="12" y1="21" x2="12" y2="23"></line>
        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
        <line x1="1" y1="12" x2="3" y2="12"></line>
        <line x1="21" y1="12" x2="23" y2="12"></line>
        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
    </svg>
    <svg id="moonIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
    </svg>
</button>

<script>
    // Initialize theme from localStorage or system preference
    function initTheme() {
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const isDark = savedTheme ? savedTheme === 'dark' : prefersDark;
        
        updateThemeUI(isDark);
    }

    function updateThemeUI(isDark) {
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        
        if (isDark) {
            document.body.classList.add('dark-theme');
            sunIcon.style.display = 'block';
            moonIcon.style.display = 'none';
        } else {
            document.body.classList.remove('dark-theme');
            sunIcon.style.display = 'none';
            moonIcon.style.display = 'block';
        }
    }

    // Theme toggle functionality
    document.getElementById('themeToggle').addEventListener('click', function() {
        this.classList.add('rotating');
        setTimeout(() => this.classList.remove('rotating'), 600);
        
        document.body.classList.toggle('dark-theme');
        const isDark = document.body.classList.contains('dark-theme');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        
        updateThemeUI(isDark);
    });

    // Initialize theme on page load
    initTheme();
</script>

</body>
</html>