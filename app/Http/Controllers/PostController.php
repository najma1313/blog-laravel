<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category; 
use Illuminate\Http\Request;

class PostController extends Controller 
{
    // Tampilkan daftar artikel
    public function index() {
        // Mengambil data artikel (with category) dan dimasukkan ke variabel $articles agar card lama muncul kembali
        $articles = Post::with('category')->latest()->get();
        
        // Mengambil semua data kategori untuk dilempar ke modal tambah
        $categories = Category::all();
        
        // Lempar kedua data tersebut ke view articles
        return view('articles.articles', compact('articles', 'categories')); 
    }

    // Form tambah artikel
    public function create() {
        // Mengambil semua data kategori dari database
        $categories = Category::all();
        
        // Diarahkan ke file create.blade.php yang baru saja dibuat di dalam folder articles
        return view('articles.create', compact('categories'));
    }

    // Simpan ke database
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari form modal tambah
        $request->validate([
            'title' => 'required|string|max:255', // Memperbaiki typo max::255 menjadi max:255
            'content' => 'required',
            'category_id' => 'required|exists:categories,id', // Pastikan kategori wajib dipilih dan ada di DB
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_url' => 'nullable|url'
        ]);

        // 2. Buat objek Post baru
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        
        // Menangkap input kategori dari form dropdown modal
        $post->category_id = $request->category_id; 

        // 3. Logika pengecekan input gambar (apakah via upload file atau link URL)
        if ($request->img_source === 'file' && $request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $post->image_url = $path;
        } else {
            $post->image_url = $request->image_url;
        }

        // 4. Simpan ke database
        $post->save();

        // 5. Kembali ke halaman manajemen konten dengan pesan sukses
        return redirect('/articles')->with('success', 'Artikel berhasil dipublikasikan!');
    }

    // Update artikel lama (FUNGSI BARU BIAR EDIT KATEGORI BERHASIL)
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_url' => 'nullable|url'
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        
        // MENYIMPAN PERUBAHAN KATEGORI SAAT DIEDIT
        $post->category_id = $request->category_id;

        // Logika update gambar
        $imgSourceKey = 'img_source_' . $id;
        if ($request->$imgSourceKey === 'file' && $request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $post->image_url = $path;
        } elseif ($request->$imgSourceKey === 'url') {
            $post->image_url = $request->image_url;
        }

        $post->save();

        return redirect('/articles')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Hapus artikel
    public function destroy(Post $post) {
        $post->delete();
        return redirect('/articles')->with('success', 'Artikel berhasil dihapus!');
    }
}
