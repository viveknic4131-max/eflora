<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = ['family_code', 'name', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->family_code = (string) Str::uuid();
        });
    }
}
