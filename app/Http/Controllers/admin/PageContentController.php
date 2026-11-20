<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageContentController extends Controller
{
    public function updateHeroImage(Request $request)
    {
        $request->validate([
            'hero_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $oldImage = SiteContent::where('key', 'hero_image')->value('value');
        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        $path =$request->file('hero_image')->store('hero', 'public');

        SiteContent::updateOrCreate(
            ['key' => 'hero_image'],
            ['section' => 'hero', 'value' => $path, 'type' => 'image']
        );

        return back()->with('success', 'Gambar Hero berhasil diperbarui!');
    }
}