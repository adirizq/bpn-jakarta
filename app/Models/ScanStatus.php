<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    
    public function archives() {
        return $this->hasMany(Archive::class);
    }
}