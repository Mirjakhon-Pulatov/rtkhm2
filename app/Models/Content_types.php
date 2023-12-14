<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content_types extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dt',
        'desc',
        'status',
        'is_menu'
    ];


}
