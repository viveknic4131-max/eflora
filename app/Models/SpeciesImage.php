<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpeciesImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'species_id',
        'pic',
    ];

    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    public function getPicAttribute($value)
    {
        return asset('storage/plants/' . $value);
    }
}
