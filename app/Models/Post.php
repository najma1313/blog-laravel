<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 1. Amankan kolom yang boleh diisi (Sesuaikan dengan nama kolom database kamu)
    protected $fillable = ['title', 'category_id', 'content', 'image_url'];

    // 2. TAMBAHKAN FUNGSI RELASI INI
    // Fungsi ini bertugas menghubungkan category_id di tabel posts dengan tabel categories
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}