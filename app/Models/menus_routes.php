<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menus_routes extends Model
{
    use HasFactory;

    protected $fillable = [
        'route',
        'slug',
    ];
}
