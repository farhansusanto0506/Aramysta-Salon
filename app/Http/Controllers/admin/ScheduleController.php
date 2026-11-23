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
        $this->normalizeCustomerPhone($request);

        $validated = $request->validate([
            'booking_date'   => ['required', 'date', 'unique:schedules,booking_date,' . $schedule->id],
            'type'           => ['required', 'in:' . implode(',', array_keys(Schedule::TYPES))],
            'start_time'     => ['required_if:type,full', 'nullable', 'string', 'max:10'],
            'note'           => ['nullable', 'string', 'max:255'],
            'is_completed'   => ['nullable', 'boolean'],
            ...self::CUSTOMER_RULES,
        ], [
            'booking_date.unique'    => 'Tanggal tersebut sudah ada di daftar.',
            'start_time.required_if' => 'Jam mulai wajib diisi untuk tanggal penuh.',
            ...self::CUSTOMER_MESSAGES,
        ]);

        $isBlocked = $validated['type'] === 'blocked';

        $cleanNote = trim(preg_replace('/^\[SELESAI\]\s*/', '', (string) ($validated['note'] ?? '')));
        $isCompleted = $request->boolean('is_completed');
        $finalNote = $isCompleted
            ? ($cleanNote !== '' ? '[SELESAI] ' . $cleanNote : '[SELESAI]')
            : ($cleanNote !== '' ? $cleanNote : null);

        $schedule->update([
            'booking_date' => $validated['booking_date'],
            'type'         => $validated['type'],
            'start_time'     => $isBlocked ? null : $validated['start_time'],
            'note'           => $finalNote,
            'customer_name'  => $isBlocked ? null : ($validated['customer_name'] ?? null),
            'customer_phone' => $isBlocked ? null : ($validated['customer_phone'] ?? null),
        ]);

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $this->normalizeCustomerPhone($request);

        $data = $request->validate([
            'booking_date' => 'required|date|unique:schedules,booking_date',
            'type'         => 'required|in:' . implode(',', array_keys(Schedule::TYPES)),
            'start_time'   => 'required_if:type,full|nullable|string|size:5',
            'note'         => 'nullable|string|max:100',
            ...self::CUSTOMER_RULES,
        ], [
            'booking_date.unique'    => 'Tanggal tersebut sudah ditandai penuh / diblokir.',
            'start_time.required_if' => 'Jam mulai wajib diisi untuk tanggal penuh.',
            ...self::CUSTOMER_MESSAGES,
        ]);

        if ($data['type'] === 'blocked') {
            $data['start_time'] = null;
            $data['customer_name'] = null;
            $data['customer_phone'] = null;
        }

        Schedule::create($data);

        return back()->with('success', $data['type'] === 'blocked'
            ? 'Tanggal berhasil diblokir.'
            : 'Jadwal tanggal penuh berhasil disimpan!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return back()->with('success', 'Jadwal berhasil dihapus.');
    }

    private const CUSTOMER_RULES = [
        'customer_name'  => ['nullable', 'string', 'max:100'],
        'customer_phone' => ['nullable', 'string', 'min:9', 'max:20'],
    ];

    private const CUSTOMER_MESSAGES = [
        'customer_phone.min' => 'Nomor WA pelanggan terlalu pendek.',
    ];

    private function normalizeCustomerPhone(Request $request): void
    {
        $request->merge([
            'customer_phone' => Schedule::normalizePhone($request->input('customer_phone')),
        ]);
    }
}
