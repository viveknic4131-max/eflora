<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use  SoftDeletes;
    protected $fillable = ['title', 'slug', 'file_path'];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Str::slug($model->title);
            }
        });
    }

    public function getFilePathAttribute($value)
    {
        return asset('storage/news/' . $value);
    }
}
