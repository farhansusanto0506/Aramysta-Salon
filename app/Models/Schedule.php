<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public const TYPES = [
        'full'    => 'Penuh',
        'blocked' => 'Diblokir (Kosong)',
    ];

    protected $guarded = [];

    /**
     * Samakan format nomor WA: hanya angka, awalan 0 / 8 menjadi 62.
     */
    public static function normalizePhone(?string $phone): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $phone);

        if ($digits === '') {
            return null;
        }

        if (str_starts_with($digits, '0')) {
            return '62' . substr($digits, 1);
        }

        if (str_starts_with($digits, '8')) {
            return '62' . $digits;
        }

        return $digits;
    }

    public function getWaLinkAttribute(): ?string
    {
        return $this->customer_phone ? 'https://wa.me/' . $this->customer_phone : null;
    }
}
