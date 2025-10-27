<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Volume extends Model
{
    use HasFactory;
 protected $fillable = ['volume_code', 'volume','type','name', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->volume_code = (string) Str::uuid();
        });
    }
}
