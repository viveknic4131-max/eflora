<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = ['family_code', 'name', 'description'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->family_code = (string) Str::uuid();
        });
    }

    public function genera()
    {
        return $this->hasMany(Genus::class);
    }

    public function species()
    {
        return $this->hasManyThrough(Species::class, Genus::class);
    }

    public function volumes()
    {
        return $this->hasMany(FamilyVolumes::class);
    }
}
