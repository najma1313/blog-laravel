<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    // 1. Menampilkan semua artikel
    public function index()
    {
        $articles = Article::all();
        return view('articles', compact('articles'));
    }

    // 2. Menampilkan form tambah artikel
    public function create()
    {
        return view('create');
    }

    // 3. Menyimpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            if (!File::isDirectory(public_path('images'))) {
                File::makeDirectory(public_path('images'), 0777, true, true);
            }
            $request->image->move(public_path('images'), $imageName);
        }

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $imageName,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel Berhasil Ditambahkan!');
    }

    // 4. Menampilkan form edit (DIUBAH KE VIEW 'edit' AGAR SESUAI)
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        // Memanggil file: resources/views/edit.blade.php
        return view('edit', compact('article'));
    }

    // 5. Memproses update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $article = Article::findOrFail($id);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada upload gambar baru
            if ($article->image_url) {
                File::delete(public_path('images/' . $article->image_url));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $article->image_url = $imageName;
        }

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel Berhasil Diperbarui!');
    }

    // 6. Menghapus artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        
        // Hapus file gambar dari folder public/images
        if ($article->image_url) {
            File::delete(public_path('images/' . $article->image_url));
        }
        
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel Berhasil Dihapus!');
    }
}