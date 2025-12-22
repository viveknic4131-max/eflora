<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpeciesSynonym extends Model
{
  protected $fillable = [
        'species_id',
        'spcies',
        'genus',
        'author',
        'publication',
        'volume',
        'page',
        'year_described',
        'is_infra',
        'infra_values',
        'is_in',
        'in_author'
    ];

    protected $casts = [
        'infra_values' => 'array',
        'in_author'    => 'array',
        'is_infra'     => 'boolean',
        'is_in'        => 'boolean',
    ];


public function species()
{
    return $this->belongsTo(
        Species::class,
        'species_id',
        'id'
    );
}
}
