<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'slug', 'content', 'image_url'];

    // Relasi ke model Category
    public function category()
{
    // Pastikan 'category_id' di tabel articles sesuai dengan 'id' di tabel categories
    return $this->belongsTo(\App\Models\Category::class, 'category_id');
}
}