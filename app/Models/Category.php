<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tambahkan ini biar bisa isi data kategori lewat form/tinker nanti
    protected $fillable = ['name']; 

    // Kode Relasi: Satu kategori punya banyak artikel
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}