<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::whereDate('booking_date', '>=', now()->toDateString())
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->get();

        return view('admin.schedules.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_date' => 'required|date|unique:schedules,booking_date',
            'start_time'   => 'required|string|size:5',
            'note'         => 'nullable|string|max:100',
        ], [
            'booking_date.unique' => 'Tanggal tersebut sudah ditandai penuh.',
        ]);

        Schedule::create($data);

        return back()->with('success', 'Jadwal tanggal penuh berhasil disimpan!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}