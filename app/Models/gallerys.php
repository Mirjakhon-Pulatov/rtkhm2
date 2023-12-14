<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gallerys extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'file',
        'type',
        'created_at',
        'updated_at'
    ];
}
