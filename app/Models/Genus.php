<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genus extends Model
{
    use HasFactory , SoftDeletes;
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
