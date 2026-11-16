<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioItemController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'location_or_event' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $labels = [
            'bridal' => 'Pengantin Couture',
            'red-carpet' => 'Red Carpet & Gala',
            'editorial' => 'Editorial & Fashion',
            'soft-glam' => 'Soft Glam',
        ];

        $data['category_label'] = $labels[$data['category']] ?? 'Koleksi Ramysta';
        $data['is_featured'] = $request->has('is_featured');
        $data['image'] = $request->file('image')->store('portfolios', 'public');

        Portfolio::create($data);

        return back()->with('success', 'Karya portofolio baru berhasil ditambahkan!');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
            Storage::disk('public')->delete($portfolio->image);
        }
        $portfolio->delete();

        return back()->with('success', 'Karya portofolio dihapus.');
    }
    public function edit(Portfolio $portfolio)
{
    return view('admin.portfolios.edit', compact('portfolio'));
}

public function update(Request $request, Portfolio $portfolio)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string',
        'location_or_event' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'tags' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
    ]);

    $labels = [
        'bridal' => 'Pengantin Couture',
        'red-carpet' => 'Red Carpet & Gala',
        'editorial' => 'Editorial & Fashion',
        'soft-glam' => 'Soft Glam',
    ];

    $data['category_label'] = $labels[$data['category']] ?? 'Koleksi Ramysta';
    $data['is_featured'] = $request->has('is_featured');

    if ($request->hasFile('image')) {
        if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
            Storage::disk('public')->delete($portfolio->image);
        }
        $data['image'] = $request->file('image')->store('portfolios', 'public');
    }

    $portfolio->update($data);

    return redirect()->route('admin.portfolios.index')->with('success', 'Karya portofolio berhasil diperbarui!');
}
}