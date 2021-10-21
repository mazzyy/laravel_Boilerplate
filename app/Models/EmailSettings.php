<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'host',
        'port',
        'username',
        'password',
        'sent_email',
        'sent_title',
        'email_enc',
        'passwouser_idrd',
        'status',

    ];


}

