<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FixNow Teknisi Datang, Masalah Hilang</title>
    <meta name="description" content="Platform pemesanan teknisi AC, WiFi, Laptop, Printer, dan Listrik. Cepat, terpercaya, langsung ke lokasi kamu.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        :root {
            --primary:    #1e40af;
            --primary-dark: #1a3f8a;
            --primary-light: #3b82f6;
            --accent:     #0ea5e9;
            --success:    #10b981;
            --warning:    #f59e0b;
            --error:      #ef4444;
            --white:      #ffffff;
            --bg-light:   #f9fafb;
            --bg-lighter: #f3f4f6;
            --dark:       #111827;
            --dark-alt:   #1f2937;
            --muted:      #6b7280;
            --muted-light:#9ca3af;
            --border:     #e5e7eb;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--dark);
            background: var(--white);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ── NAVBAR ── */
        .navbar {
            position: sticky; 
            top: 0; 
            z-index: 100;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }
        
        .nav-inner {
            max-width: 1400px; 
            margin: 0 auto; 
            padding: 0 40px;
            height: 70px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between;
        }
        
        .logo { 
            height: 40px; 
            width: auto;
        }
        
        .nav-brand { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            text-decoration: none;
            font-weight: 700;
            color: var(--dark);
            font-size: 18px;
        }
        
        .nav-links { 
            display: flex; 
            align-items: center; 
            gap: 2px;
            margin: 0 auto;
        }
        
        .nav-links a {
            text-decoration: none; 
            padding: 8px 16px; 
            color: var(--muted);
            border-radius: 6px; 
            font-size: 14px; 
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .nav-links a:hover { 
            color: var(--primary); 
            background: rgba(30, 64, 175, 0.05);
        }
        
        .nav-actions { 
            display: flex; 
            align-items: center; 
            gap: 12px;
        }
        
        .btn-ghost {
            text-decoration: none; 
            padding: 8px 16px; 
            color: var(--muted);
            font-size: 14px; 
            font-weight: 500; 
            border-radius: 6px; 
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }
        
        .btn-ghost:hover { 
            color: var(--primary);
            background: rgba(30, 64, 175, 0.05);
        }
        
        .btn-primary {
            text-decoration: none; 
            padding: 10px 24px; 
            background: var(--primary);
            color: var(--white) !important; 
            font-size: 14px; 
            font-weight: 600;
            border-radius: 8px; 
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.15);
            display: inline-flex; 
            align-items: center; 
            gap: 8px;
            border: none; 
            cursor: pointer; 
            font-family: 'Inter', sans-serif;
        }
        
        .btn-primary:hover { 
            background: var(--primary-dark); 
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.25); 
            transform: translateY(-1px);
        }
        
        .btn-secondary {
            text-decoration: none; 
            padding: 10px 24px; 
            background: var(--white);
            color: var(--primary); 
            font-size: 14px; 
            font-weight: 600; 
            border-radius: 8px;
            border: 1.5px solid var(--primary);
            transition: all 0.2s ease;
            display: inline-flex; 
            align-items: center; 
            gap: 8px;
        }
        
        .btn-secondary:hover { 
            background: rgba(30, 64, 175, 0.05);
            border-color: var(--primary-dark);
        }
        
        .btn-cta {
            text-decoration: none; 
            padding: 12px 32px; 
            background: var(--primary);
            color: var(--white); 
            font-size: 15px; 
            font-weight: 700; 
            border-radius: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.25);
            display: inline-flex; 
            align-items: center; 
            gap: 8px;
        }
        
        .btn-cta:hover { 
            background: var(--primary-dark); 
            box-shadow: 0 6px 16px rgba(30, 64, 175, 0.35); 
            transform: translateY(-2px);
        }
        
        .logout-btn {
            padding: 8px 16px; 
            background: #fee2e2; 
            color: #dc2626; 
            border: none;
            cursor: pointer; 
            font-size: 14px; 
            font-weight: 600; 
            border-radius: 6px;
            font-family: 'Inter', sans-serif; 
            transition: all 0.2s ease;
        }
        
        .logout-btn:hover { 
            background: #fecaca;
            transform: translateY(-1px);
        }
        
        .btn-dashboard {
            text-decoration: none; 
            padding: 8px 16px; 
            background: rgba(30, 64, 175, 0.1);
            color: var(--primary) !important; 
            font-size: 14px; 
            font-weight: 600;
            border-radius: 6px; 
            transition: all 0.2s ease;
        }
        
        .btn-dashboard:hover { 
            background: rgba(30, 64, 175, 0.15);
            transform: translateY(-1px);
        }

        /* ── CONTAINER ── */
        .container { max-width: 1400px; margin: 0 auto; padding: 0 40px; }

        /* ── HERO ── */
        .hero {
            position: relative; 
            min-height: 85vh;
            display: flex; 
            align-items: center; 
            overflow: hidden; 
            background: linear-gradient(135deg, var(--white) 0%, var(--bg-light) 100%);
            padding: 40px 0;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%231e40af' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
            animation: drift 25s linear infinite;
        }
        
        .hero-bg-1 {
            position: absolute; 
            top: -150px; 
            right: -100px;
            width: 700px; 
            height: 700px; 
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.12) 0%, transparent 70%);
            pointer-events: none;
            animation: pulse-blob 8s ease-in-out infinite;
        }
        
        .hero-bg-2 {
            position: absolute; 
            bottom: -100px; 
            left: -80px;
            width: 600px; 
            height: 600px; 
            border-radius: 50%;
            background: radial-gradient(circle, rgba(30, 64, 175, 0.08) 0%, transparent 70%);
            pointer-events: none;
            animation: pulse-blob-reverse 10s ease-in-out infinite;
        }

        @keyframes pulse-blob {
            0%, 100% { transform: scale(1) translate(0, 0); }
            50% { transform: scale(1.05) translate(10px, -10px); }
        }

        @keyframes pulse-blob-reverse {
            0%, 100% { transform: scale(1) translate(0, 0); }
            50% { transform: scale(1.05) translate(-10px, 10px); }
        }

        @keyframes drift {
            0% { transform: translate(0, 0); }
            100% { transform: translate(60px, 60px); }
        }
        
        .hero-grid {
            position: relative; 
            z-index: 1;
            display: grid; 
            grid-template-columns: 1.2fr 1fr; 
            gap: 80px;
            align-items: center;
        }
        
        .hero-badge {
            display: inline-flex; 
            align-items: center; 
            gap: 8px;
            padding: 8px 16px; 
            background: rgba(30, 64, 175, 0.08);
            border: 1px solid var(--primary-light); 
            border-radius: 50px;
            color: var(--primary); 
            font-size: 13px; 
            font-weight: 600; 
            margin-bottom: 24px;
        }
        
        .hero-badge-dot { 
            width: 6px; 
            height: 6px; 
            border-radius: 50%; 
            background: var(--primary);
        }
        
        .hero-title { 
            font-size: 56px; 
            font-weight: 800; 
            line-height: 1.15; 
            letter-spacing: -1px; 
            color: var(--dark); 
            margin-bottom: 24px;
        }
        
        .hero-title .gradient {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--accent) 100%);
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent; 
            background-clip: text;
        }
        
        .hero-desc { 
            font-size: 17px; 
            color: var(--muted); 
            line-height: 1.8; 
            margin-bottom: 40px; 
            max-width: 520px;
        }
        
        .hero-actions { 
            display: flex; 
            gap: 16px; 
            flex-wrap: wrap; 
            margin-bottom: 48px;
        }
        
        .hero-trust { 
            display: flex; 
            flex-wrap: wrap; 
            gap: 32px;
        }
        
        .trust-item { 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            font-size: 14px; 
            color: var(--dark); 
            font-weight: 500;
        }
        
        .trust-icon {
            width: 32px; 
            height: 32px; 
            border-radius: 8px; 
            background: rgba(30, 64, 175, 0.1);
            display: flex; 
            align-items: center; 
            justify-content: center; 
            flex-shrink: 0;
        }
        
        .trust-icon svg { 
            width: 16px; 
            height: 16px;
            color: var(--primary);
        }

        /* hero visual */
        .hero-visual { 
            position: relative;
        }
        
        .hero-img { 
            width: 100%; 
            aspect-ratio: 16/12; 
            border-radius: 16px; 
            object-fit: cover; 
            display: block; 
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .float-card {
            position: absolute; 
            background: var(--white); 
            border: 1px solid var(--border);
            border-radius: 12px; 
            padding: 12px 16px; 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            display: flex; 
            align-items: center; 
            gap: 10px;
            animation: float 6s ease-in-out infinite;
        }
        
        .float-card-1 { top: 20px; left: -30px; animation-delay: 0s; }
        .float-card-2 { top: 100px; right: -40px; animation-delay: 2s; }
        .float-card-3 { bottom: 60px; left: -30px; animation-delay: 4s; }
        
        @keyframes float { 
            0%, 100% { transform: translateY(0); } 
            50% { transform: translateY(-12px); } 
        }
        
        .fc-icon {
            width: 36px; 
            height: 36px; 
            border-radius: 8px;
            display: flex; 
            align-items: center; 
            justify-content: center; 
            flex-shrink: 0;
        }
        
        .fc-icon svg { 
            width: 18px; 
            height: 18px;
        }
        
        .fc-icon-green { background: #f0fdf4; }
        .fc-icon-green svg { stroke: var(--success); }
        .fc-icon-blue  { background: rgba(30, 64, 175, 0.1); }
        .fc-icon-blue svg { stroke: var(--primary); }
        .fc-icon-amber { background: #fffbeb; }
        .fc-icon-amber svg { stroke: var(--warning); fill: var(--warning); }
        
        .fc-text strong { 
            display: block; 
            font-size: 13px; 
            font-weight: 700; 
            color: var(--dark);
        }
        
        .fc-text span { 
            display: block; 
            font-size: 11px; 
            color: var(--muted); 
            margin-top: 2px;
        }

        /* ── SECTION SHARED ── */
        section { padding: 80px 0; }
        
        .section-label {
            display: inline-block; 
            padding: 6px 14px; 
            background: rgba(30, 64, 175, 0.08);
            color: var(--primary); 
            font-size: 11.5px; 
            font-weight: 700;
            text-transform: uppercase; 
            letter-spacing: 1.2px; 
            border-radius: 50px; 
            margin-bottom: 20px;
        }
        
        .section-title { 
            font-size: 40px; 
            font-weight: 800; 
            letter-spacing: -0.8px; 
            color: var(--dark); 
            line-height: 1.25; 
            margin-bottom: 16px;
        }
        
        .section-title .gradient {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--accent) 100%);
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent; 
            background-clip: text;
        }
        
        .section-sub { 
            font-size: 16px; 
            color: var(--muted); 
            line-height: 1.75; 
            max-width: 580px; 
            margin: 0 auto;
        }
        
        .text-center { 
            text-align: center;
        }

        /* ── SERVICES ── */
        .services { 
            background: var(--bg-light);
        }
        
        .services-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); 
            gap: 24px; 
            margin-top: 56px;
        }
        
        .service-card {
            background: var(--white); 
            border: 1px solid var(--border); 
            border-radius: 12px;
            padding: 24px; 
            transition: all 0.3s ease;
            cursor: pointer; 
            position: relative; 
            overflow: hidden;
        }

        .service-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        
        .service-card::before {
            content: ''; 
            position: absolute; 
            inset: 0;
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.05), transparent 60%);
            opacity: 0; 
            transition: opacity 0.3s ease;
        }
        
        .service-card:hover {
            border-color: var(--primary); 
            box-shadow: 0 8px 24px rgba(30, 64, 175, 0.12); 
            transform: translateY(-6px);
        }

        .service-card:hover::after {
            transform: scaleX(1);
        }
        
        .service-card:hover::before { 
            opacity: 1;
        }
        
        .service-card-inner { 
            position: relative; 
            z-index: 1;
        }
        
        .svc-img-wrap { 
            width: 100%; 
            height: 140px; 
            border-radius: 8px; 
            overflow: hidden; 
            margin-bottom: 20px; 
            position: relative;
        }
        
        .svc-img-wrap img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            transition: transform 0.4s ease;
        }
        
        .service-card:hover .svc-img-wrap img { 
            transform: scale(1.08);
        }
        
        .svc-img-overlay { 
            position: absolute; 
            inset: 0; 
            background: linear-gradient(to top, rgba(17, 24, 39, 0.3) 0%, transparent 60%);
        }
        
        .svc-name { 
            font-size: 17px; 
            font-weight: 700; 
            color: var(--dark); 
            margin-bottom: 8px;
        }
        
        .svc-desc { 
            font-size: 13px; 
            color: var(--muted); 
            line-height: 1.65; 
            margin-bottom: 18px;
        }
        
        .svc-price { 
            font-size: 14px; 
            font-weight: 700; 
            color: var(--primary);
        }


        /* ── HOW IT WORKS ── */
        .how { 
            background: var(--white);
        }
        
        .steps-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
            gap: 32px; 
            margin-top: 60px; 
            position: relative;
        }
        
        .step {
            text-align: center; 
            position: relative; 
            padding: 0 12px;
            animation: slideUp 0.6s ease backwards;
        }

        .step:nth-child(1) { animation-delay: 0s; }
        .step:nth-child(2) { animation-delay: 0.1s; }
        .step:nth-child(3) { animation-delay: 0.2s; }
        .step:nth-child(4) { animation-delay: 0.3s; }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .step:not(:last-child)::after {
            display: none;
        }
        
        .step-circle {
            width: 80px; 
            height: 80px; 
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            display: flex; 
            align-items: center; 
            justify-content: center;
            margin: 0 auto 24px; 
            position: relative; 
            z-index: 1;
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.2);
            transition: all 0.3s ease;
        }
        
        .step:hover .step-circle { 
            transform: translateY(-6px) scale(1.05); 
            box-shadow: 0 10px 30px rgba(30, 64, 175, 0.3);
        }
        
        .step-circle svg { 
            width: 32px; 
            height: 32px; 
            fill: none; 
            stroke: white; 
            stroke-width: 2; 
            stroke-linecap: round; 
            stroke-linejoin: round;
        }
        
        .step-badge {
            position: absolute; 
            top: -12px; 
            right: 50%;
            transform: translateX(50%);
            width: 28px; 
            height: 28px; 
            border-radius: 50%; 
            background: var(--accent);
            color: var(--white); 
            font-size: 12px; 
            font-weight: 800;
            display: flex; 
            align-items: center; 
            justify-content: center; 
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.15);
        }
        
        .step-label { 
            font-size: 16px; 
            font-weight: 700; 
            color: var(--dark); 
            margin-bottom: 10px;
        }
        
        .step-desc { 
            font-size: 13px; 
            color: var(--muted); 
            line-height: 1.7;
        }

        /* ── WHY FIXNOW ── */
        .why { 
            background: var(--bg-light);
        }
        
        .why-grid { 
            display: grid; 
            grid-template-columns: 1fr 1.1fr; 
            gap: 80px; 
            align-items: start;
        }
        
        .why-img-wrap { 
            position: relative;
            order: 2;
        }
        
        .why-img { 
            width: 100%; 
            aspect-ratio: 4/3; 
            object-fit: cover; 
            border-radius: 12px; 
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.1);
        }
        
        .why-img-badge {
            position: absolute; 
            bottom: -30px; 
            right: -20px; 
            background: var(--white);
            border: 1px solid var(--border); 
            border-radius: 12px; 
            padding: 16px 20px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }
        
        .why-img-badge strong { 
            display: block; 
            font-size: 24px; 
            font-weight: 800; 
            color: var(--primary);
        }
        
        .why-img-badge span { 
            font-size: 12px; 
            color: var(--muted);
        }
        
        .why-features { 
            display: flex; 
            flex-direction: column; 
            gap: 28px; 
            margin-top: 0;
            order: 1;
        }
        
        .why-feat { 
            display: flex; 
            gap: 18px;
            padding: 16px;
            border-radius: 10px;
            background: var(--white);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .why-feat:hover {
            border-color: var(--primary-light);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.1);
            transform: translateX(4px);
        }
        
        .feat-icon {
            width: 48px; 
            height: 48px; 
            border-radius: 10px; 
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, rgba(14, 165, 233, 0.05) 100%);
            display: flex; 
            align-items: center; 
            justify-content: center; 
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.08);
            transition: all 0.3s ease;
        }

        .why-feat:hover .feat-icon {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.2) 0%, rgba(14, 165, 233, 0.1) 100%);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.15);
        }
        
        .feat-icon svg { 
            width: 22px; 
            height: 22px; 
            stroke: var(--primary); 
            fill: none; 
            stroke-width: 2; 
            stroke-linecap: round; 
            stroke-linejoin: round;
        }
        
        .feat-text h4 { 
            font-size: 15px; 
            font-weight: 700; 
            color: var(--dark); 
            margin-bottom: 6px;
        }
        
        .feat-text p { 
            font-size: 13px; 
            color: var(--muted); 
            line-height: 1.7;
        }

        /* ── CTA BANNER ── */
        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 100px 0; 
            text-align: center; 
            position: relative; 
            overflow: hidden;
            border-radius: 16px;
            margin: 0 40px;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            animation: drift 25s linear infinite;
            pointer-events: none;
        }
        
        .cta-section > .cta-blob-1 {
            position: absolute; 
            top: -100px; 
            right: -100px; 
            width: 500px; 
            height: 500px; 
            border-radius: 50%; 
            background: rgba(255, 255, 255, 0.08);
            animation: blob-float 8s ease-in-out infinite;
            z-index: 0;
        }
        
        .cta-section > .cta-blob-2 {
            position: absolute; 
            bottom: -80px; 
            left: -80px; 
            width: 400px; 
            height: 400px; 
            border-radius: 50%; 
            background: rgba(255, 255, 255, 0.05);
            animation: blob-float-reverse 10s ease-in-out infinite;
            z-index: 0;
        }

        @keyframes blob-float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, -30px); }
        }

        @keyframes blob-float-reverse {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-30px, 30px); }
        }
        
        .cta-content { 
            position: relative; 
            z-index: 1;
        }
        
        .cta-section h2 { 
            font-size: 44px; 
            font-weight: 800; 
            color: var(--white); 
            letter-spacing: -0.8px; 
            margin-bottom: 16px;
        }
        
        .cta-section h2 span { 
            color: var(--accent);
        }
        
        .cta-section p { 
            font-size: 16px; 
            color: rgba(255, 255, 255, 0.85); 
            margin-bottom: 40px; 
            max-width: 520px; 
            margin-left: auto; 
            margin-right: auto;
            line-height: 1.8;
        }
        
        .btn-cta-light {
            display: inline-flex; 
            align-items: center; 
            gap: 8px;
            text-decoration: none; 
            padding: 12px 32px; 
            background: var(--white);
            color: var(--primary); 
            font-size: 15px; 
            font-weight: 700; 
            border-radius: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .btn-cta-light:hover { 
            background: var(--bg-light); 
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        /* ── FOOTER ── */
        footer { 
            background: var(--dark-alt); 
            color: var(--white); 
            padding: 64px 0 0;
            margin-top: 80px;
        }
        
        .footer-grid { 
            display: grid; 
            grid-template-columns: 2fr 1fr 1fr 1.5fr; 
            gap: 48px; 
            padding-bottom: 48px; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .footer-brand {
            display: flex;
            flex-direction: column;
        }
        
        .footer-logo { 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            margin-bottom: 16px; 
            text-decoration: none;
        }
        
        .footer-logo-icon {
            width: 36px; 
            height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 8px; 
            display: flex; 
            align-items: center; 
            justify-content: center;
        }
        
        .footer-logo-icon svg { 
            width: 20px; 
            height: 20px; 
            stroke: white; 
            fill: none; 
            stroke-width: 2; 
            stroke-linecap: round; 
            stroke-linejoin: round;
        }
        
        .footer-logo-name { 
            font-size: 18px; 
            font-weight: 800; 
            color: var(--white);
        }
        
        .footer-logo-name span { 
            color: var(--accent);
        }
        
        .footer-tagline { 
            font-size: 13px; 
            color: rgba(255, 255, 255, 0.6); 
            line-height: 1.8; 
            max-width: 320px; 
            margin-bottom: 24px;
        }
        
        .footer-contact { 
            display: flex; 
            flex-direction: column; 
            gap: 10px;
        }
        
        .footer-contact a {
            text-decoration: none; 
            font-size: 13px; 
            color: rgba(255, 255, 255, 0.6);
            display: flex; 
            align-items: center; 
            gap: 8px; 
            transition: color 0.2s ease;
        }
        
        .footer-contact a:hover { 
            color: var(--accent);
        }
        
        .footer-contact a svg { 
            width: 16px; 
            height: 16px; 
            stroke: currentColor; 
            fill: none; 
            stroke-width: 2; 
            stroke-linecap: round; 
            stroke-linejoin: round; 
            flex-shrink: 0;
        }
        
        .footer-col h4 { 
            font-size: 12px; 
            font-weight: 700; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            color: var(--white); 
            margin-bottom: 20px;
        }
        
        .footer-col ul { 
            list-style: none; 
            display: flex; 
            flex-direction: column; 
            gap: 12px;
        }
        
        .footer-col ul li { 
            list-style: none;
        }
        
        .footer-col ul a { 
            text-decoration: none; 
            font-size: 13px; 
            color: rgba(255, 255, 255, 0.6); 
            transition: color 0.2s ease;
        }
        
        .footer-col ul a:hover { 
            color: var(--accent);
        }
        
        .footer-cta-col p { 
            font-size: 13px; 
            color: rgba(255, 255, 255, 0.6); 
            line-height: 1.8; 
            margin-bottom: 20px;
        }
        
        .footer-bottom { 
            padding: 24px 0; 
            display: flex; 
            align-items: center; 
            justify-content: space-between;
        }
        
        .footer-bottom p { 
            font-size: 12px; 
            color: rgba(255, 255, 255, 0.4);
        }
        
        .footer-bottom-links { 
            display: flex; 
            gap: 24px;
        }
        
        .footer-bottom-links a { 
            text-decoration: none; 
            font-size: 12px; 
            color: rgba(255, 255, 255, 0.4); 
            transition: color 0.2s ease;
        }
        
        .footer-bottom-links a:hover { 
            color: rgba(255, 255, 255, 0.7);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .hero-grid { 
                grid-template-columns: 1fr; 
                gap: 40px;
            }
            
            .hero-visual { 
                display: none;
            }
            
            .hero-title { 
                font-size: 44px;
            }
            
            .steps-grid { 
                grid-template-columns: repeat(2, 1fr);
            }
            
            .why-grid { 
                grid-template-columns: 1fr;
                gap: 40px;
            }
            
            .why-img-wrap { 
                display: none;
            }
            
            .footer-grid { 
                grid-template-columns: repeat(2, 1fr);
            }
            
            .nav-links { 
                display: none;
            }
        }
        
        @media (max-width: 768px) {
            .nav-inner { 
                padding: 0 20px;
                height: 60px;
            }
            
            .container { 
                padding: 0 20px;
            }
            
            .hero {
                min-height: 70vh;
            }
            
            .hero-title { 
                font-size: 32px;
            }
            
            .section-title { 
                font-size: 28px;
            }
            
            .steps-grid { 
                grid-template-columns: 1fr;
            }
            
            .footer-grid { 
                grid-template-columns: 1fr;
            }
            
            .services-grid { 
                grid-template-columns: repeat(2, 1fr);
            }
            
            .cta-section {
                margin: 0 20px;
                padding: 60px 20px;
            }
        }
        
        @media (max-width: 480px) {
            .nav-actions {
                gap: 8px;
            }
            
            .btn-primary, .btn-secondary, .btn-cta {
                padding: 8px 16px;
                font-size: 13px;
            }
            
            .hero-title {
                font-size: 24px;
            }
            
            .section-title {
                font-size: 22px;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
            }
            
            .hero-trust {
                gap: 16px;
            }
            
            .trust-item {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<!-- ── NAVBAR ── -->
<header class="navbar">
    <div class="nav-inner">
        <a href="/" class="nav-brand">
            <img src="{{ asset('images/logo.png') }}" alt="FixNow Logo" class="logo">
        </a>
        <nav class="nav-links">
            <a href="/">Beranda</a>
            <a href="#services">Layanan</a>
            <a href="#how">Cara Kerja</a>
        </nav>
        <div class="nav-actions">
            @auth
                @if(auth()->user()->role == 'user')
                    <a href="/orders" class="btn-ghost">My Orders</a>
                @elseif(auth()->user()->role == 'technician')
                    <a href="/technician/orders" class="btn-ghost">Incoming Orders</a>
                @endif
                @if(auth()->user()->role == 'admin')
                    <a href="/admin/dashboard" class="btn-dashboard">Dashboard</a>
                @elseif(auth()->user()->role == 'technician')
                    <a href="/technician/dashboard" class="btn-dashboard">Dashboard</a>
                @elseif(auth()->user()->role == 'user')
                    <a href="/user/dashboard" class="btn-dashboard">Profil</a>
                @endif
                <form action="/logout" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            @else
                <a href="/login" class="btn-ghost">Login</a>
                <a href="/register" class="btn-primary">Daftar Gratis
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            @endauth
        </div>
    </div>
</header>

<!-- ── HERO ── -->
<section class="hero">
    <div class="hero-bg-1"></div>
    <div class="hero-bg-2"></div>
    <div class="container">
        <div class="hero-grid">
            <!-- LEFT -->
            <div>
                <div class="hero-badge">
                    <div class="hero-badge-dot"></div>
                    Dipercaya 500+ pelanggan di Indonesia
                </div>
                <h1 class="hero-title">
                    Teknisi datang,<br>
                    <span class="gradient">masalah hilang.</span>
                </h1>
                <p class="hero-desc">
                    Platform on-demand yang menghubungkan kamu dengan teknisi profesional untuk segala kebutuhan rumah & kendaraan. Cepat, terpercaya, langsung ke lokasi kamu.
                </p>
                <div class="hero-actions">
                    @auth
                        @if(auth()->user()->role == 'user')
                            <a href="/orders/create" class="btn-cta">Pesan Teknisi Sekarang
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        @else
                            <a href="/" class="btn-cta">Buka Dashboard
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        @endif
                    @else
                        <a href="/register" class="btn-cta">Pesan Teknisi Sekarang
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#services" class="btn-secondary">Lihat Layanan</a>
                    @endauth
                </div>
                <div class="hero-trust">
                    <div class="trust-item">
                        <div class="trust-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#235a9d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        </div>
                        Respons 30 menit
                    </div>
                    <div class="trust-item">
                        <div class="trust-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#235a9d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        Garansi 7 hari
                    </div>
                    <div class="trust-item">
                        <div class="trust-icon">
                            <svg viewBox="0 0 24 24" fill="#d97706" stroke="#d97706" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                        Rating 4.8 / 500+ ulasan
                    </div>
                </div>
            </div>

            <!-- RIGHT IMAGE -->
            <div class="hero-visual">
                <img class="hero-img"
                     src="https://images.unsplash.com/photo-1621905251918-48416bd8575a?w=800&auto=format&fit=crop&q=80"
                     alt="Teknisi profesional sedang bekerja">
                <div class="float-card float-card-1">
                    <div class="fc-icon fc-icon-green">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                    </div>
                    <div class="fc-text">
                        <strong>Pekerjaan Selesai</strong>
                        <span>Servis AC tuntas dalam 45 menit</span>
                    </div>
                </div>
                <div class="float-card float-card-2">
                    <div class="fc-icon fc-icon-blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    </div>
                    <div class="fc-text">
                        <strong>Teknisi Terdekat</strong>
                        <span>4 teknisi tersedia di area kamu</span>
                    </div>
                </div>
                <div class="float-card float-card-3">
                    <div class="fc-icon fc-icon-amber">
                        <svg viewBox="0 0 24 24" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <div class="fc-text">
                        <strong>4.8 / 5.0</strong>
                        <span>Dari 500+ pelanggan puas</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── SERVICES ── -->
<section id="services" class="services">
    <div class="container">
        <div class="text-center">
            <span class="section-label">Layanan Kami</span>
            <h2 class="section-title">Perbaikan Profesional untuk<br><span class="gradient">Semua Kebutuhan</span></h2>
            <p class="section-sub">Pilih jenis perbaikan yang kamu butuhkan. Semua teknisi kami bersertifikasi dan berpengalaman.</p>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-card-inner">
                    <div class="svc-img-wrap">
                        <img src="{{ asset('images/services/ac.png') }}" alt="Service AC">
                        <div class="svc-img-overlay"></div>
                    </div>
                    <div class="svc-name">AC</div>
                    <div class="svc-desc">Perbaikan & perawatan AC semua merk. Teknisi bersertifikasi dengan peralatan lengkap.</div>
                    <div class="svc-price">Mulai Rp 150.000</div>
                </div>
            </div>
            <div class="service-card">
                <div class="service-card-inner">
                    <div class="svc-img-wrap">
                        <img src="{{ asset('images/services/wifi.png') }}" alt="Service WiFi">
                        <div class="svc-img-overlay"></div>
                    </div>
                    <div class="svc-name">WiFi</div>
                    <div class="svc-desc">Instalasi & troubleshooting jaringan WiFi. Sinyal lemah, mati total, atau setup baru.</div>
                    <div class="svc-price">Mulai Rp 100.000</div>
                </div>
            </div>
            <div class="service-card">
                <div class="service-card-inner">
                    <div class="svc-img-wrap">
                        <img src="{{ asset('images/services/laptop.png') }}" alt="Service Laptop">
                        <div class="svc-img-overlay"></div>
                    </div>
                    <div class="svc-name">Laptop</div>
                    <div class="svc-desc">Servis laptop & PC: layar rusak, keyboard, baterai, virus, hingga upgrade hardware.</div>
                    <div class="svc-price">Mulai Rp 200.000</div>
                </div>
            </div>
            <div class="service-card">
                <div class="service-card-inner">
                    <div class="svc-img-wrap">
                        <img src="{{ asset('images/services/listrik.png') }}" alt="Service Listrik">
                        <div class="svc-img-overlay"></div>
                    </div>
                    <div class="svc-name">Listrik</div>
                    <div class="svc-desc">Instalasi & perbaikan listrik rumah/kantor. Korsleting, panel, stop kontak, pasang baru.</div>
                    <div class="svc-price">Mulai Rp 125.000</div>
                </div>
            </div>
            <div class="service-card">
                <div class="service-card-inner">
                    <div class="svc-img-wrap">
                        <img src="{{ asset('images/services/mobil.png') }}" alt="Service Mobil">
                        <div class="svc-img-overlay"></div>
                    </div>
                    <div class="svc-name">Mobil</div>
                    <div class="svc-desc">Servis & perawatan kendaraan: tune up, ganti oli, AC mobil, kelistrikan, dan lainnya.</div>
                    <div class="svc-price">Mulai Rp 150.000</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── HOW IT WORKS ── -->
<section id="how" class="how">
    <div class="container">
        <div class="text-center">
            <span class="section-label">Proses</span>
            <h2 class="section-title">Bagaimana <span class="gradient">Cara Kerjanya?</span></h2>
            <p class="section-sub">Mudah dan cepat  dari pesan sampai teknisi tiba di lokasi kamu.</p>
        </div>
        <div class="steps-grid">
            <div class="step">
                <div class="step-circle">
                    <span class="step-badge">1</span>
                    <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                </div>
                <div class="step-label">Pilih Layanan & Lokasi</div>
                <div class="step-desc">Pilih jenis perbaikan dan masukkan alamatmu. Sistem kami mencari teknisi terdekat.</div>
            </div>
            <div class="step">
                <div class="step-circle">
                    <span class="step-badge">2</span>
                    <svg viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                </div>
                <div class="step-label">Konfirmasi & Jadwal</div>
                <div class="step-desc">Pilih teknisi tersedia, tentukan waktu yang cocok, dan konfirmasi dalam hitungan detik.</div>
            </div>
            <div class="step">
                <div class="step-circle">
                    <span class="step-badge">3</span>
                    <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
                </div>
                <div class="step-label">Teknisi Datang & Kerja</div>
                <div class="step-desc">Teknisi profesional tiba di lokasi, mendiagnosis masalah, dan menyelesaikan perbaikan.</div>
            </div>
            <div class="step">
                <div class="step-circle">
                    <span class="step-badge">4</span>
                    <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <div class="step-label">Bayar & Beri Ulasan</div>
                <div class="step-desc">Bayar setelah pekerjaan selesai. Beri ulasan untuk membantu teknisi kami terus berkembang.</div>
            </div>
        </div>
        <div style="text-align:center; margin-top:48px;">
            @auth
                @if(auth()->user()->role == 'user')
                    <a href="/orders/create" class="btn-cta">Pesan Teknisi Sekarang
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                @endif
            @else
                <a href="/register" class="btn-cta">Pesan Teknisi Sekarang
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            @endauth
        </div>
    </div>
</section>

<!-- ── WHY FIXNOW ── -->
<section class="why">
    <div class="container">
        <div class="why-grid">
            <div class="why-img-wrap">
                <img class="why-img"
                     src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=700&auto=format&fit=crop&q=80"
                     alt="Teknisi FixNow bekerja profesional">
                <div class="why-img-badge">
                    <strong>500+</strong>
                    <span>Pelanggan Puas</span>
                </div>
            </div>
            <div>
                <span class="section-label">Keunggulan</span>
                <h2 class="section-title" style="margin-top:8px;">Kenapa Pilih <span class="gradient">FixNow?</span></h2>
                <p style="font-size:15px; color:var(--muted); line-height:1.7; margin-bottom:8px;">
                    Kami bukan sekadar marketplace kami memastikan setiap perbaikan berjalan lancar, dari awal hingga selesai.
                </p>
                <div class="why-features">
                    <div class="why-feat">
                        <div class="feat-icon">
                            <svg viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        </div>
                        <div class="feat-text">
                            <h4>Respons Cepat</h4>
                            <p>Teknisi tiba dalam 30–60 menit setelah pemesanan dikonfirmasi, siap dengan peralatan lengkap.</p>
                        </div>
                    </div>
                    <div class="why-feat">
                        <div class="feat-icon">
                            <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div class="feat-text">
                            <h4>Teknisi Terverifikasi</h4>
                            <p>Semua teknisi melalui seleksi ketat, memiliki sertifikasi, dan rating transparan dari pelanggan.</p>
                        </div>
                    </div>
                    <div class="why-feat">
                        <div class="feat-icon">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                        </div>
                        <div class="feat-text">
                            <h4>Harga Transparan</h4>
                            <p>Estimasi biaya diberikan di awal tanpa biaya tersembunyi. Bayar setelah pekerjaan selesai.</p>
                        </div>
                    </div>
                    <div class="why-feat">
                        <div class="feat-icon">
                            <svg viewBox="0 0 24 24"><path d="M23 4v6h-6"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
                        </div>
                        <div class="feat-text">
                            <h4>Garansi 7 Hari</h4>
                            <p>Tidak puas dengan hasil perbaikan? Kami kembali dalam 7 hari tanpa biaya tambahan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── CTA BANNER ── -->
<section class="cta-section">
    <div class="cta-blob-1"></div>
    <div class="cta-blob-2"></div>
    <div class="container cta-content">
        <h2>Satu Platform untuk<br><span>Semua Kebutuhan Servis</span></h2>
        <p>Dari AC, WiFi, Laptop, hingga Ledeng dan Mobil teknisi profesional kami siap datang ke lokasi kamu, kapan pun dibutuhkan.</p>
        @auth
            @if(auth()->user()->role == 'user')
                <a href="/orders/create" class="btn-cta-light">Pesan Teknisi Sekarang
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            @endif
        @else
            <a href="/register" class="btn-cta-light">Mulai Gratis Sekarang
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        @endauth
    </div>
</section>

<!-- ── FOOTER ── -->
<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="/" class="footer-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="FixNow Logo" class="logo">
                </a>
                <p class="footer-tagline">Platform on-demand yang menghubungkan kamu dengan teknisi profesional. Cepat, terpercaya, langsung ke lokasi.</p>
                <div class="footer-contact">
                    <a href="mailto:support@fixnow.id">
                        <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        support@fixnow.id
                    </a>
                    <a href="tel:+6281918403484">
                        <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .94h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                        +62 819-1840-3484
                    </a>
                    <a href="#">
                        <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        Tangerang Selatan, Indonesia
                    </a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="#services">AC</a></li>
                    <li><a href="#services">WiFi</a></li>
                    <li><a href="#services">Laptop</a></li>
                    <li><a href="#services">Listrik</a></li>
                    <li><a href="#services">Ledeng</a></li>
                    <li><a href="#services">Mobil</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Halaman</h4>
                <ul>
                    <li><a href="/">Beranda</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#how">Cara Kerja</a></li>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Daftar</a></li>
                </ul>
            </div>
            <div class="footer-col footer-cta-col">
                <h4>Butuh Bantuan?</h4>
                <p>Dari servis rumah hingga kendaraan satu platform untuk semua kebutuhan. Pesan teknisi sekarang, kami siap datang ke lokasi kamu.</p>
                @auth
                    @if(auth()->user()->role == 'user')
                        <a href="/orders/create" class="btn-primary">Pesan Teknisi</a>
                    @endif
                @else
                    <a href="/register" class="btn-primary">Pesan Teknisi</a>
                @endauth
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} FixNow. All rights reserved.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>