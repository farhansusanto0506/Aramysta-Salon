<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderByRaw("CASE WHEN note LIKE '[SELESAI]%' THEN 1 ELSE 0 END ASC")
            ->orderBy('booking_date', 'asc')
            ->get();

        return view('admin.schedules.index', compact('schedules'));
    }

    public function toggleComplete(Schedule $schedule)
    {
        $currentNote = (string) $schedule->note;
        $isCompleted = str_starts_with($currentNote, '[SELESAI]');

        if ($isCompleted) {
            $cleanNote = trim(preg_replace('/^\[SELESAI\]\s*/', '', $currentNote));
            $schedule->update(['note' => $cleanNote !== '' ? $cleanNote : null]);
            $pesan = 'Status selesai jadwal dibatalkan.';
        } else {
            $newNote = $currentNote !== '' ? '[SELESAI] ' . $currentNote : '[SELESAI]';
            $schedule->update(['note' => $newNote]);
            $pesan = 'Jadwal ditandai selesai.';
        }

        return back()->with('success', $pesan);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'booking_date' => ['required', 'date'],
            'start_time'   => ['required', 'string', 'max:10'],
            'note'         => ['nullable', 'string', 'max:255'],
            'is_completed' => ['nullable', 'boolean'],
        ]);

        $cleanNote = trim(preg_replace('/^\[SELESAI\]\s*/', '', (string) ($validated['note'] ?? '')));
        $isCompleted = $request->boolean('is_completed');
        $finalNote = $isCompleted
            ? ($cleanNote !== '' ? '[SELESAI] ' . $cleanNote : '[SELESAI]')
            : ($cleanNote !== '' ? $cleanNote : null);

        $schedule->update([
            'booking_date' => $validated['booking_date'],
            'start_time'   => $validated['start_time'],
            'note'         => $finalNote,
        ]);

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
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
