<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    protected $fillable = [
        'title',
        'banner',
        'trailer',
        'desc_home',
        'desc_side',
        'desc_full',
    ];
}
