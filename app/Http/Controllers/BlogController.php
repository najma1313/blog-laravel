<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Menampilkan halaman Home dengan 3 artikel terbaru
    public function home()
    {
        $latestArticles = Article::latest()->take(3)->get();
        return view('pages.home', compact('latestArticles'));
    }

    // Menampilkan semua artikel
    public function index()
    {
        $articles = Article::latest()->get();
        return view('articles.articles', compact('articles'));
    }

    // Menampilkan detail artikel (READ MORE)
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    // Menampilkan form edit artikel
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    // Menampilkan form create artikel
    public function create()
    {
        return view('articles.create');
    }

    // Menyimpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'image_url' => 'nullable|url',
        ]);

        $finalImagePath = null;

        if ($request->img_source == 'file' && $request->hasFile('image')) {
            $finalImagePath = $request->file('image')->store('articles', 'public');
        } elseif ($request->img_source == 'url' && $request->filled('image_url')) {
            $finalImagePath = $request->image_url;
        }

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'image_url' => $finalImagePath, 
        ]);

        return redirect()->back()->with('success', 'Artikel berhasil diterbitkan!');
    }

    // Mengupdate artikel (dengan dukungan file upload & URL)
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url',
        ]);

        // Logika pemilihan sumber gambar
        if ($request->img_source == 'file' && $request->hasFile('image')) {
            // Hapus gambar lama jika ada dan itu file lokal (bukan URL)
            if ($article->image_url && !Str::startsWith($article->image_url, 'http') && Storage::disk('public')->exists($article->image_url)) {
                Storage::disk('public')->delete($article->image_url);
            }
            $article->image_url = $request->file('image')->store('articles', 'public');
        } 
        elseif ($request->img_source == 'url' && $request->filled('image_url')) {
            // Hapus file lokal lama jika ada
            if ($article->image_url && !Str::startsWith($article->image_url, 'http') && Storage::disk('public')->exists($article->image_url)) {
                Storage::disk('public')->delete($article->image_url);
            }
            $article->image_url = $request->image_url;
        }

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('home')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Menghapus artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        
        // Hapus file dari storage hanya jika itu file lokal (bukan URL)
        if ($article->image_url && !Str::startsWith($article->image_url, 'http') && Storage::disk('public')->exists($article->image_url)) {
            Storage::disk('public')->delete($article->image_url);
        }

        $article->delete();

        return redirect()->back()->with('success', 'Artikel berhasil dihapus!');
    }
}