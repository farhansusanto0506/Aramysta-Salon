<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $guarded = [];

    // Daftar kategori
    public const CATEGORIES = [
        'pernikahan'     => 'Pernikahan',
        'wisuda'     => 'Wisuda',
        'siraman'    => 'Siraman',
    ];
}