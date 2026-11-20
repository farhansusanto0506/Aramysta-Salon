<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\SiteContent;
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

        $services = Schema::hasTable('services')
            ? Service::orderByDesc('is_featured')->latest()->get()
            : collect();

        $bookedSchedules = Schema::hasTable('schedules')
            ? Schedule::whereDate('booking_date', '>=', now()->toDateString())
                ->orderBy('start_time')
                ->get()
                ->groupBy('booking_date')
            : collect();

        return view('portfolio.index', compact('content', 'portfolios', 'services', 'bookedSchedules'));
    }
}