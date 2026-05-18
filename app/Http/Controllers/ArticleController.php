<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    // tampil artikel
    public function index()
    {
        $articles = Article::latest()->get();

        return view('articles', compact('articles'));
    }

    // form tambah
    public function create()
    {
        return view('create');
    }

    // simpan artikel
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // upload gambar
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        // simpan database
        Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect('/articles')
            ->with('success', 'Artikel berhasil ditambahkan');
    }

    // form edit
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('edit', compact('article'));
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $article = Article::findOrFail($id);

        // upload gambar baru
        if($request->hasFile('image')){

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('images'), $imageName);

            $article->image = $imageName;
        }

        $article->title = $request->title;
        $article->description = $request->description;

        $article->save();

        return redirect('/articles')
            ->with('success', 'Artikel berhasil diupdate');
    }

    // hapus
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return redirect('/articles')
            ->with('success', 'Artikel berhasil dihapus');
    }
}