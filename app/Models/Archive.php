<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode_number',
        'rack_location',
        'type_id',
        'sk_number',
        'name',
        'address',
        'kelurahan',
        'kecamatan',
        'kab_kota',
        'provinsi',
        'right_type_id',
        'scan_status_id',
        'physical_status_id',
        'condition_id',
        'description',
        'user_id',
    ];
    
    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function rightType() {
        return $this->belongsTo(RightType::class);
    }

    public function scanStatus() {
        return $this->belongsTo(ScanStatus::class);
    }

    public function physicalStatus() {
        return $this->belongsTo(PhysicalStatus::class);
    }

    public function condition() {
        return $this->belongsTo(Condition::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function editedBy() {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
