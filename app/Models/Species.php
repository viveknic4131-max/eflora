<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

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
        'is_infra',
        'infra_values',
        'is_in',
        'in_author',
        'state_ids',
    ];

    protected $casts = [
        'state_ids' => 'array',
        'infra_values' => 'array',
        'in_author'    => 'array',
        'is_infra'     => 'boolean',
        'is_in'        => 'boolean',
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

    public function synonyms()
    {
        return $this->hasMany(
            SpeciesSynonym::class,
            'species_id',
            'id'
        );
    }

    public function getDistributionsAttribute(): Collection
    {
        if (empty($this->state_ids)) {
            return collect();
        }

        return State::select('name')->whereIn('id', $this->state_ids)->get()->pluck('name');
    }
}
