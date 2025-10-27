<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyVolumes extends Model
{

use HasFactory;
    protected $fillable = [
        'family_id',
        'volume_id',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class, 'family_id');
    }
    public function volume()
    {
        return $this->belongsTo(Volume::class, 'volume_id');
    }
}
