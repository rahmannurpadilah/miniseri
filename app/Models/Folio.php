<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    protected $fillable = [
        'title',
        'is_favorite',
        'banner',
        'trailer',
        'desc_home',
        'desc_side',
        'desc_full',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
    ];
}
