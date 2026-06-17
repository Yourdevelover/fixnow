<?php

namespace App\Http\Controllers;

use App\Models\TechnicianApplication;
use App\Models\Service;
use App\Models\User;
use App\Models\Technician;
use Illuminate\Http\Request;

class TechnicianApplicationController extends Controller
{
    // Form apply — load daftar services
    public function create()
    {
        $services = Service::all();
        return view('technician_applications.create', compact('services'));
    }

    // Simpan lamaran
    public function store(Request $request)
    {
        $request->validate([
            'service_id'  => 'required|exists:services,id',
            'experience'  => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        // BUG #7 FIX: cegah user apply berkali-kali
        // Cek apakah sudah ada lamaran pending atau approved
        $alreadyApplied = TechnicianApplication::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($alreadyApplied) {
            return redirect('/user/dashboard')
                ->with('error', 'Kamu sudah memiliki lamaran yang sedang diproses atau sudah disetujui.');
        }

        $service = Service::findOrFail($request->service_id);

        TechnicianApplication::create([
            'user_id'     => auth()->id(),
            'service_id'  => $request->service_id,
            'specialist'  => $service->service_name,
            'experience'  => $request->experience,
            'description' => $request->description ?? '',
            'status'      => 'pending',
        ]);

        return redirect('/user/dashboard')
            ->with('success', 'Lamaran berhasil dikirim!');
    }

    // Daftar lamaran (admin)
    public function index()
    {
        $applications = TechnicianApplication::with('user', 'service')->get();
        return view('technician_applications.index', compact('applications'));
    }

    // Admin approve → buat Technician + ubah role user
    public function approve($id)
    {
        $application = TechnicianApplication::findOrFail($id);

        $user = User::findOrFail($application->user_id);
        $user->role = 'technician';
        $user->save();

        Technician::create([
            'user_id'             => $user->id,
            'service_id'          => $application->service_id,
            'specialist'          => $application->specialist,
            'experience'          => $application->experience,
            'rating'              => 0,
            'availability_status' => 'available',
        ]);

        $application->update(['status' => 'approved']);

        return redirect('/admin/applications')->with('success', 'Lamaran disetujui.');
    }

    // Admin reject
    public function reject($id)
    {
        $application = TechnicianApplication::findOrFail($id);
        $application->update(['status' => 'rejected']);

        return redirect('/admin/applications')->with('success', 'Lamaran ditolak.');
    }
}
