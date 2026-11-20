<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $guarded = [];

    // Sumber tunggal kategori: dipakai validasi, form admin, dan filter publik
    public const CATEGORIES = [
        'pernikahan'     => 'Pernikahan',
        'wisuda'     => 'Wisuda',
        'siraman'    => 'Siraman',
    ];
}