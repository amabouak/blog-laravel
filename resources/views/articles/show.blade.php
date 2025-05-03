@extends('layouts.app')

@section('title', $article['title'])

@section('content')
<div class="article-full">
    <h1 class="page-title">{{ $article['title'] }}</h1>
    <div class="article-content" style="color: #444; line-height: 1.8;">
        {{ $article['content'] }}
    </div>
    <div style="margin-top: 2rem;">
        <a href="/articles" class="btn">Retour aux articles</a>
    </div>
</div>
@endsection