<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;
    protected $fillable = ['title', 'image'];
    public $translatable = [
        'title',
    ];
    public function blog()
    {
        return $this->hasMany(Blog::class);
    }
}
