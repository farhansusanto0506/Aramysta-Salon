<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'image',
        'title',
        'prices',
        'highlights',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function getPricesListAttribute(): array
    {
        if (empty($this->prices)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $this->prices))));
    }

    public function getHighlightsListAttribute(): array
    {
        if (empty($this->highlights)) {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', $this->highlights);
        $cleaned = array_map(fn ($line) => ltrim(trim($line), "-•* \t"), $lines);

        return array_values(array_filter($cleaned));
    }
}