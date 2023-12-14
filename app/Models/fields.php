<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fields extends Model
{
    use HasFactory;

    protected $fillable = [
        'dt',
        'name',
        'type',
        'max',
        'min',
        'label',
        'is_head',
        'is_index',
        'is_slug'
    ];
}
