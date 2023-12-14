<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Featured_images extends Model
{
    use HasFactory;

    protected $table = 'featured_images';

    protected $guarded = [];
}
