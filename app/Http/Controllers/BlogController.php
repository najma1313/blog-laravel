<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Menampilkan halaman Home dengan 3 artikel terbaru
    public function home()
    {
        $latestArticles = Article::with('category')->latest()->take(3)->get();
        return view('pages.home', compact('latestArticles'));
    }

    // Menampilkan semua artikel
    public function index(Request $request)
{
    $categorySlug = $request->get('category', 'semua');
    
    if ($categorySlug && $categorySlug != 'semua') {
        $category = Category::where('slug', $categorySlug)->first();
        if ($category) {
            $articles = Article::with('category')->where('category_id', $category->id)->latest()->get();
        } else {
            $articles = Article::with('category')->latest()->get();
        }
    } else {
        $articles = Article::with('category')->latest()->get();
    }
    
    $categories = Category::all();
    $activeCategory = $categorySlug;
    
    return view('articles.articles', compact('articles', 'categories', 'activeCategory'));
}

    // Menampilkan detail artikel (READ MORE)
    public function show($id)
    {
        $article = Article::with('category')->findOrFail($id);
        return view('articles.show', compact('article'));
    }

    // Menampilkan form edit artikel
    public function edit($id)
{
    $article = Article::findOrFail($id);
    $categories = Category::all();
    return view('articles.edit', compact('article', 'categories'));
}

    // Menampilkan form create artikel
    public function create()
{
    $categories = Category::all();
    return view('articles.create', compact('categories'));
}
    // Menyimpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:10',
            'category_id' => 'required|exists:categories,id', // Validasi kategori wajib
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
            'category_id' => $request->category_id, // SIMPAN KATEGORI DI SINI
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'image_url' => $finalImagePath, 
        ]);

        return redirect()->back()->with('success', 'Artikel berhasil diterbitkan!');
    }

    // Mengupdate artikel
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id', // Validasi kategori saat edit
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url',
        ]);

        if ($request->img_source == 'file' && $request->hasFile('image')) {
            if ($article->image_url && !Str::startsWith($article->image_url, 'http') && Storage::disk('public')->exists($article->image_url)) {
                Storage::disk('public')->delete($article->image_url);
            }
            $article->image_url = $request->file('image')->store('articles', 'public');
        } 
        elseif ($request->img_source == 'url' && $request->filled('image_url')) {
            if ($article->image_url && !Str::startsWith($article->image_url, 'http') && Storage::disk('public')->exists($article->image_url)) {
                Storage::disk('public')->delete($article->image_url);
            }
            $article->image_url = $request->image_url;
        }

        // Tambahkan pengubahan category_id saat diupdate
        $article->update([
            'title' => $request->title,
            'category_id' => $request->category_id, // UPDATE KATEGORI DI SINI
            'content' => $request->content,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Menghapus artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        
        if ($article->image_url && !Str::startsWith($article->image_url, 'http') && Storage::disk('public')->exists($article->image_url)) {
            Storage::disk('public')->delete($article->image_url);
        }

        $article->delete();

        return redirect()->back()->with('success', 'Artikel berhasil dihapus!');
    }
}