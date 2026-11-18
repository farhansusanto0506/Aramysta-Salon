<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $guarded = [];

    // Sumber tunggal kategori: dipakai validasi, form admin, dan filter publik
    public const CATEGORIES = [
        'bridal'     => 'Pengantin Couronne',
        'red-carpet' => 'Red Carpet & Gala',
        'editorial'  => 'Editorial & Fashion',
        'soft-glam'  => 'Soft Glam',
    ];
}