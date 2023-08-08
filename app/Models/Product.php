<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
