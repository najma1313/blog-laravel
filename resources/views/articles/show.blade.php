@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <article>
                <h1 class="fw-bold mb-4" style="color: #800020;">{{ $article->title }}</h1>
                
                @if($article->image_url)
                    <img src="{{ $article->image_url }}" class="img-fluid rounded mb-4 w-100" alt="{{ $article->title }}">
                @endif
                
                <div class="content" style="font-size: 1.1rem; line-height: 1.8;">
                    {{ $article->content }}
                </div>
                
                <div class="mt-5 pt-3">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">← Kembali</a>
                    
                    @auth
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn" style="background-color: #d4a837; color: white; margin-left: 10px;">Edit</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus artikel ini?')">Hapus</button>
                        </form>
                    @endauth
                </div>
            </article>
        </div>
    </div>
</div>
@endsection