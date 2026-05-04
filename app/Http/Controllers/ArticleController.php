<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('articles', compact('articles'));
    }

    public function create()
    {
        return view('create');
    }

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
            // Otomatis buat folder public/images kalau belum ada
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

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        // Hapus file gambar dari folder jika ada
        if ($article->image_url) {
            File::delete(public_path('images/' . $article->image_url));
        }
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel Berhasil Dihapus!');
    }
}