<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255|unique:services,service_name',
            'description'  => 'required|string',
            'base_price'   => 'required|integer|min:0',
        ]);

        Service::create([
            'service_name' => $request->service_name,
            'slug'         => Str::slug($request->service_name),
            'description'  => $request->description,
            'base_price'   => $request->base_price,
        ]);

        return redirect('/admin/services')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'service_name' => 'required|string|max:255|unique:services,service_name,' . $id,
            'description'  => 'required|string',
            'base_price'   => 'required|integer|min:0',
        ]);

        $service->update([
            'service_name' => $request->service_name,
            'slug'         => Str::slug($request->service_name),
            'description'  => $request->description,
            'base_price'   => $request->base_price,
        ]);

        return redirect('/admin/services')->with('success', 'Layanan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->technicians()->count() > 0) {
            return redirect('/admin/services')->with('error',
                "Layanan \"{$service->service_name}\" tidak bisa dihapus karena masih ada " .
                $service->technicians()->count() . " teknisi yang terdaftar di layanan ini."
            );
        }

        if ($service->orders()->count() > 0) {
            return redirect('/admin/services')->with('error',
                "Layanan \"{$service->service_name}\" tidak bisa dihapus karena masih memiliki riwayat order."
            );
        }

        $service->delete();
        return redirect('/admin/services')->with('success', 'Layanan berhasil dihapus.');
    }
}