<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Species extends Model
{
    use HasFactory, SoftDeletes;
    // protected $casts = [
    //     'synonyms' => 'array',
    // ];

    protected $fillable = [

        'species_code',
        'name',
        'description',
        'genus_id',
        'family_id',
        'author',
        'publication',
        'year_described',
        'volume',
        'page',
        'common_name',
        'synonyms',
    ];
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

     public function firstImage()
    {
        return $this->images()->first()?->pic;
    }
}
