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

    // Menampilkan semua artikel di halaman Articles
    public function index()
    {
        $articles = Article::latest()->get();
        // PERBAIKAN: Ubah dari 'articles.articles' ke 'pages.articles' agar tidak error
        return view('articles.articles', compact('articles'));
    }

    // SIMPAN Artikel Baru (Mendukung File & Link URL)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:10',
            // Image nullable karena user bisa milih pakai Link URL
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'image_url' => 'nullable|url',
        ]);

        // 2. Logika Pemilihan Sumber Gambar
        $finalImagePath = null;

        if ($request->img_source == 'file' && $request->hasFile('image')) {
            // Jika user memilih upload file lokal
            $finalImagePath = $request->file('image')->store('articles', 'public');
        } else {
            // Jika user memasukkan link URL (misal dari Google/Unsplash)
            $finalImagePath = $request->image_url;
        }

        // 3. Simpan ke Database
        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'image_url' => $finalImagePath, 
        ]);

        return redirect()->back()->with('success', 'Artikel Jema Archive berhasil diterbitkan!');
    }

    // UPDATE Artikel
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        // Cek jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama HANYA jika itu file lokal (bukan link URL)
            if ($article->image_url && Storage::disk('public')->exists($article->image_url)) {
                Storage::disk('public')->delete($article->image_url);
            }
            $article->image_url = $request->file('image')->store('articles', 'public');
        }

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Arsip berhasil diperbarui!');
    }

    // HAPUS Artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        
        // Hapus file dari storage jika ada (cek apakah path-nya file lokal)
        if ($article->image_url && Storage::disk('public')->exists($article->image_url)) {
            Storage::disk('public')->delete($article->image_url);
        }

        $article->delete();

        return redirect()->back()->with('success', 'Artikel telah dihapus dari arsip.');
    }
}