<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode_number',
        'sk_number',
        'action',
        'detail',
        'actor_name',
    ];
}
