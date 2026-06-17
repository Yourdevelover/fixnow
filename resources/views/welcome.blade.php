<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FixNow') }}</title>
    @fonts
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-[#f5f8ff] text-slate-900 antialiased">
@php
    $navLinks = [
        ['label' => 'Services', 'href' => '#services'],
        ['label' => 'How It Works', 'href' => '#process'],
        ['label' => 'Contact', 'href' => '#contact'],
    ];

    $services = [
        ['icon' => 'AC', 'title' => 'AC', 'description' => 'Perawatan, cuci, dan perbaikan AC semua merek.', 'price' => 'Mulai Rp 150K'],
        ['icon' => 'Wi', 'title' => 'WiFi', 'description' => 'Troubleshooting jaringan, instalasi router, dan setup baru.', 'price' => 'Mulai Rp 100K'],
        ['icon' => 'PC', 'title' => 'Laptop', 'description' => 'Servis laptop dan PC: hardware, software, dan upgrade.', 'price' => 'Mulai Rp 200K'],
        ['icon' => '⚡', 'title' => 'Listrik', 'description' => 'Instalasi dan perbaikan listrik rumah atau kantor.', 'price' => 'Mulai Rp 125K'],
        ['icon' => 'PR', 'title' => 'Printer', 'description' => 'Perbaikan printer, error paper jam, dan instalasi driver.', 'price' => 'Mulai Rp 100K'],
        ['icon' => 'SP', 'title' => 'Sparepart', 'description' => 'Bantu cek dan ganti komponen sesuai kebutuhan.', 'price' => 'Cek harga dulu'],
    ];

    $steps = [
        ['title' => 'Pilih layanan', 'description' => 'Tentukan masalah dan lokasi Anda.'],
        ['title' => 'Teknisi dipilih', 'description' => 'Sistem mencocokkan teknisi yang paling dekat dan tersedia.'],
        ['title' => 'Perbaikan selesai', 'description' => 'Teknisi datang dan menyelesaikan pekerjaan di tempat.'],
        ['title' => 'Bayar dan ulas', 'description' => 'Selesaikan pembayaran lalu beri rating.'],
    ];

    $benefits = [
        ['title' => 'Respons cepat', 'description' => 'Request kamu diteruskan ke teknisi yang siap berangkat.'],
        ['title' => 'Teknisi terverifikasi', 'description' => 'Profil teknisi, rating, dan riwayat kerja bisa dilihat.'],
        ['title' => 'Harga transparan', 'description' => 'Estimasi biaya tampil lebih awal, tanpa biaya samar.'],
        ['title' => 'Garansi 7 hari', 'description' => 'Ada follow-up kalau masalah yang sama muncul lagi.'],
    ];

    $stats = [
        ['value' => '500+', 'label' => 'customer terbantu'],
        ['value' => '30 menit', 'label' => 'respon awal'],
        ['value' => '4.8/5', 'label' => 'rating layanan'],
    ];

    $assetHero = null; // asset 1
    $assetAbout = null; // asset 2
    $assetBooking = null; // asset 3
@endphp

<div class="relative overflow-hidden">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-sky-200/40 blur-3xl"></div>
        <div class="absolute right-0 top-36 h-80 w-80 rounded-full bg-blue-300/30 blur-3xl"></div>
        <div class="absolute left-0 top-[38rem] h-96 w-96 rounded-full bg-indigo-200/40 blur-3xl"></div>
    </div>

    <header class="relative z-10 border-b border-white/70 bg-white/85 backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="/" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-sky-400 text-white shadow-lg shadow-blue-500/25">
                    <span class="text-lg font-black">F</span>
                </div>
                <div>
                    <p class="text-xl font-extrabold tracking-tight text-slate-950">FixNow</p>
                    <p class="text-xs text-slate-500">Service marketplace</p>
                </div>
            </a>

            <nav class="hidden items-center gap-8 text-sm font-medium text-slate-600 md:flex">
                @foreach ($navLinks as $link)
                    <a href="{{ $link['href'] }}" class="transition hover:text-blue-600">{{ $link['label'] }}</a>
                @endforeach
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="hidden rounded-full border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-700 transition hover:border-blue-200 hover:text-blue-600 sm:inline-flex">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hidden rounded-full border border-transparent px-5 py-2 text-sm font-semibold text-slate-600 transition hover:text-blue-600 sm:inline-flex">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-full bg-blue-600 px-5 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-500/25 transition hover:bg-blue-700">Book Technician</a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <main class="relative z-10">
        <section class="mx-auto max-w-7xl px-4 pb-10 pt-14 sm:px-6 lg:px-8 lg:pb-16 lg:pt-20">
            <div class="grid items-center gap-14 lg:grid-cols-2 lg:gap-12">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-blue-100 bg-white px-4 py-2 text-sm font-medium text-blue-700 shadow-sm shadow-blue-100">
                        <span class="h-2.5 w-2.5 rounded-full bg-blue-500"></span>
                        Trusted by 500+ customers across Indonesia
                    </div>

                    <h1 class="mt-7 max-w-xl text-5xl font-black leading-[1.02] tracking-tight text-slate-950 sm:text-6xl lg:text-7xl">
                        Teknisi datang,
                        <span class="block bg-gradient-to-r from-blue-700 to-sky-500 bg-clip-text text-transparent">masalah hilang</span>
                    </h1>

                    <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                        Platform on-demand yang menghubungkan Anda dengan teknisi profesional untuk AC, WiFi, laptop, listrik, dan printer. Cepat, transparan, langsung ke lokasi Anda.
                    </p>

                    <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-7 py-4 text-base font-semibold text-white shadow-xl shadow-blue-500/25 transition hover:-translate-y-0.5 hover:bg-blue-700">Buka Dashboard</a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-7 py-4 text-base font-semibold text-white shadow-xl shadow-blue-500/25 transition hover:-translate-y-0.5 hover:bg-blue-700">Pesan Teknisi Sekarang</a>
                            <a href="#services" class="inline-flex items-center justify-center rounded-2xl border border-blue-200 bg-white px-7 py-4 text-base font-semibold text-blue-700 transition hover:border-blue-300 hover:bg-blue-50">Lihat Layanan</a>
                        @endauth
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-3">
                        @foreach ($stats as $stat)
                            <div class="rounded-2xl border border-white bg-white/80 p-4 shadow-lg shadow-slate-200/50 backdrop-blur">
                                <p class="text-2xl font-black text-slate-950">{{ $stat['value'] }}</p>
                                <p class="mt-1 text-sm text-slate-500">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute -left-4 top-6 z-20 max-w-[16rem] rounded-3xl border border-white bg-white/95 px-4 py-3 shadow-2xl shadow-slate-300/40 backdrop-blur">
                        <p class="text-sm font-semibold text-slate-900">Order Selesai</p>
                        <p class="text-sm text-slate-500">AC diperbaiki dalam 45 menit</p>
                    </div>

                    <div class="absolute right-0 top-24 z-20 max-w-[16rem] rounded-3xl border border-white bg-white/95 px-4 py-3 shadow-2xl shadow-slate-300/40 backdrop-blur">
                        <p class="text-sm font-semibold text-slate-900">Teknisi Terdekat</p>
                        <p class="text-sm text-slate-500">4 teknisi tersedia di area Anda</p>
                    </div>

                    <div class="absolute bottom-10 left-6 z-20 rounded-3xl border border-white bg-white/95 px-4 py-3 shadow-2xl shadow-slate-300/40 backdrop-blur">
                        <p class="text-sm font-semibold text-slate-900">Rating 4.8</p>
                        <p class="text-sm text-slate-500">Dari 500+ pelanggan puas</p>
                    </div>

                    <div class="overflow-hidden rounded-[2rem] border border-white bg-slate-900 shadow-[0_30px_90px_rgba(15,23,42,0.22)]">
                        @if ($assetHero)
                            <img src="{{ $assetHero }}" alt="Asset 1" class="h-[34rem] w-full object-cover">
                        @else
                            <div class="relative flex h-[34rem] items-center justify-center bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.30),_transparent_28%),linear-gradient(135deg,_#0f172a,_#0b4aa2_45%,_#0ea5e9)] p-8">
                                <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.04)_1px,transparent_1px)] bg-[size:42px_42px]"></div>
                                <div class="relative grid h-full w-full place-items-center rounded-[1.75rem] border border-white/15 bg-white/5 p-6">
                                    <div class="text-center text-white/90">
                                        <p class="text-sm font-semibold uppercase tracking-[0.4em] text-white/70">Asset 1</p>
                                        <p class="mt-4 text-4xl font-black sm:text-5xl">Ganti gambar hero di sini</p>
                                        <p class="mt-3 text-sm text-white/75">Isi dengan foto teknisi, ilustrasi layanan, atau promo utama.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-16">
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex rounded-full bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-blue-700">Layanan Kami</div>
                <h2 class="mt-5 text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">Perbaikan profesional untuk semua kebutuhan</h2>
                <p class="mt-4 text-lg leading-8 text-slate-600">Pilih jenis perbaikan yang kamu butuhkan. Semua teknisi kami siap membantu dengan alur yang jelas.</p>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($services as $service)
                    <article class="group rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60 transition hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-200/80">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-xl font-black text-blue-600 group-hover:bg-blue-600 group-hover:text-white">
                            {{ $service['icon'] }}
                        </div>
                        <h3 class="mt-5 text-2xl font-bold text-slate-950">{{ $service['title'] }}</h3>
                        <p class="mt-3 min-h-16 text-slate-600">{{ $service['description'] }}</p>
                        <div class="mt-6 flex items-center justify-between gap-4">
                            <p class="text-sm font-semibold text-blue-600">{{ $service['price'] }}</p>
                            @auth
                                <a href="{{ url('/orders/create') }}" class="text-sm font-semibold text-slate-600 transition hover:text-blue-600">Pesan →</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 transition hover:text-blue-600">Pesan →</a>
                            @endauth
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="process" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-20">
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex rounded-full bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-blue-700">Proses</div>
                <h2 class="mt-5 text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">Bagaimana cara kerjanya</h2>
                <p class="mt-4 text-lg leading-8 text-slate-600">Alurnya singkat: pilih layanan, tunggu teknisi, lalu selesaikan dengan aman.</p>
            </div>

            <div class="mt-14 grid gap-6 lg:grid-cols-4">
                @foreach ($steps as $index => $step)
                    <div class="rounded-[1.75rem] border border-white bg-white p-6 shadow-lg shadow-slate-200/50">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-lg font-black text-blue-600">0{{ $index + 1 }}</div>
                        <h3 class="mt-5 text-xl font-bold text-slate-950">{{ $step['title'] }}</h3>
                        <p class="mt-3 leading-7 text-slate-600">{{ $step['description'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-7 py-4 text-base font-semibold text-white shadow-xl shadow-blue-500/25 transition hover:-translate-y-0.5 hover:bg-blue-700">Masuk Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-7 py-4 text-base font-semibold text-white shadow-xl shadow-blue-500/25 transition hover:-translate-y-0.5 hover:bg-blue-700">Pesan Teknisi Sekarang</a>
                @endauth
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-20">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                <div class="relative order-2 lg:order-1">
                    <div class="overflow-hidden rounded-[2rem] border border-white bg-white shadow-[0_30px_90px_rgba(15,23,42,0.16)]">
                        @if ($assetAbout)
                            <img src="{{ $assetAbout }}" alt="Asset 2" class="h-[32rem] w-full object-cover">
                        @else
                            <div class="flex h-[32rem] items-end bg-[linear-gradient(180deg,rgba(59,130,246,0.08),rgba(15,23,42,0.05)),radial-gradient(circle_at_top_right,_rgba(14,165,233,0.28),_transparent_28%)] p-6">
                                <div class="w-full rounded-[1.5rem] border border-slate-200 bg-white/90 p-6 shadow-lg shadow-slate-200/60">
                                    <p class="text-sm font-semibold uppercase tracking-[0.35em] text-blue-600">Asset 2</p>
                                    <p class="mt-3 text-3xl font-black text-slate-950">Ganti gambar section ini</p>
                                    <p class="mt-2 leading-7 text-slate-600">Cocok untuk foto teknisi, alat kerja, atau suasana layanan lapangan.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="order-1 lg:order-2">
                    <div class="inline-flex rounded-full bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-blue-700">Keunggulan</div>
                    <h2 class="mt-5 text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">Kenapa pilih FixNow?</h2>
                    <p class="mt-4 max-w-xl text-lg leading-8 text-slate-600">Bukan cuma marketplace. FixNow dibuat untuk bikin proses perbaikan terasa cepat, jelas, dan gampang dipantau.</p>

                    <div class="mt-10 grid gap-6 sm:grid-cols-2">
                        @foreach ($benefits as $benefit)
                            <div class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/50">
                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">✓</div>
                                <h3 class="mt-4 text-lg font-bold text-slate-950">{{ $benefit['title'] }}</h3>
                                <p class="mt-2 leading-7 text-slate-600">{{ $benefit['description'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-20">
            <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-start">
                <div class="rounded-[2rem] border border-white bg-white p-8 shadow-[0_30px_90px_rgba(15,23,42,0.12)]">
                    <div class="inline-flex rounded-full bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-blue-700">Booking</div>
                    <h2 class="mt-5 text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">Pesan teknisi sekarang</h2>
                    <p class="mt-4 text-lg leading-8 text-slate-600">Bagian ini bisa kamu pakai sebagai slot form atau CTA utama sebelum login.</p>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="text-sm font-semibold text-slate-700">Nama Lengkap</label>
                            <div class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-400">Slot input nama</div>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-700">Nomor Telepon</label>
                            <div class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-400">Slot input telepon</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="text-sm font-semibold text-slate-700">Jenis Layanan</label>
                            <div class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-400">Slot pilihan layanan</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="text-sm font-semibold text-slate-700">Deskripsi Masalah</label>
                            <div class="mt-2 min-h-28 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-400">Slot detail masalah</div>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                        @auth
                            <a href="{{ url('/orders/create') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-7 py-4 text-base font-semibold text-white shadow-xl shadow-blue-500/25 transition hover:-translate-y-0.5 hover:bg-blue-700">Lanjut Buat Order</a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-7 py-4 text-base font-semibold text-white shadow-xl shadow-blue-500/25 transition hover:-translate-y-0.5 hover:bg-blue-700">Login untuk booking</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl border border-blue-200 bg-white px-7 py-4 text-base font-semibold text-blue-700 transition hover:border-blue-300 hover:bg-blue-50">Daftar dulu</a>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-[2rem] border border-white bg-slate-950 p-8 text-white shadow-[0_30px_90px_rgba(15,23,42,0.18)]">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm uppercase tracking-[0.35em] text-sky-300">Asset 3</p>
                                <h3 class="mt-3 text-3xl font-black">Ganti visual tambahan di sini</h3>
                            </div>
                            <div class="rounded-2xl bg-white/10 px-4 py-2 text-sm font-semibold text-sky-200">Preview slot</div>
                        </div>

                        @if ($assetBooking)
                            <img src="{{ $assetBooking }}" alt="Asset 3" class="mt-6 h-60 w-full rounded-[1.5rem] object-cover">
                        @else
                            <div class="mt-6 flex h-60 items-center justify-center rounded-[1.5rem] border border-white/10 bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.24),_transparent_30%),linear-gradient(135deg,_rgba(15,23,42,0.92),_rgba(2,132,199,0.55))] p-6 text-center">
                                <p class="max-w-md text-lg leading-8 text-white/80">Kamu bisa pakai slot ini untuk foto testimonial, banner promo, atau ilustrasi teknisi.</p>
                            </div>
                        @endif
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div class="rounded-[1.5rem] border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/50">
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-600">Support</p>
                            <p class="mt-3 text-2xl font-black text-slate-950">Respon 30 menit</p>
                            <p class="mt-2 leading-7 text-slate-600">Tim kami siap bantu setelah request masuk.</p>
                        </div>
                        <div class="rounded-[1.5rem] border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/50">
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-600">Contact</p>
                            <p class="mt-3 text-2xl font-black text-slate-950">WhatsApp & Email</p>
                            <p class="mt-2 leading-7 text-slate-600">Nanti bisa kamu sambungkan ke saluran bantuan utama.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="relative z-10 border-t border-slate-200 bg-slate-950 text-slate-300">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-4 lg:px-8">
            <div>
                <a href="/" class="flex items-center gap-3 text-white">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-sky-400 font-black">F</div>
                    <span class="text-2xl font-extrabold tracking-tight">FixNow</span>
                </a>
                <p class="mt-4 max-w-xs leading-7 text-slate-400">Platform on-demand yang menghubungkan Anda dengan teknisi profesional dengan alur yang cepat dan jelas.</p>
            </div>

            <div>
                <p class="text-sm font-bold uppercase tracking-[0.3em] text-white">Layanan</p>
                <ul class="mt-4 space-y-3 text-slate-400">
                    <li>AC</li>
                    <li>WiFi</li>
                    <li>Laptop</li>
                    <li>Listrik</li>
                    <li>Printer</li>
                </ul>
            </div>

            <div>
                <p class="text-sm font-bold uppercase tracking-[0.3em] text-white">Halaman</p>
                <ul class="mt-4 space-y-3 text-slate-400">
                    <li><a href="#services" class="transition hover:text-white">Services</a></li>
                    <li><a href="#process" class="transition hover:text-white">How It Works</a></li>
                    <li><a href="#contact" class="transition hover:text-white">Contact</a></li>
                    <li><a href="{{ route('login') }}" class="transition hover:text-white">Login</a></li>
                </ul>
            </div>

            <div>
                <p class="text-sm font-bold uppercase tracking-[0.3em] text-white">Butuh Bantuan?</p>
                <p class="mt-4 leading-7 text-slate-400">Teknisi profesional siap bantu dari awal sampai selesai.</p>
                <div class="mt-6">
                    @auth
                        <a href="{{ url('/orders/create') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700">Pesan Teknisi</a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700">Pesan Teknisi</a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>