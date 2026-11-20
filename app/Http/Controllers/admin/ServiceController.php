<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'title'      => 'required|string|max:120',
            'prices'     => 'required|string|max:500',
            'highlights' => 'required|string|max:1500',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $data['is_featured'] = $request->boolean('is_featured');

        Service::create($data);

        return back()->with('success', 'Paket layanan berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'title'      => 'required|string|max:120',
            'prices'     => 'required|string|max:500',
            'highlights' => 'required|string|max:1500',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $data['is_featured'] = $request->boolean('is_featured');

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Paket layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Layanan dihapus']);
        }

        return back()->with('success', 'Paket layanan berhasil dihapus.');
    }
}