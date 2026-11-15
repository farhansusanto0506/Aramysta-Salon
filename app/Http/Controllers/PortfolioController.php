<?php

namespace App\Http\Controllers;

use App\Models\SiteContent;

class PortfolioController extends Controller
{
    public function index()
    {
        // Ambil semua data konten dalam 1 query: ['hero_title' => 'Seni Keindahan Rias', ...]
        $content = SiteContent::pluck('value', 'key')->toArray();

        return view('portfolio.index', compact('content'));
    }
}