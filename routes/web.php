<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TechnicianApplicationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

// Public & Home routing
Route::get('/', function () {
    // If user is authenticated, show home dashboard
    if (auth()->check()) {
        return redirect('/home');
    }
    // Otherwise show landing page
    return view('landing');
});

Route::middleware(['auth'])->group(function () {

    // Home page for authenticated users
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Redirect & Dashboard
    Route::get('/redirect', [DashboardController::class, 'redirect'])->name('dashboard.redirect');
    Route::get('/dashboard', fn() => redirect('/redirect'))->name('dashboard');

    // Dashboard per role — dilindungi middleware role masing-masing
    // BUG #10 FIX: sebelumnya tidak ada role guard, user biasa bisa akses /admin/dashboard
    Route::get('/admin/dashboard',      [DashboardController::class, 'adminDashboard'])->middleware('role:admin');
    Route::get('/technician/dashboard', [DashboardController::class, 'technicianDashboard'])->middleware('role:technician');
    Route::get('/user/dashboard',       [DashboardController::class, 'userDashboard'])->middleware('role:user');

    // Profile — semua role boleh edit profil sendiri
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ─── ORDERS ─────────────────────────────────────────────
    // Index bisa diakses user & teknisi (controller handle tampilan per role)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // BUG #5 FIX: route khusus user — hanya role 'user' yang boleh buat order
    Route::middleware(['role:user'])->group(function () {
        Route::get('/orders/create',   [OrderController::class, 'create']);
        Route::get('/orders/history',  [OrderController::class, 'history']);
        Route::post('/orders/preview', [OrderController::class, 'preview']);
        Route::post('/orders',         [OrderController::class, 'store']);

        // Apply jadi teknisi
        Route::get('/apply-technician',  [TechnicianApplicationController::class, 'create']);
        Route::post('/apply-technician', [TechnicianApplicationController::class, 'store']);

        // Reviews hanya bisa dibuat oleh user (pemilik order)
        Route::get('/reviews/{orderId}/create', [ReviewController::class, 'create']);
        Route::post('/reviews',                 [ReviewController::class, 'store']);
    });

    // BUG #5 FIX: route khusus teknisi — hanya role 'technician' yang boleh akses
    Route::middleware(['role:technician'])->group(function () {
        Route::get('/technician/orders',   [OrderController::class, 'incomingOrders']);
        Route::post('/orders/{id}/accept', [OrderController::class, 'acceptOrder']);
        Route::get('/orders/{id}/status',  [OrderController::class, 'editStatus']);
        Route::put('/orders/{id}/status',  [OrderController::class, 'updateStatus']);
    });

    // ─── ADMIN ROUTES ───────────────────────────────────────
    // BUG #10 FIX: semua route admin dilindungi middleware role:admin
    Route::middleware(['role:admin'])->group(function () {

        // Admin Users CRUD
        Route::get('/admin/users',                [UserController::class, 'index']);
        Route::get('/admin/users/create',         [UserController::class, 'create']);
        Route::post('/admin/users',               [UserController::class, 'store']);
        Route::get('/admin/users/{user}/edit',    [UserController::class, 'edit']);
        Route::put('/admin/users/{user}',         [UserController::class, 'update']);
        Route::delete('/admin/users/{user}',      [UserController::class, 'destroy']);

        // Admin Dashboard & Monitoring
        Route::get('/admin/orders', [DashboardController::class, 'adminOrders']);

        // Admin Services
        Route::get('/admin/services',                    [ServiceController::class, 'index']);
        Route::get('/admin/services/create',             [ServiceController::class, 'create']);
        Route::post('/admin/services',                   [ServiceController::class, 'store']);
        Route::get('/admin/services/{service}/edit',     [ServiceController::class, 'edit']);
        Route::put('/admin/services/{service}',          [ServiceController::class, 'update']);
        Route::delete('/admin/services/{service}',       [ServiceController::class, 'destroy']);

        // Admin Technician Monitoring
        Route::get('/admin/technicians',                               [TechnicianController::class, 'monitoring']);
        Route::get('/admin/technicians/create',                        [TechnicianController::class, 'create']);
        Route::post('/admin/technicians',                              [TechnicianController::class, 'store']);
        Route::post('/admin/technicians/{id}/toggle-availability',     [TechnicianController::class, 'toggleAvailability']);

        // Admin Applications
        Route::get('/admin/applications',                  [TechnicianApplicationController::class, 'index']);
        Route::put('/admin/applications/{id}/approve',     [TechnicianApplicationController::class, 'approve']);
        Route::put('/admin/applications/{id}/reject',      [TechnicianApplicationController::class, 'reject']);

    });

});

require __DIR__.'/auth.php';
