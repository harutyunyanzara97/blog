<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'user_id',
        'description',
        'photo'
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_blogs','blog_id','category_id');
    }
}
