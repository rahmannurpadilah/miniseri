<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SineasRegistration extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'can_edit',
        'agreement',
    ];
}
