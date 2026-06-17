<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — FixNow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            margin: 0; padding: 0; box-sizing: border-box;
        }

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

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--bg-light);
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            width: 45%;
            background: linear-gradient(135deg, #1e40af 0%, #1a3f8a 25%, #0f3668 60%, #0a2848 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 52px;
            position: relative;
            overflow: hidden;
            box-shadow: inset -1px 0 2px rgba(0,0,0,0.2);
        }

        /* decorative elements */
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

        /* additional decorative line */
        .left-panel .decoration-line {
            position: absolute;
            top: 120px; right: 0;
            width: 80px; height: 3px;
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.6), transparent);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            height: 40px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
            object-position: center;
            flex-shrink: 0;
            background: var(--white);
            border-radius: 12px;
            padding: 6px 14px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }

        .brand-logo:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
        }

        .left-content {
            position: relative;
            z-index: 1;
        }

        .left-content h1 {
            font-size: 42px;
            font-weight: 900;
            color: var(--white);
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

        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: relative;
            z-index: 1;
        }

        .feature-item {
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

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(170, 224, 252, 0.3);
            transform: translateX(4px);
        }

        .feature-dot {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(170, 224, 252, 0.25), rgba(96, 165, 250, 0.15));
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
            color: #aaf0fc;
        }

        .feature-dot svg {
            width: 18px;
            height: 18px;
            display: block;
            stroke-width: 1.5;
        }

        .feature-text {
            font-size: 13.5px;
            color: rgba(255,255,255,0.90);
            font-weight: 500;
            line-height: 1.4;
        }

        /* ── RIGHT PANEL ── */
        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 32px;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        .login-box h2 {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .login-box .subtitle {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 32px;
        }

        /* status alert */
        .alert-success {
            background: #f0fdf4;
            border: 1px solid #86efac;
            color: #15803d;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        /* form elements */
        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
            pointer-events: none;
            display: flex;
        }

        .input-icon svg {
            width: 16px;
            height: 16px;
            display: block;
        }

        .field input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            background: var(--white);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        .field input.error {
            border-color: var(--error);
        }

        .field-error {
            font-size: 12px;
            color: var(--error);
            margin-top: 5px;
        }

        /* remember + forgot row */
        .row-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .remember span {
            font-size: 13px;
            color: var(--muted);
        }

        .forgot-link {
            font-size: 13px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        /* submit button */
        .btn-login {
            width: 100%;
            padding: 13px;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            letter-spacing: 0.2px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .btn-login:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: scale(0.99);
        }

        /* divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider span {
            font-size: 12px;
            color: #94a3b8;
            font-weight: 500;
        }

        /* register link */
        .register-row {
            text-align: center;
            font-size: 13.5px;
            color: var(--muted);
        }

        .register-row a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .register-row a:hover {
            text-decoration: underline;
        }

        /* sky accent strip on top of card */
        .sky-strip {
            height: 4px;
            background: linear-gradient(90deg, var(--sky), var(--navy));
            border-radius: 10px 10px 0 0;
            margin-bottom: 32px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left-panel {
                width: 100%;
                padding: 32px 28px;
                min-height: auto;
            }
            .left-content h1 { font-size: 26px; }
            .feature-list { display: none; }
            .left-content p { display: none; }
        }

        /* ── DARK THEME ── */
        body.dark-theme {
            background: #0f172a;
        }

        body.dark-theme .right-panel {
            background: #0f172a;
        }

        body.dark-theme .login-box h2 {
            color: white;
        }

        body.dark-theme .login-box .subtitle {
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

        body.dark-theme .field input {
            background: #1e293b;
            border-color: #334155;
            color: white;
        }

        body.dark-theme .field input::placeholder {
            color: #64748b;
        }

        body.dark-theme .field input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.2);
        }

        body.dark-theme .field input.error {
            border-color: #ef4444;
        }

        body.dark-theme .field-error {
            color: #fca5a5;
        }

        body.dark-theme .remember span {
            color: #cbd5e1;
        }

        body.dark-theme .remember input[type="checkbox"] {
            accent-color: #3b82f6;
        }

        body.dark-theme .forgot-link {
            color: #3b82f6;
        }

        body.dark-theme .forgot-link:hover {
            color: #60a5fa;
        }

        body.dark-theme .divider::before,
        body.dark-theme .divider::after {
            background: #334155;
        }

        body.dark-theme .divider span {
            color: #94a3b8;
        }

        body.dark-theme .register-row {
            color: #cbd5e1;
        }

        body.dark-theme .register-row a {
            color: #3b82f6;
        }

        body.dark-theme .register-row a:hover {
            color: #60a5fa;
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

<!-- ── LEFT PANEL ── -->
<div class="left-panel">

    <div class="brand">
        <img src="{{ asset('images/logo.png') }}" alt="FixNow Logo" class="brand-logo">
    </div>

    <div class="left-content">
        <h1>Teknisi Datang,<br><span>Masalah Hilang.</span></h1>
        <p>Platform pemesanan teknisi AC, WiFi, Laptop, Printer, dan Listrik — cepat dan terpercaya.</p>
    </div>

    <div class="feature-list">
        <div class="feature-item">
            <div class="feature-dot"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.983 1.907a.75.75 0 00-1.292-.657l-8.5 9.5A.75.75 0 002.75 12h6.572l-1.305 6.093a.75.75 0 001.292.657l8.5-9.5A.75.75 0 0017.25 8h-6.572l1.305-6.093z" clip-rule="evenodd"/></svg></div>
            <span class="feature-text">Respons teknisi dalam hitungan menit</span>
        </div>
        <div class="feature-item">
            <div class="feature-dot"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.661.94a2.25 2.25 0 01.678 0 11.959 11.959 0 007.078 2.749.75.75 0 01.512.643c.013.197.041.395.057.594.179 2.182-.04 4.405-.652 6.521A14.987 14.987 0 0110.5 18.96c-.04.024-.082.045-.124.066a.75.75 0 01-.752 0 14.987 14.987 0 01-7.083-7.513c-.612-2.116-.831-4.339-.652-6.521.016-.199.044-.397.057-.594a.75.75 0 01.512-.643A11.959 11.959 0 008.984.94zm4.196 5.954a.75.75 0 00-1.214-.882l-2.402 3.305-.946-1.024a.75.75 0 10-1.106 1.014l1.572 1.701a.75.75 0 001.16-.066l2.936-4.048z" clip-rule="evenodd"/></svg></div>
            <span class="feature-text">Teknisi terverifikasi dan berpengalaman</span>
        </div>
        <div class="feature-item">
            <div class="feature-dot"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 003 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd"/></svg></div>
            <span class="feature-text">Layanan langsung ke lokasi kamu</span>
        </div>
    </div>

</div>

<!-- ── RIGHT PANEL ── -->
<div class="right-panel">
    <div class="login-box">

        <div class="sky-strip"></div>

        <h2>Selamat Datang</h2>
        <p class="subtitle">Masuk ke akun FixNow kamu</p>

        @if (session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="field">
                <label for="email">Email</label>
                <div class="input-wrap">
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z"/><path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z"/></svg></span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="kamu@email.com"
                        class="{{ $errors->has('email') ? 'error' : '' }}"
                        required
                        autofocus
                        autocomplete="username"
                    >
                </div>
                @error('email')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="field">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd"/></svg></span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        class="{{ $errors->has('password') ? 'error' : '' }}"
                        required
                        autocomplete="current-password"
                    >
                </div>
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember + Forgot -->
            <div class="row-between">
                <label class="remember">
                    <input type="checkbox" name="remember" id="remember_me">
                    <span>Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                @endif
            </div>

            <button type="submit" class="btn-login">
                Masuk ke FixNow
            </button>

            <div class="divider"><span>Belum punya akun?</span></div>

            <div class="register-row">
                <a href="{{ route('register') }}">Daftar sekarang</a> — gratis!
            </div>

        </form>
    </div>
</div>

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