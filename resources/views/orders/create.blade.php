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
        --success:    #10b981;
        --warning:    #f59e0b;
        --error:      #ef4444;
    }

    .order-wrap {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 0 40px;
    }

    /* ── STEP INDICATOR ── */
    .step-indicator {
        display: flex;
        align-items: center;
        margin-bottom: 32px;
        gap: 0;
    }

    .step-dot {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #e5e7eb;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .step-dot.active {
        background: var(--primary);
        color: white;
        box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.15);
    }

    .step-dot.done {
        background: var(--success);
        color: white;
    }

    .step-line {
        flex: 1;
        height: 2px;
        background: #e5e7eb;
        transition: background 0.3s ease;
    }

    .step-line.done {
        background: var(--success);
    }

    .step-label {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
        margin-bottom: 28px;
    }

    .step-label span {
        font-size: 12px;
        font-weight: 600;
        color: var(--muted);
        text-align: center;
        flex: 1;
    }

    .step-label span.active {
        color: var(--primary);
    }

    /* ── STEP VISIBILITY ── */
    .step { display: none; }
    .step.active { display: block; }

    /* ── SECTION CARD ── */
    .section-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .section-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-header-icon {
        width: 40px; height: 40px;
        background: rgba(30, 64, 175, 0.1);
        border: 1px solid var(--border);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
        color: var(--primary);
    }

    .section-header-icon svg {
        width: 20px;
        height: 20px;
    }

    .section-header-text h3 {
        font-size: 15px;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 2px;
    }

    .section-header-text p {
        font-size: 13px;
        color: var(--muted);
    }

    .section-body {
        padding: 24px;
    }

    /* ── SERVICE GRID ── */
    .service-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .service-card {
        border: 2px solid var(--border);
        border-radius: 12px;
        padding: 20px;
        cursor: pointer;
        transition: all 0.2s ease;
        background: var(--white);
        position: relative;
    }

    .service-card:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 16px rgba(30, 64, 175, 0.12);
        transform: translateY(-2px);
    }

    .service-card.selected {
        border-color: var(--primary);
        background: rgba(30, 64, 175, 0.05);
        box-shadow: 0 4px 16px rgba(30, 64, 175, 0.15);
    }

    .service-card.selected::after {
        content: '✓';
        position: absolute;
        top: 12px; right: 12px;
        width: 24px; height: 24px;
        background: var(--primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
    }

    .service-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 8px;
    }

    .service-price {
        font-size: 24px;
        font-weight: 800;
        color: var(--primary);
        letter-spacing: -0.5px;
        margin-bottom: 12px;
    }

    .service-includes {
        font-size: 11px;
        color: var(--muted);
        font-weight: 700;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.7px;
    }

    .service-features {
        list-style: none;
        padding: 0;
        margin: 0 0 16px;
    }

    .service-features li {
        font-size: 13px;
        color: var(--dark);
        padding: 4px 0;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .service-features li::before {
        content: '✓';
        color: var(--primary);
        font-weight: 700;
        flex-shrink: 0;
        margin-top: 0px;
    }

    .btn-pilih {
        width: 100%;
        padding: 11px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-pilih:hover {
        background: var(--primary-dark);
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.25);
    }

    .service-card.selected .btn-pilih {
        background: var(--success);
    }

    /* ── DETAIL FORM ── */
    .form-field {
        margin-bottom: 18px;
    }

    .form-field label {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 7px;
    }

    .form-field label .required {
        color: var(--error);
    }

    .form-field label .hint {
        font-size: 11px;
        font-weight: 400;
        color: var(--muted);
        margin-left: auto;
    }

    .input-wrap {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 15px;
        pointer-events: none;
        color: var(--muted);
        display: flex;
    }

    .input-icon-top {
        position: absolute;
        left: 14px;
        top: 13px;
        font-size: 15px;
        pointer-events: none;
        color: var(--muted);
        display: flex;
    }

    .input-icon svg,
    .input-icon-top svg {
        width: 16px;
        height: 16px;
    }

    .form-field input,
    .form-field select,
    .form-field textarea {
        width: 100%;
        padding: 11px 14px 11px 40px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        color: var(--dark);
        background: var(--white);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }

    .form-field textarea {
        padding-top: 11px;
        resize: vertical;
        min-height: 100px;
    }

    .form-field input:focus,
    .form-field select:focus,
    .form-field textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    }

    .form-field input.readonly-field {
        background: var(--bg-light);
        color: var(--muted);
        cursor: default;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    /* selected service banner */
    .selected-service-banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--bg-light);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 14px 16px;
        margin-bottom: 20px;
    }

    .selected-service-banner .svc-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .selected-service-banner .svc-icon {
        width: 40px; height: 40px;
        background: var(--primary);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
        color: white;
    }

    .selected-service-banner .svc-icon svg {
        width: 20px;
        height: 20px;
    }

    .selected-service-banner .svc-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--dark);
    }

    .selected-service-banner .svc-price {
        font-size: 12px;
        color: var(--muted);
    }

    .btn-change {
        font-size: 12px;
        color: var(--primary);
        font-weight: 600;
        cursor: pointer;
        background: none;
        border: none;
        font-family: 'Inter', sans-serif;
        text-decoration: underline;
    }

    /* technician card preview */
    .technician-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border: 1px solid var(--border);
        border-radius: 8px;
        background: var(--bg-light);
        margin-top: 10px;
    }

    .technician-avatar {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 16px;
        flex-shrink: 0;
    }

    .technician-info strong {
        font-size: 14px;
        color: var(--dark);
        display: block;
    }

    .technician-info p {
        margin: 2px 0 0;
        font-size: 12px;
        color: var(--muted);
    }

    .rating-stars { color: var(--warning); }

    /* ── SECTION FOOTER ── */
    .section-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--border);
        background: var(--bg-light);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .btn-primary {
        padding: 11px 28px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(30, 64, 175, 0.2);
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        transform: translateY(-1px);
    }

    .btn-secondary {
        padding: 11px 20px;
        background: white;
        color: var(--muted);
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-secondary:hover {
        background: var(--bg-light);
        border-color: var(--primary);
        color: var(--primary);
    }

    /* ── PAYMENT (keep existing style) ── */
    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
    }

    .summary-row:last-child { border-bottom: none; }
    .summary-row .label { color: var(--muted); }
    .summary-row .value { font-weight: 600; color: var(--dark); }

    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 14px 0 0;
        margin-top: 4px;
        font-size: 16px;
        font-weight: 700;
        color: var(--dark);
        border-top: 2px solid var(--border);
    }

    .total-row .total-price {
        color: var(--primary);
        font-size: 18px;
    }

    .pay-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .pay-tab {
        flex: 1;
        padding: 10px;
        border: 1px solid var(--border);
        border-radius: 8px;
        background: white;
        font-size: 13px;
        font-weight: 600;
        color: var(--muted);
        cursor: pointer;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.2s ease;
        font-family: 'Inter', sans-serif;
    }

    .pay-tab.active {
        border-color: var(--primary);
        background: rgba(30, 64, 175, 0.05);
        color: var(--primary);
    }

    .pay-tab svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    .pay-panel { display: none; }
    .pay-panel.active { display: block; }

    .bank-info {
        background: var(--bg-light);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 16px;
    }

    .bank-info p { 
        font-size: 13px; 
        color: var(--muted); 
        margin-bottom: 4px;
    }
    
    .bank-info .account { 
        font-size: 20px; 
        font-weight: 700; 
        color: var(--dark); 
        letter-spacing: 2px; 
        margin: 6px 0 2px;
    }
    
    .bank-info .bank-name { 
        font-size: 13px; 
        font-weight: 600; 
        color: var(--primary);
    }

    .card-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .error-alert {
        background: rgba(239, 68, 68, 0.05);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: var(--error);
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 13px;
        margin-bottom: 16px;
    }

    .btn-full {
        width: 100%;
        padding: 13px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: background 0.18s, box-shadow 0.18s;
        box-shadow: 0 3px 10px rgba(35,90,157,0.25);
        margin-bottom: 10px;
    }

    .btn-full:hover { background: var(--navy-dark); }

    .btn-full-secondary {
        width: 100%;
        padding: 12px;
        background: white;
        color: #475569;
        border: 1.5px solid var(--border);
        border-radius: 9px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all 0.18s;
    }

    .btn-full-secondary:hover { background: var(--light); }

    /* ─── DARK THEME SUPPORT ─── */
    body.dark-theme .order-wrap {
        background: #0f172a;
    }

    body.dark-theme .step-dot {
        background: #334155;
        color: #cbd5e1;
    }

    body.dark-theme .step-dot.active {
        background: var(--primary);
        color: white;
        box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.25);
    }

    body.dark-theme .step-dot.done {
        background: var(--success);
        color: white;
    }

    body.dark-theme .step-line {
        background: #334155;
    }

    body.dark-theme .step-line.done {
        background: var(--success);
    }

    body.dark-theme .step-label span {
        color: #94a3b8;
    }

    body.dark-theme .step-label span.active {
        color: #3b82f6;
    }

    body.dark-theme .section-card {
        background: #1e293b;
        border-color: #334155;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    body.dark-theme .section-header {
        border-bottom-color: #334155;
    }

    body.dark-theme .section-header-icon {
        background: rgba(30, 64, 175, 0.2);
        border-color: #334155;
        color: #3b82f6;
    }

    body.dark-theme .section-header-text h3 {
        color: white;
    }

    body.dark-theme .section-header-text p {
        color: #cbd5e1;
    }

    body.dark-theme .service-card {
        background: #0f172a;
        border-color: #334155;
        color: #e2e8f0;
    }

    body.dark-theme .service-card:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 16px rgba(30, 64, 175, 0.25);
    }

    body.dark-theme .service-card.selected {
        background: rgba(30, 64, 175, 0.15);
        border-color: var(--primary);
        box-shadow: 0 4px 16px rgba(30, 64, 175, 0.25);
    }

    body.dark-theme .service-name {
        color: white;
    }

    body.dark-theme .service-price {
        color: #3b82f6;
    }

    body.dark-theme .service-includes {
        color: #94a3b8;
    }

    body.dark-theme .service-features li {
        color: #e2e8f0;
    }

    body.dark-theme .form-field label {
        color: white;
    }

    body.dark-theme .form-field label .hint {
        color: #94a3b8;
    }

    body.dark-theme .input-icon {
        color: #64748b;
    }

    body.dark-theme input,
    body.dark-theme textarea,
    body.dark-theme select {
        background: #0f172a;
        border-color: #334155;
        color: white;
    }

    body.dark-theme input::placeholder,
    body.dark-theme textarea::placeholder {
        color: #64748b;
    }

    body.dark-theme input:focus,
    body.dark-theme textarea:focus,
    body.dark-theme select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    }

    body.dark-theme .select-wrapper {
        border-color: #334155;
    }

    body.dark-theme .date-input-wrap {
        border-color: #334155;
    }

    body.dark-theme .card-info {
        background: rgba(30, 64, 175, 0.1);
        border-color: #334155;
    }

    body.dark-theme .card-info h4 {
        color: white;
    }

    body.dark-theme .card-info p {
        color: #cbd5e1;
    }

    body.dark-theme .payment-method {
        background: #0f172a;
        border-color: #334155;
    }

    body.dark-theme .payment-method:hover {
        border-color: var(--primary);
        background: rgba(30, 64, 175, 0.05);
    }

    body.dark-theme .payment-method label {
        color: white;
    }

    body.dark-theme .payment-method p {
        color: #cbd5e1;
    }

    body.dark-theme .order-summary {
        background: #1e293b;
        border-color: #334155;
    }

    body.dark-theme .order-summary h3 {
        color: white;
    }

    body.dark-theme .summary-row {
        border-bottom-color: #334155;
        color: #e2e8f0;
    }

    body.dark-theme .summary-row strong {
        color: white;
    }

    body.dark-theme .btn-full-primary {
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
    }

    body.dark-theme .btn-full-secondary {
        background: #334155;
        color: #e2e8f0;
    }

    body.dark-theme .btn-full-secondary:hover {
        background: #475569;
    }

    body.dark-theme .pay-tab {
        background: #334155;
        border-color: #475569;
        color: #cbd5e1;
    }

    body.dark-theme .pay-tab:hover {
        background: #475569;
        border-color: #64748b;
    }

    body.dark-theme .pay-tab.active {
        border-color: var(--primary);
        background: rgba(30, 64, 175, 0.15);
        color: #3b82f6;
    }

    body.dark-theme .pay-tab svg {
        color: #cbd5e1;
    }

    body.dark-theme .pay-tab.active svg {
        color: #3b82f6;
    }

    body.dark-theme .bank-info {
        background: #334155;
        border-color: #475569;
    }

    body.dark-theme .bank-info p {
        color: #cbd5e1;
    }

    body.dark-theme .bank-info .account {
        color: white;
    }

    body.dark-theme .bank-info .bank-name {
        color: #3b82f6;
    }

    body.dark-theme .section-footer {
        background: #1e293b;
        border-top-color: #334155;
    }

    body.dark-theme .selected-service-banner {
        background: #334155;
        border-color: #475569;
    }

    body.dark-theme .selected-service-banner .svc-name {
        color: white;
    }

    body.dark-theme .selected-service-banner .svc-price {
        color: #cbd5e1;
    }

    body.dark-theme .selected-service-banner .btn-change {
        color: #3b82f6;
    }

    body.dark-theme .technician-card {
        background: #334155;
        border-color: #475569;
    }

    body.dark-theme .technician-info strong {
        color: white;
    }

    body.dark-theme .technician-info p {
        color: #cbd5e1;
    }

    body.dark-theme .btn-secondary {
        background: #334155;
        border-color: #475569;
        color: #cbd5e1;
    }

    body.dark-theme .btn-secondary:hover {
        background: #475569;
        border-color: #64748b;
        color: white;
    }

    @media (max-width: 640px) {
        .service-grid { grid-template-columns: 1fr 1fr; }
        .form-row { grid-template-columns: 1fr; }
        .card-row { grid-template-columns: 1fr; }
    }
</style>

<div class="order-wrap">

    {{-- STEP INDICATOR --}}
    <div class="step-indicator">
        <div class="step-dot active" id="dot1">1</div>
        <div class="step-line" id="line1"></div>
        <div class="step-dot" id="dot2">2</div>
        <div class="step-line" id="line2"></div>
        <div class="step-dot" id="dot3">3</div>
    </div>
    <div class="step-label">
        <span class="active" id="lbl1">Pilih Layanan</span>
        <span id="lbl2">Detail & Teknisi</span>
        <span id="lbl3">Pembayaran</span>
    </div>

    {{-- ══ STEP 1: PILIH LAYANAN ══ --}}
    <div class="step active" id="step1">
        <div class="section-card">
            <div class="section-header">
                <div class="section-header-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/></svg></div>
                <div class="section-header-text">
                    <h3>Booking Layanan</h3>
                    <p>Pilih layanan yang kamu butuhkan</p>
                </div>
            </div>
            <div class="section-body">
                <div class="service-grid" id="serviceGrid">
                    @foreach($services as $service)
                    <div class="service-card" id="svc-{{ $service->id }}"
                         onclick="selectService({{ $service->id }}, '{{ addslashes($service->service_name) }}', {{ $service->base_price }})">
                        <div class="service-name">{{ $service->service_name }}</div>
                        <div class="service-price">Rp{{ number_format($service->base_price, 0, ',', '.') }}</div>
                        <div class="service-includes">Layanan meliputi:</div>
                        <ul class="service-features">
                            @php
                                $featureList = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $service->description ?? '')));
                            @endphp
                            @forelse(array_slice($featureList, 0, 4) as $f)
                                <li>{{ $f }}</li>
                            @empty
                                <li>{{ $service->description }}</li>
                            @endforelse
                        </ul>
                        <button class="btn-pilih" onclick="event.stopPropagation(); selectService({{ $service->id }}, '{{ addslashes($service->service_name) }}', {{ $service->base_price }})">
                            Pilih
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ══ STEP 2: DETAIL FORM ══ --}}
    <div class="step" id="step2">

        {{-- Selected service banner --}}
        <div class="selected-service-banner">
            <div class="svc-info">
                <div class="svc-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/></svg></div>
                <div>
                    <div class="svc-name" id="bannerSvcName">—</div>
                    <div class="svc-price" id="bannerSvcPrice">—</div>
                </div>
            </div>
            <button class="btn-change" onclick="setStep(1)">Edit Layanan</button>
        </div>

        <div class="section-card">
            <div class="section-header">
                <div class="section-header-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg></div>
                <div class="section-header-text">
                    <h3>Detail Pemesanan</h3>
                    <p>Lengkapi informasi untuk teknisi</p>
                </div>
            </div>

            <form id="orderForm">
                @csrf
                <input type="hidden" name="service_id" id="hiddenServiceId">

                <div class="section-body">

                    <div class="form-row">
                        {{-- Nama --}}
                        <div class="form-field">
                            <label>Nama <span class="required">*</span> <span class="hint">Dari akun</span></label>
                            <div class="input-wrap">
                                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg></span>
                                <input type="text" value="{{ auth()->user()->name }}" class="readonly-field" readonly>
                            </div>
                        </div>

                        {{-- No. Handphone --}}
                        <div class="form-field">
                            <label>No. Handphone <span class="required">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg></span>
                                <input type="text" name="phone" id="phone" placeholder="08xx xxxx xxxx" required>
                            </div>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="form-field">
                        <label>Alamat Rumah <span class="required">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon-top"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg></span>
                            <textarea name="address" id="address" placeholder="Jl. Contoh No. 1, RT/RW, Kelurahan, Kecamatan, Kota" style="padding-left:40px;" required></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        {{-- Tanggal Booking --}}
                        <div class="form-field">
                            <label>Tanggal Booking <span class="required">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg></span>
                                <input type="date" name="booking_date" id="bookingDate"
                                    min="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        {{-- Teknisi --}}
                        <div class="form-field">
                            <label>Pilih Teknisi <span class="required">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm7 4a2 2 0 11-4 0 2 2 0 014 0zm-2 4a4 4 0 00-3.665 2.395.75.75 0 00.416 1.005c.866.34 1.99.6 3.249.6 1.259 0 2.383-.26 3.249-.6a.75.75 0 00.416-1.005A4 4 0 009 12zm5-1.25a.75.75 0 000 1.5h2a.75.75 0 000-1.5h-2zm0 2.5a.75.75 0 000 1.5h2a.75.75 0 000-1.5h-2z" clip-rule="evenodd"/></svg></span>
                                <select name="technician_id" id="technicianSelect" required>
                                    <option value="">-- Pilih teknisi --</option>
                                    @foreach($technicians as $tech)
                                        <option
                                            value="{{ $tech->id }}"
                                            data-name="{{ $tech->user->name }}"
                                            data-specialist="{{ $tech->specialist }}"
                                            data-rating="{{ $tech->rating }}"
                                            data-exp="{{ $tech->experience }}"
                                            data-service-id="{{ $tech->service_id }}"
                                        >
                                            {{ $tech->user->name }} — {{ $tech->specialist }}
                                            (⭐ {{ $tech->rating > 0 ? $tech->rating : 'Baru' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Technician preview --}}
                    <div id="technicianPreview" style="display:none; margin-bottom:18px;">
                        <div class="technician-card">
                            <div class="technician-avatar" id="techAvatar">T</div>
                            <div class="technician-info">
                                <strong id="techName"></strong>
                                <p id="techSpecialist"></p>
                                <p><span class="rating-stars">★</span> <span id="techRating"></span> &nbsp;•&nbsp; <span id="techExp"></span> tahun pengalaman</p>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-field" style="margin-bottom:0;">
                        <label>Deskripsi Masalah <span class="required">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon-top"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.829-2.828z"/></svg></span>
                            <textarea name="problem_description" id="problem" style="padding-left:40px;" placeholder="Ceritakan masalah yang perlu diperbaiki secara detail..." required></textarea>
                        </div>
                    </div>

                </div>

                <div class="section-footer">
                    <button type="button" class="btn-secondary" onclick="setStep(1)">← Kembali</button>
                    <button type="button" class="btn-primary" onclick="goToPayment()">Lanjut ke Pembayaran →</button>
                </div>

            </form>
        </div>
    </div>

    {{-- ══ STEP 3: PAYMENT ══ --}}
    <div class="step" id="step3">

        {{-- Order Summary --}}
        <div class="section-card">
            <div class="section-header">
                <div class="section-header-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg></div>
                <div class="section-header-text">
                    <h3>Ringkasan Order</h3>
                    <p>Pastikan semua data sudah benar</p>
                </div>
            </div>
            <div class="section-body" style="padding-bottom:0;">
                <div class="summary-row">
                    <span class="label">Layanan</span>
                    <span class="value" id="sumService">—</span>
                </div>
                <div class="summary-row">
                    <span class="label">Teknisi</span>
                    <span class="value" id="sumTechnician">—</span>
                </div>
                <div class="summary-row">
                    <span class="label">Alamat</span>
                    <span class="value" id="sumAddress">—</span>
                </div>
                <div class="summary-row">
                    <span class="label">Masalah</span>
                    <span class="value" id="sumProblem">—</span>
                </div>
                <div class="total-row" style="padding-bottom:24px;">
                    <span>Total Biaya</span>
                    <span class="total-price" id="sumPrice">—</span>
                </div>
            </div>
        </div>

        {{-- Payment --}}
        <div class="section-card">
            <div class="section-header">
                <div class="section-header-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg></div>
                <div class="section-header-text">
                    <h3>Metode Pembayaran</h3>
                    <p>Pilih cara pembayaran yang kamu inginkan</p>
                </div>
            </div>
            <div class="section-body">

                <div class="pay-tabs">
                    <button type="button" class="pay-tab active" onclick="switchPayTab('transfer', this)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12h1a1 1 0 110 2H3a1 1 0 110-2h1V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg> Transfer Bank</button>
                    <button type="button" class="pay-tab" onclick="switchPayTab('card', this)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg> Kartu Kredit/Debit</button>
                    <button type="button" class="pay-tab" onclick="switchPayTab('ewallet', this)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg> E-Wallet</button>
                </div>

                {{-- Transfer Bank --}}
                <div class="pay-panel active" id="panel-transfer">
                    <div class="bank-info">
                        <p>Transfer ke rekening berikut:</p>
                        <div class="bank-name">Bank BCA</div>
                        <div class="account">1234 5678 9012</div>
                        <p>a.n. PT FixNow Indonesia</p>
                    </div>
                    <div class="form-field">
                        <label>Nama Pengirim</label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg></span>
                            <input type="text" id="senderName" placeholder="Nama lengkap pengirim">
                        </div>
                    </div>
                    <div class="form-field" style="margin-bottom:0;">
                        <label>No. Rekening Pengirim</label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12h1a1 1 0 110 2H3a1 1 0 110-2h1V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg></span>
                            <input type="text" id="senderAccount" placeholder="Contoh: 0812 3456 7890" maxlength="20">
                        </div>
                    </div>
                </div>

                {{-- Kartu --}}
                <div class="pay-panel" id="panel-card">
                    <div class="form-field">
                        <label>Nomor Kartu</label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg></span>
                            <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" oninput="formatCard(this)">
                        </div>
                    </div>
                    <div class="card-row">
                        <div class="form-field">
                            <label>Exp. Date</label>
                            <div class="input-wrap">
                                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg></span>
                                <input type="text" id="cardExp" placeholder="MM/YY" maxlength="5" oninput="formatExp(this)">
                            </div>
                        </div>
                        <div class="form-field">
                            <label>CVV</label>
                            <div class="input-wrap">
                                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd"/></svg></span>
                                <input type="text" id="cardCvv" placeholder="123" maxlength="3">
                            </div>
                        </div>
                    </div>
                    <div class="form-field" style="margin-bottom:0;">
                        <label>Nama di Kartu</label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg></span>
                            <input type="text" id="cardName" placeholder="JOHN DOE">
                        </div>
                    </div>
                </div>

                {{-- E-Wallet --}}
                <div class="pay-panel" id="panel-ewallet">
                    <div class="form-field">
                        <label>Pilih E-Wallet</label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg></span>
                            <select id="ewalletProvider">
                                <option value="">-- Pilih provider --</option>
                                <option value="gopay">GoPay</option>
                                <option value="ovo">OVO</option>
                                <option value="dana">DANA</option>
                                <option value="shopeepay">ShopeePay</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-field" style="margin-bottom:0;">
                        <label>Nomor HP Terdaftar</label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg></span>
                            <input type="text" id="ewalletPhone" placeholder="08xx xxxx xxxx" maxlength="14">
                        </div>
                    </div>
                </div>

                <div id="payError" class="error-alert" style="display:none; margin-top:16px;"></div>

            </div>
            <div class="section-footer">
                <button type="button" class="btn-secondary" onclick="setStep(2)">← Kembali</button>
                <button type="button" class="btn-primary" onclick="processPayment()" id="payBtn">Bayar Sekarang</button>
            </div>
        </div>

    </div>

    {{-- ══ STEP 4: CONFIRMING ══ --}}
    <div class="step" id="step4">
        <div class="section-card">
            <div class="section-body" style="text-align:center; padding:56px 28px;">

                <div id="processingState">
                    <div style="color:var(--navy); margin-bottom:16px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:52px;height:52px;"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg></div>
                    <h2 style="font-size:20px; font-weight:800; color:#0f172a; margin-bottom:8px;">Memproses Pembayaran...</h2>
                    <p style="color:var(--muted); font-size:14px;">Mohon tunggu sebentar</p>
                </div>

                <div id="successState" style="display:none;">
                    <div style="color:#16a34a; margin-bottom:16px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:60px;height:60px;"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg></div>
                    <h2 style="font-size:22px; font-weight:800; color:#16a34a; margin-bottom:8px;">Pembayaran Berhasil!</h2>
                    <p style="color:var(--muted); font-size:14px; margin-bottom:24px;">
                        Order kamu sudah dikonfirmasi dan teknisi akan segera menghubungi kamu.
                    </p>
                    <div style="background:#f0fdf4; border:1px solid #86efac; border-radius:10px; padding:16px; margin-bottom:24px; text-align:left;">
                        <p style="font-size:11px; color:#64748b; text-transform:uppercase; letter-spacing:0.6px; margin-bottom:4px;">ID Transaksi</p>
                        <p style="font-size:16px; font-weight:700; color:#0f172a; letter-spacing:1px;" id="txnId">—</p>
                    </div>
                    <form method="POST" action="/orders" id="realSubmitForm" style="display:none;">
                        @csrf
                        <input type="hidden" name="service_id" id="hServiceId">
                        <input type="hidden" name="technician_id" id="hTechnicianId">
                        <input type="hidden" name="address" id="hAddress">
                        <input type="hidden" name="problem_description" id="hProblem">
                        <input type="hidden" name="payment_status" value="paid">
                    </form>
                    {{-- BUG #1 FIX: tombol manual dihapus, order otomatis tersimpan via submitRealOrder() --}}
                    <p style="color:var(--muted); font-size:13px;">Mengalihkan ke halaman order kamu...</p>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
    let selectedPayTab = 'transfer';
    let selectedServiceId = null;
    let selectedServiceName = '';
    let selectedServicePrice = 0;
    let technicianData = {};

    let serviceData = {};
    @foreach($services as $s)
    serviceData[{{ $s->id }}] = { name: "{{ $s->service_name }}", price: {{ $s->base_price }} };
    @endforeach

    function selectService(id, name, price) {
        selectedServiceId   = id;
        selectedServiceName = name;
        selectedServicePrice = price;

        // Update banner
        document.getElementById('bannerSvcName').textContent  = name;
        document.getElementById('bannerSvcPrice').textContent = 'Rp ' + price.toLocaleString('id-ID');
        document.getElementById('hiddenServiceId').value = id;

        // Highlight card
        document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
        document.getElementById('svc-' + id).classList.add('selected');
        document.querySelector('#svc-' + id + ' .btn-pilih').textContent = 'Dipilih ✓';

        // Filter technician dropdown to only show technicians for this service
        filterTechniciansByService(id);

        // Go to step 2
        setTimeout(() => setStep(2), 280);
    }

    function filterTechniciansByService(serviceId) {
        const select = document.getElementById('technicianSelect');
        let hasAvailable = false;

        Array.from(select.options).forEach(opt => {
            if (!opt.value) return; // keep the placeholder option as-is

            const match = opt.dataset.serviceId == serviceId;
            opt.hidden = !match;
            opt.disabled = !match;
            if (match) hasAvailable = true;
        });

        // Reset selection & preview since the chosen technician may no longer be valid
        select.value = '';
        technicianData = {};
        document.getElementById('technicianPreview').style.display = 'none';

        // Show/hide "no technician available" message
        let emptyMsg = document.getElementById('noTechnicianMsg');
        if (!hasAvailable) {
            if (!emptyMsg) {
                emptyMsg = document.createElement('p');
                emptyMsg.id = 'noTechnicianMsg';
                emptyMsg.style.cssText = 'color:#dc2626; font-size:12.5px; margin-top:6px;';
                emptyMsg.textContent = 'Belum ada teknisi tersedia untuk layanan ini.';
                select.closest('.form-field').appendChild(emptyMsg);
            }
        } else if (emptyMsg) {
            emptyMsg.remove();
        }
    }

    document.getElementById('technicianSelect').addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        if (!opt.value) {
            document.getElementById('technicianPreview').style.display = 'none';
            return;
        }
        const name = opt.dataset.name;
        document.getElementById('techAvatar').textContent    = name.charAt(0).toUpperCase();
        document.getElementById('techName').textContent      = name;
        document.getElementById('techSpecialist').textContent = opt.dataset.specialist;
        document.getElementById('techRating').textContent    = opt.dataset.rating > 0 ? opt.dataset.rating : 'Baru';
        document.getElementById('techExp').textContent       = opt.dataset.exp;
        document.getElementById('technicianPreview').style.display = 'block';
        technicianData = { id: opt.value, name, specialist: opt.dataset.specialist };
    });

    function goToPayment() {
        const techId  = document.getElementById('technicianSelect').value;
        const address = document.getElementById('address').value.trim();
        const problem = document.getElementById('problem').value.trim();

        if (!selectedServiceId) { alert('Pilih layanan dulu.'); setStep(1); return; }
        if (!techId)   { alert('Pilih teknisi.'); return; }
        if (!address)  { alert('Isi alamat lengkap.'); return; }
        if (!problem)  { alert('Isi deskripsi masalah.'); return; }

        document.getElementById('sumService').textContent    = selectedServiceName;
        document.getElementById('sumTechnician').textContent = technicianData.name + ' (' + technicianData.specialist + ')';
        document.getElementById('sumAddress').textContent    = address;
        document.getElementById('sumProblem').textContent    = problem.length > 60 ? problem.substring(0, 60) + '...' : problem;
        document.getElementById('sumPrice').textContent      = 'Rp ' + selectedServicePrice.toLocaleString('id-ID');

        setStep(3);
    }

    function switchPayTab(tab, btn) {
        selectedPayTab = tab;
        document.querySelectorAll('.pay-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.pay-panel').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('panel-' + tab).classList.add('active');
        document.getElementById('payError').style.display = 'none';
    }

    function validatePayment() {
        if (selectedPayTab === 'transfer') {
            if (!document.getElementById('senderName').value.trim())    return 'Masukkan nama pengirim.';
            if (!document.getElementById('senderAccount').value.trim()) return 'Masukkan nomor rekening pengirim.';
        } else if (selectedPayTab === 'card') {
            const num = document.getElementById('cardNumber').value.replace(/\s/g,'');
            const exp = document.getElementById('cardExp').value;
            const cvv = document.getElementById('cardCvv').value;
            if (num.length < 16) return 'Nomor kartu tidak valid (harus 16 digit).';
            if (!/^\d{2}\/\d{2}$/.test(exp)) return 'Format exp. date salah (MM/YY).';
            if (cvv.length < 3)  return 'CVV tidak valid.';
            if (!document.getElementById('cardName').value.trim()) return 'Masukkan nama di kartu.';
        } else if (selectedPayTab === 'ewallet') {
            if (!document.getElementById('ewalletProvider').value) return 'Pilih provider e-wallet.';
            if (!document.getElementById('ewalletPhone').value.trim()) return 'Masukkan nomor HP terdaftar.';
        }
        return null;
    }

    function processPayment() {
        const error = validatePayment();
        const errEl = document.getElementById('payError');
        if (error) { errEl.textContent = error; errEl.style.display = 'block'; return; }
        errEl.style.display = 'none';

        setStep(4);
        document.getElementById('processingState').style.display = 'block';
        document.getElementById('successState').style.display    = 'none';

        setTimeout(function() {
            document.getElementById('processingState').style.display = 'none';
            document.getElementById('successState').style.display    = 'block';
            const txn = 'FN-' + Date.now().toString(36).toUpperCase() + '-' + Math.random().toString(36).substr(2,5).toUpperCase();
            document.getElementById('txnId').textContent = txn;

            // BUG #1 FIX: auto-submit order ke DB setelah animasi sukses,
            // tidak menunggu user klik tombol manual
            submitRealOrder();
        }, 1500);
    }

    function submitRealOrder() {
        // BUG #2 FIX: guard — pastikan semua data kritis sudah terisi sebelum submit
        if (!selectedServiceId) {
            alert('Terjadi kesalahan: layanan belum dipilih. Silakan ulangi dari awal.');
            setStep(1);
            return;
        }
        const techId  = document.getElementById('technicianSelect').value;
        const address = document.getElementById('address').value.trim();
        const problem = document.getElementById('problem').value.trim();
        if (!techId || !address || !problem) {
            alert('Terjadi kesalahan: data order tidak lengkap. Silakan ulangi dari awal.');
            setStep(2);
            return;
        }

        document.getElementById('hServiceId').value    = selectedServiceId;
        document.getElementById('hTechnicianId').value = techId;
        document.getElementById('hAddress').value      = address;
        document.getElementById('hProblem').value      = problem;
        document.getElementById('realSubmitForm').submit();
    }

    function setStep(n) {
        // step4 is the confirming state
        const totalSteps = 4;
        document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
        document.getElementById('step' + n).classList.add('active');

        // Update dots (only 3 visible dots: 1=pilih layanan, 2=detail, 3=payment)
        const dotMap = {1:1, 2:2, 3:3, 4:3};
        const activeDot = dotMap[n];

        for (let i = 1; i <= 3; i++) {
            const dot  = document.getElementById('dot' + i);
            const line = i < 3 ? document.getElementById('line' + i) : null;
            const lbl  = document.getElementById('lbl' + i);

            if (i < activeDot) {
                dot.classList.add('done'); dot.classList.remove('active');
                dot.textContent = '✓';
                if (line) line.classList.add('done');
                if (lbl)  { lbl.classList.remove('active'); }
            } else if (i === activeDot) {
                dot.classList.add('active'); dot.classList.remove('done');
                dot.textContent = i;
                if (line) line.classList.remove('done');
                if (lbl)  lbl.classList.add('active');
            } else {
                dot.classList.remove('active', 'done');
                dot.textContent = i;
                if (line) line.classList.remove('done');
                if (lbl)  lbl.classList.remove('active');
            }
        }
    }

    function formatCard(input) {
        let val = input.value.replace(/\D/g, '').substring(0, 16);
        input.value = val.match(/.{1,4}/g)?.join(' ') || val;
    }

    function formatExp(input) {
        let val = input.value.replace(/\D/g, '').substring(0, 4);
        if (val.length >= 3) val = val.substring(0,2) + '/' + val.substring(2);
        input.value = val;
    }
</script>

@endsection