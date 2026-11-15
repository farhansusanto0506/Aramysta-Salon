<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageContentController extends Controller
{
    public function edit()
    {
        $content = SiteContent::pluck('value', 'key')->toArray();
        return view('admin.content.edit', compact('content'));
    }

    public function update(Request $request)
    {
        $inputs = $request->except(['_token', '_method', 'hero_image']);

        // Simpan semua input teks
        foreach ($inputs as $key => $value) {
            SiteContent::updateOrCreate(
                ['key' => $key],
                ['section' => 'hero', 'value' => $value]
            );
        }

        // Jika ada upload gambar baru untuk Hero
        if ($request->hasFile('hero_image')) {
            $request->validate(['hero_image' => 'image|mimes:jpg,jpeg,png,webp|max:4096']);
            
            $oldImage = SiteContent::where('key', 'hero_image')->value('value');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            $path = $request->file('hero_image')->store('hero', 'public');
            SiteContent::updateOrCreate(
                ['key' => 'hero_image'],
                ['section' => 'hero', 'value' => $path, 'type' => 'image']
            );
        }

        return back()->with('success', 'Konten halaman berhasil diperbarui!');
    }
}