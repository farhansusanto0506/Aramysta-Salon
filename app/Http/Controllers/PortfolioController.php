<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\SiteContent;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Schema;

class PortfolioController extends Controller
{
    public function index()
    {
        $content = Schema::hasTable('site_contents')
            ? SiteContent::pluck('value', 'key')->toArray()
            : [];

        $portfolios = Schema::hasTable('portfolios')
            ? Portfolio::latest()->get()
            : collect();

        $testimonials = Schema::hasTable('testimonials')
            ? Testimonial::latest()->get()
            : collect();

        return view('portfolio.index', compact('content', 'portfolios', 'testimonials'));
    }
}