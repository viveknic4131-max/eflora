<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genus extends Model
{
    use HasFactory;
    protected $fillable = [
        'genus_code',
        'name',
        'description',
        'family_id',
        'volume_id',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}
