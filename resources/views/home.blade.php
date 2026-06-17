@extends('layouts.app')

@section('content')

<style>
    :root {
        --primary: #1e40af;
        --primary-dark: #1a3f8a;
        --primary-light: #3b82f6;
        --accent: #0ea5e9;
        --white: #ffffff;
        --bg-light: #f9fafb;
        --dark: #111827;
        --muted: #6b7280;
        --border: #e5e7eb;
        --success: #10b981;
        --warning: #f59e0b;
        --error: #ef4444;
    }

    .home-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0;
    }

    /* ─── ANIMATED HERO SECTION ─── */
    .hero-section {
        position: relative;
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 30%, #0284c7 70%, #0ea5e9 100%);
        padding: 60px 40px;
        border-radius: 0;
        color: var(--white);
        overflow: hidden;
        margin-bottom: 50px;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.1;
        animation: drift 20s linear infinite;
    }

    /* ─── DECORATIVE BLOBS ─── */
    .hero-blob-1 {
        position: absolute;
        width: 400px;
        height: 400px;
        border-radius: 45% 55% 52% 48% / 48% 45% 55% 52%;
        background: rgba(255, 255, 255, 0.08);
        top: -100px;
        right: -100px;
        animation: blob-animation 8s infinite;
        z-index: 0;
    }

    .hero-blob-2 {
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
        background: rgba(255, 255, 255, 0.05);
        bottom: -50px;
        left: -100px;
        animation: blob-animation-reverse 10s infinite;
        z-index: 0;
    }

    @keyframes blob-animation {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(50px, -50px) rotate(90deg); }
        50% { transform: translate(0, -100px) rotate(180deg); }
        75% { transform: translate(-50px, -50px) rotate(270deg); }
    }

    @keyframes blob-animation-reverse {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(-30px, 30px) rotate(-90deg); }
        50% { transform: translate(0, 60px) rotate(-180deg); }
        75% { transform: translate(30px, 30px) rotate(-270deg); }
    }

    @keyframes drift {
        0% { transform: translate(0, 0); }
        100% { transform: translate(60px, 60px); }
    }

    .hero-icon-wrapper {
        position: absolute;
        opacity: 0.1;
        color: var(--white);
        font-size: 150px;
        font-weight: 900;
        z-index: 0;
    }

    .hero-icon-1 {
        top: 10%;
        right: 5%;
        animation: float 6s ease-in-out infinite;
    }

    .hero-icon-2 {
        bottom: 15%;
        left: 5%;
        animation: float 7s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-30px); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 40px;
    }

    .hero-left {
        flex: 1;
    }

    .hero-left h1 {
        font-size: 42px;
        font-weight: 900;
        margin-bottom: 16px;
        line-height: 1.2;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        letter-spacing: -1px;
    }

    .hero-left p {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 24px;
        max-width: 450px;
        line-height: 1.6;
    }

    .hero-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 28px;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: var(--white);
        color: var(--primary);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.15);
        color: var(--white);
        border: 2px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
    }

    .hero-right {
        flex: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        align-content: start;
    }

    .stat-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 20px 16px;
        border-radius: 12px;
        text-align: center;
        animation: slideIn 0.6s ease backwards;
        position: relative;
        overflow: hidden;
    }

    .stat-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
        pointer-events: none;
    }

    .stat-badge:nth-child(1) { animation-delay: 0.1s; }
    .stat-badge:nth-child(2) { animation-delay: 0.2s; }
    .stat-badge:nth-child(3) { animation-delay: 0.3s; }
    .stat-badge:nth-child(4) { animation-delay: 0.4s; }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-badge strong {
        display: block;
        font-size: 24px;
        margin-bottom: 4px;
    }

    .stat-badge span {
        display: block;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    @media (max-width: 1024px) {
        .hero-content {
            flex-direction: column;
            gap: 30px;
        }
        .hero-right {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    /* ─── MAIN CONTENT GRID ─── */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 24px;
        margin-bottom: 40px;
    }

    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
        
        .hero-content {
            flex-direction: column;
            gap: 30px;
        }
        
        .hero-right {
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }
        
        .card-header {
            padding: 18px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .card-header a {
            align-self: flex-start;
        }
        
        .card-body {
            padding: 16px;
        }
        
        .order-item {
            flex-direction: column;
            align-items: flex-start;
            padding: 12px;
        }
        
        .order-status {
            margin-top: 8px;
            align-self: flex-start;
        }
    }

    @media (max-width: 768px) {
        .home-wrapper {
            padding: 0 12px;
        }
        
        .hero-section {
            padding: 40px 20px;
            margin-bottom: 30px;
        }
        
        .hero-left h1 {
            font-size: 28px;
        }
        
        .hero-left p {
            font-size: 14px;
        }
        
        .btn {
            font-size: 13px;
            padding: 10px 18px;
        }
        
        .hero-right {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .stat-badge {
            padding: 14px 12px;
        }
        
        .stat-badge strong {
            font-size: 18px;
        }
        
        .stat-badge span {
            font-size: 11px;
        }
        
        .card-header h2 {
            font-size: 16px;
        }
        
        .card-header a {
            font-size: 12px;
        }
        
        .order-service {
            font-size: 14px;
        }
        
        .profile-card {
            padding: 20px;
        }
        
        .profile-avatar {
            width: 56px;
            height: 56px;
            font-size: 24px;
        }
        
        .profile-name {
            font-size: 16px;
        }
        
        .menu-item {
            padding: 10px 14px;
            font-size: 12px;
        }
        
        .menu-icon {
            width: 28px;
            height: 28px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .home-wrapper {
            padding: 0 10px;
        }
        
        .hero-section {
            padding: 30px 16px;
            margin-bottom: 20px;
        }
        
        .hero-left h1 {
            font-size: 24px;
        }
        
        .hero-left p {
            font-size: 13px;
            margin-bottom: 16px;
        }
        
        .hero-buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
        
        .hero-right {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        
        .stat-badge {
            padding: 12px 10px;
        }
        
        .stat-badge strong {
            font-size: 16px;
        }
        
        .hero-status {
            gap: 12px;
        }
        
        .card {
            border-radius: 10px;
        }
        
        .card-header {
            padding: 14px;
        }
        
        .card-body {
            padding: 12px;
        }
        
        .order-item {
            padding: 10px;
            border-radius: 8px;
        }
        
        .profile-sidebar {
            gap: 14px;
        }
        
        .profile-card {
            padding: 16px;
        }
        
        .profile-detail {
            font-size: 11px;
        }
    }

    /* ─── CARDS ─── */
    .card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
    }

    body.dark-theme .card {
        background: #1e293b;
        border-color: #334155;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .card:hover {
        border-color: var(--primary-light);
        box-shadow: 0 10px 30px rgba(30, 64, 175, 0.12);
        transform: translateY(-4px);
    }

    .card:hover::before {
        opacity: 1;
    }

    .card-header {
        padding: 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    body.dark-theme .card-header {
        border-bottom-color: #334155;
    }

    .card-header h2 {
        font-size: 18px;
        font-weight: 800;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    body.dark-theme .card-header h2 {
        color: white;
    }

    .card-header a {
        font-size: 13px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .card-header a:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .card-body {
        padding: 24px;
    }

    /* ─── ORDERS GRID ─── */
    .orders-container {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 18px;
        border: 2px solid var(--border);
        border-radius: 10px;
        transition: all 0.2s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    body.dark-theme .order-item {
        border-color: #334155;
    }

    .order-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, var(--primary) 0%, var(--accent) 100%);
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .order-item:hover {
        background: var(--bg-light);
        border-color: var(--primary-light);
    }

    .order-item:hover::before {
        opacity: 1;
    }

    .order-info {
        flex: 1;
    }

    .order-service {
        font-size: 15px;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 6px;
    }

    body.dark-theme .order-service {
        color: white;
    }

    .order-date {
        font-size: 12px;
        color: var(--muted);
    }

    .order-status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        text-transform: capitalize;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.12);
        color: var(--warning);
    }

    .status-process {
        background: rgba(30, 64, 175, 0.12);
        color: var(--primary);
    }

    .status-completed {
        background: rgba(16, 185, 129, 0.12);
        color: var(--success);
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: var(--muted);
    }

    .empty-icon {
        font-size: 48px;
        margin-bottom: 12px;
    }

    /* ─── PROFILE CARD SIDEBAR ─── */
    .profile-sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .profile-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
        border-radius: 14px;
        padding: 28px;
        color: var(--white);
        position: relative;
        overflow: hidden;
        text-align: center;
        box-shadow: 0 10px 30px rgba(30, 64, 175, 0.2);
    }

    .profile-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .profile-card::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -30%;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
    }

    .profile-card:hover::before {
        transform: translate(30px, 30px);
    }

    .profile-content {
        position: relative;
        z-index: 1;
    }

    .profile-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 800;
        border: 3px solid rgba(255, 255, 255, 0.4);
        margin: 0 auto 12px;
    }

    .profile-name {
        font-size: 18px;
        font-weight: 900;
        margin-bottom: 4px;
    }

    .profile-role {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.85);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }

    .profile-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.2);
        margin: 16px 0;
    }

    .profile-detail {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 8px;
        word-break: break-all;
    }

    .profile-detail strong {
        display: block;
        font-size: 13px;
        color: var(--white);
        margin-bottom: 2px;
    }

    .btn-edit-profile {
        width: 100%;
        padding: 10px 16px;
        background: var(--white);
        color: var(--primary);
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-top: 12px;
    }

    .btn-edit-profile:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* ─── QUICK MENU ─── */
    .quick-menu {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    body.dark-theme .quick-menu {
        background: #1e293b;
        border-color: #334155;
    }

    .quick-menu::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--primary) 50%, transparent);
        opacity: 0.5;
    }

    .quick-menu-title {
        font-size: 14px;
        font-weight: 800;
        padding: 16px 20px;
        border-bottom: 1px solid var(--border);
        color: var(--dark);
        margin: 0;
        background: linear-gradient(90deg, rgba(30, 64, 175, 0.02) 0%, rgba(2, 132, 199, 0.02) 100%);
    }

    body.dark-theme .quick-menu-title {
        color: white;
        border-bottom-color: #334155;
        background: linear-gradient(90deg, rgba(30, 64, 175, 0.05) 0%, rgba(2, 132, 199, 0.05) 100%);
    }

    .menu-items {
        display: flex;
        flex-direction: column;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-bottom: 1px solid var(--border);
        text-decoration: none;
        color: var(--dark);
        font-size: 13px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    body.dark-theme .menu-item {
        color: #e2e8f0;
        border-bottom-color: #334155;
    }

    .menu-item:last-child {
        border-bottom: none;
    }

    .menu-item:hover {
        background: var(--bg-light);
        color: var(--primary);
        transform: translateX(2px);
    }

    body.dark-theme .menu-item:hover {
        background: rgba(30, 64, 175, 0.1);
        color: #3b82f6;
    }

    .menu-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        background: rgba(30, 64, 175, 0.1);
        color: var(--primary);
        flex-shrink: 0;
        transition: all 0.2s ease;
    }

    .menu-item:hover .menu-icon {
        background: var(--primary);
        color: var(--white);
        transform: scale(1.1);
    }

    .menu-item.logout {
        color: var(--error);
    }

    .menu-item.logout:hover {
        color: var(--error);
        background: rgba(239, 68, 68, 0.05);
    }

    .menu-item.logout .menu-icon {
        background: rgba(239, 68, 68, 0.1);
        color: var(--error);
    }

    .menu-item.logout:hover .menu-icon {
        background: var(--error);
        color: var(--white);
    }

    /* ─── FEATURES SECTION ─── */
    .features-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
        margin-bottom: 40px;
        margin-top: -30px;
        position: relative;
        z-index: 10;
    }

    .feature-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    body.dark-theme .feature-card {
        background: #1e293b;
        border-color: #334155;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, rgba(2, 132, 199, 0.1) 100%);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(30, 64, 175, 0.15);
        border-color: var(--primary-light);
    }

    body.dark-theme .feature-card:hover {
        box-shadow: 0 12px 24px rgba(30, 64, 175, 0.25);
    }

    .feature-card:hover::before {
        transform: translate(50px, 50px) rotate(45deg);
    }

    .feature-icon {
        font-size: 36px;
        margin-bottom: 12px;
        display: block;
    }

    .feature-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 6px;
        position: relative;
        z-index: 1;
    }

    body.dark-theme .feature-title {
        color: white;
    }

    .feature-desc {
        font-size: 12px;
        color: var(--muted);
        line-height: 1.4;
        position: relative;
        z-index: 1;
    }

    body.dark-theme .feature-desc {
        color: #cbd5e1;
    }

    @media (max-width: 768px) {
        .features-section {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .feature-card {
            padding: 14px;
        }

        .feature-icon {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .feature-title {
            font-size: 13px;
        }

        .feature-desc {
            font-size: 11px;
        }
    }

    @media (max-width: 480px) {
        .features-section {
            grid-template-columns: 1fr;
        }
    }

    /* ─── TECHNICIANS SECTION ─── */
    .technicians-section {
        margin-bottom: 40px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--border);
    }

    body.dark-theme .section-header {
        border-bottom-color: #334155;
    }

    .section-header h2 {
        font-size: 22px;
        font-weight: 800;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    body.dark-theme .section-header h2 {
        color: white;
    }

    .section-header a {
        font-size: 13px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .section-header a:hover {
        color: var(--primary-dark);
    }

    .technicians-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 40px;
    }

    .technician-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 16px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    body.dark-theme .technician-card {
        background: #1e293b;
        border-color: #334155;
    }

    .technician-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.15) 0%, rgba(2, 132, 199, 0.15) 100%);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .technician-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(30, 64, 175, 0.15);
        border-color: var(--primary-light);
    }

    body.dark-theme .technician-card:hover {
        box-shadow: 0 12px 30px rgba(30, 64, 175, 0.25);
    }

    .technician-card:hover::before {
        transform: translate(50px, 50px) rotate(45deg);
    }

    .technician-content {
        position: relative;
        z-index: 1;
    }

    .technician-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 800;
        color: white;
        border: 3px solid var(--white);
        margin: 0 auto 12px;
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2);
    }

    body.dark-theme .technician-avatar {
        border-color: #1e293b;
    }

    .technician-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    body.dark-theme .technician-name {
        color: white;
    }

    .technician-skill {
        font-size: 11px;
        color: var(--muted);
        margin-bottom: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    body.dark-theme .technician-skill {
        color: #cbd5e1;
    }

    .technician-rating {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        font-size: 12px;
        font-weight: 700;
        color: var(--warning);
    }

    @media (max-width: 768px) {
        .technicians-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 12px;
        }

        .technician-card {
            padding: 12px;
        }

        .technician-avatar {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .technician-name {
            font-size: 13px;
        }

        .technician-skill {
            font-size: 10px;
        }
    }

    @media (max-width: 480px) {
        .technicians-grid {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }

        .technician-card {
            padding: 10px;
        }

        .technician-avatar {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
    }

    /* ─── PROMO BANNER ─── */
    .tech-promo-banner {
        background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
        border-radius: 16px;
        padding: 32px 28px;
        color: white;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 32px;
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.2);
    }

    body.dark-theme .tech-promo-banner {
        box-shadow: 0 10px 40px rgba(30, 64, 175, 0.4);
    }

    .promo-decoration {
        position: absolute;
        top: -30%;
        right: -20%;
        width: 300px;
        height: 300px;
        pointer-events: none;
    }

    .promo-blob-1 {
        position: absolute;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: blob-animation 8s infinite;
    }

    .promo-blob-2 {
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        bottom: -50px;
        left: 50px;
        animation: blob-animation-reverse 10s infinite;
    }

    .promo-content {
        position: relative;
        z-index: 1;
        flex: 1;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .promo-icon {
        font-size: 64px;
        flex-shrink: 0;
    }

    .promo-text h3 {
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .promo-text p {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.95);
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .promo-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: white;
        color: var(--primary);
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .promo-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
        .tech-promo-banner {
            flex-direction: column;
            text-align: center;
            padding: 24px 20px;
            gap: 16px;
        }

        .promo-content {
            flex-direction: column;
        }

        .promo-icon {
            font-size: 48px;
        }

        .promo-text h3 {
            font-size: 18px;
        }

        .promo-text p {
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .tech-promo-banner {
            padding: 20px 16px;
        }

        .promo-icon {
            font-size: 40px;
        }

        .promo-text h3 {
            font-size: 16px;
        }

        .promo-text p {
            font-size: 12px;
        }
    }

    .service-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(30, 64, 175, 0.15);
    }

    body.dark-theme .service-box {
        background: #1e293b;
        border-color: #334155;
    }

    body.dark-theme .service-box div:nth-child(2) {
        color: white;
    }
</style>

<div class="home-wrapper">

    {{-- HERO SECTION --}}
    <div class="hero-section">
        {{-- Decorative blobs --}}
        <div class="hero-blob-1"></div>
        <div class="hero-blob-2"></div>
        
        {{-- Floating icons --}}
        <div class="hero-icon-wrapper hero-icon-1">🔧</div>
        <div class="hero-icon-wrapper hero-icon-2">⚡</div>

        <div class="hero-content">
            <div class="hero-left">
                <h1>
                    @if(auth()->user()->role === 'user')
                        Temukan Teknisi Terbaik
                    @elseif(auth()->user()->role === 'technician')
                        Kelola Pekerjaan Anda
                    @else
                        Pantau Sistem
                    @endif
                </h1>
                <p>
                    @if(auth()->user()->role === 'user')
                        Nikmati layanan teknisi profesional dengan harga terjangkau. Pesan sekarang dan rasakan perbedaannya.
                    @elseif(auth()->user()->role === 'technician')
                        Terima pesanan, kelola jadwal, dan tingkatkan rating anda. Mari berkontribusi memberikan layanan terbaik.
                    @else
                        Kelola pengguna, teknisi, layanan, dan semua aspek platform FixNow dengan mudah.
                    @endif
                </p>
                <div class="hero-buttons">
                    @if(auth()->user()->role === 'user')
                        <a href="/orders/create" class="btn btn-primary">
                            Pesan Teknisi
                        </a>
                        <a href="/orders" class="btn btn-secondary">
                            Lihat Pesanan
                        </a>
                    @elseif(auth()->user()->role === 'technician')
                        <a href="/orders/incoming" class="btn btn-primary">
                            Pesanan Masuk
                        </a>
                        <a href="/apply-technician" class="btn btn-secondary">
                            Profile Saya
                        </a>
                    @else
                        <a href="/admin/dashboard" class="btn btn-primary">
                            Admin Panel
                        </a>
                    @endif
                </div>
            </div>

            <div class="hero-right">
                <div class="stat-badge">
                    <strong>{{ $stats['total_orders'] ?? 0 }}</strong>
                    <span>Total Pesanan</span>
                </div>
                <div class="stat-badge">
                    <strong>{{ $stats['active_orders'] ?? 0 }}</strong>
                    <span>Aktif</span>
                </div>
                <div class="stat-badge">
                    <strong>{{ number_format($stats['user_rating'] ?? 0, 1) }}</strong>
                    <span>Rating</span>
                </div>
                <div class="stat-badge">
                    <strong>{{ $stats['completed_orders'] ?? 0 }}</strong>
                    <span>Selesai</span>
                </div>
            </div>
        </div>
    </div>

    {{-- FEATURES SECTION --}}
    <div class="features-section">
        <div class="feature-card">
            <span class="feature-icon">⚡</span>
            <div class="feature-title">Cepat & Mudah</div>
            <div class="feature-desc">Proses pemesanan yang sederhana hanya dalam beberapa klik</div>
        </div>
        <div class="feature-card">
            <span class="feature-icon">✓</span>
            <div class="feature-title">Teknisi Terverifikasi</div>
            <div class="feature-desc">Semua teknisi telah melewati proses verifikasi ketat</div>
        </div>
        <div class="feature-card">
            <span class="feature-icon">💰</span>
            <div class="feature-title">Harga Terjangkau</div>
            <div class="feature-desc">Nikmati layanan berkualitas dengan harga yang kompetitif</div>
        </div>
        <div class="feature-card">
            <span class="feature-icon">🛡️</span>
            <div class="feature-title">Aman & Terpercaya</div>
            <div class="feature-desc">Perlindungan pembayar dan keamanan data terjamin</div>
        </div>
    </div>

    {{-- TECHNICIANS SECTION --}}
    <div class="technicians-section">
        <div class="section-header">
            <h2>
                <span>🔧</span>
                Teknisi Terbaik Kami
            </h2>
            <a href="/orders/create">Pesan Sekarang →</a>
        </div>
        
        @if($featured_technicians->isNotEmpty() && auth()->user()->role === 'user')
            {{-- Display Real Technicians --}}
            <div class="technicians-grid">
                @foreach($featured_technicians as $technician)
                    <div class="technician-card">
                        <div class="technician-content">
                            <div class="technician-avatar">
                                {{ strtoupper(substr($technician->user->name, 0, 1)) }}
                            </div>
                            <div class="technician-name">{{ $technician->user->name }}</div>
                            <div class="technician-skill">
                                {{ $technician->specialization ?? 'Teknisi Profesional' }}
                            </div>
                            <div class="technician-rating">
                                <span>⭐</span>
                                <span>{{ number_format($technician->user->rating ?? 0, 1) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif(auth()->user()->role === 'user')
            {{-- Advertisement / Promo when no technicians --}}
            <div class="tech-promo-banner">
                <div class="promo-content">
                    <div class="promo-icon">🚀</div>
                    <div class="promo-text">
                        <h3>Bergabunglah Menjadi Mitra Kami!</h3>
                        <p>Kami sedang mencari teknisi profesional untuk memperluas jaringan layanan kami. Dapatkan penghasilan tambahan dengan bekerja sesuai jadwal Anda.</p>
                    </div>
                    <a href="/apply-technician" class="promo-btn">Daftar Sebagai Teknisi</a>
                </div>
                <div class="promo-decoration">
                    <div class="promo-blob-1"></div>
                    <div class="promo-blob-2"></div>
                </div>
            </div>

            {{-- Featured Services as Alternative --}}
            <div style="margin-top: 32px;">
                <h3 style="font-size: 16px; font-weight: 700; color: var(--dark); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                    <span>💡</span> Layanan Populer Kami
                </h3>
                <div class="services-showcase" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 12px;">
                    <div class="service-box" style="background: var(--white); border: 1px solid var(--border); border-radius: 10px; padding: 16px; text-align: center; cursor: pointer; transition: all 0.2s ease;">
                        <div style="font-size: 32px; margin-bottom: 8px;">🔌</div>
                        <div style="font-size: 13px; font-weight: 700; color: var(--dark); margin-bottom: 4px;">Perbaikan Listrik</div>
                        <div style="font-size: 11px; color: var(--muted);">Instalasi & Perbaikan</div>
                    </div>
                    <div class="service-box" style="background: var(--white); border: 1px solid var(--border); border-radius: 10px; padding: 16px; text-align: center; cursor: pointer; transition: all 0.2s ease;">
                        <div style="font-size: 32px; margin-bottom: 8px;">🔧</div>
                        <div style="font-size: 13px; font-weight: 700; color: var(--dark); margin-bottom: 4px;">Perbaikan AC</div>
                        <div style="font-size: 11px; color: var(--muted);">Maintenance & Servis</div>
                    </div>
                    <div class="service-box" style="background: var(--white); border: 1px solid var(--border); border-radius: 10px; padding: 16px; text-align: center; cursor: pointer; transition: all 0.2s ease;">
                        <div style="font-size: 32px; margin-bottom: 8px;">🚿</div>
                        <div style="font-size: 13px; font-weight: 700; color: var(--dark); margin-bottom: 4px;">Perbaikan Pipa</div>
                        <div style="font-size: 11px; color: var(--muted);">Plumbing Service</div>
                    </div>
                    <div class="service-box" style="background: var(--white); border: 1px solid var(--border); border-radius: 10px; padding: 16px; text-align: center; cursor: pointer; transition: all 0.2s ease;">
                        <div style="font-size: 32px; margin-bottom: 8px;">🪟</div>
                        <div style="font-size: 13px; font-weight: 700; color: var(--dark); margin-bottom: 4px;">Perbaikan Kaca</div>
                        <div style="font-size: 11px; color: var(--muted);">Glass & Maintenance</div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- MAIN DASHBOARD --}}
    <div class="dashboard-grid">
        
        {{-- MAIN CONTENT --}}
        <div>
            {{-- RECENT ORDERS --}}
            <div class="card">
                <div class="card-header">
                    <h2>Pesanan Terbaru</h2>
                    <a href="/orders">Lihat Semua →</a>
                </div>
                <div class="card-body">
                    @if($recent_orders->isNotEmpty())
                        <div class="orders-container">
                            @foreach($recent_orders as $order)
                                <div class="order-item">
                                    <div style="display: flex; gap: 12px; align-items: flex-start; width: 100%;">
                                        <div class="order-icon" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; flex-shrink: 0; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2);">
                                            🔧
                                        </div>
                                        <div class="order-info">
                                            <div class="order-service">{{ $order->service?->service_name }}</div>
                                            <div class="order-date">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</div>
                                        </div>
                                    </div>
                                    <span class="order-status status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">—</div>
                            <p>Belum ada pesanan</p>
                            @if(auth()->user()->role === 'user')
                                <p style="font-size: 12px; margin-top: 8px;">
                                    <a href="/orders/create" style="color: var(--primary); text-decoration: none; font-weight: 700;">Buat pesanan pertama Anda →</a>
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>


    </div>

</div>

@endsection
