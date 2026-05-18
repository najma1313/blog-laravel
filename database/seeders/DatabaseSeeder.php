<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            ['title' => 'Menjelajahi Keindahan Gunung Merbabu', 'img' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800'],
            ['title' => 'Eksplorasi Estetika Fotografi Analog', 'img' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=800'],
            ['title' => 'Panduan Routing Laravel untuk Pemula', 'img' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800'],
            ['title' => 'Seni Komposisi dalam Fotografi Lanskap', 'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=800'],
            ['title' => 'Tips Membangun UI/UX ala Gen Z', 'img' => 'https://images.unsplash.com/photo-1581291518655-9523c932dedf?w=800'],
            ['title' => 'Belajar Logika Pemrograman Dasar', 'img' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=800'],
        ];

        foreach ($articles as $a) {
            Article::create([
                'title' => $a['title'],
                'slug' => Str::slug($a['title']),
                'content' => 'Ini adalah konten lengkap untuk artikel mengenai ' . $a['title'] . '. Isinya membahas detail, tips, trik, serta dokumentasi perjalanan atau pengerjaan project secara mendalam.',
                'image_url' => $a['img']
            ]);
        }
    }
}