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
        $data = $this->prepare($request, $request->validate($this->rules(imageRequired: true)));
        $data['image'] = $request->file('image')->store('portfolios', 'public');

        Portfolio::create($data);

        return back()->with('success', 'Karya portofolio baru berhasil ditambahkan!');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $this->prepare($request, $request->validate($this->rules(imageRequired: false)));

        if ($request->hasFile('image')) {
            $this->deleteImage($portfolio->image);
            $data['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolios.index')->with('success', 'Karya portofolio berhasil diperbarui!');
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->deleteImage($portfolio->image);
        $portfolio->delete();

        return back()->with('success', 'Karya portofolio dihapus.');
    }

    private function rules(bool $imageRequired): array
    {
        return [
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'location_or_event' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'image' => ($imageRequired ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }

    private function prepare(Request $request, array $data): array
    {
        $data['category_label'] = Portfolio::CATEGORIES[$data['category']] ?? 'Koleksi Ramysta';
        $data['is_featured'] = $request->has('is_featured');

        return $data;
    }

    private function deleteImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}