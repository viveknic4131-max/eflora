<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Species extends Model
{
    use HasFactory;

    public function genus()
    {
        return $this->belongsTo(Genus::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function images()
    {
        return $this->hasMany(SpeciesImage::class);
    }
}
