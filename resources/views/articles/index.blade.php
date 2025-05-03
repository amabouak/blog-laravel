@extends('layouts.app')

@section('title', 'Articles')

@section('content')
<h1 class="page-title">Mes Articles</h1>

<div class="articles-list">
    @foreach($articles as $article)
    <div class="article-card">
        <h2 style="color: #4a2c7a; margin-bottom: 0.8rem;">{{ $article['title'] }}</h2>
        <p style="color: #666; margin-bottom: 1.2rem;">{{ Str::limit($article['content'], 150) }}</p>
        <a href="/articles/{{ $article['slug'] }}" class="btn">Lire l'article</a>
    </div>
    @endforeach
</div>
@endsection