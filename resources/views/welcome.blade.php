@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="welcome-container">
    <h1 class="page-title">Bienvenue sur mon Blog Laravel</h1>
    <p>Développement web et technologies modernes</p>
    
    <div class="cta-section" style="margin-top: 2rem;">
        <a href="/articles" class="btn">Explorer les articles</a>
    </div>
</div>
@endsection