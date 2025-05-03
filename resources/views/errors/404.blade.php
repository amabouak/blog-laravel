@extends('layouts.app')

@section('title', 'Page non trouvée')

@section('content')
    <div class="error-container">
        <h1>404</h1>
        <h2 style="font-size: 1.8rem; margin-bottom: 20px;">Article introuvable</h2>
        <p style="font-size: 1.1rem; margin-bottom: 30px;">
            Désolé, l'article que vous recherchez n'existe pas ou a été déplacé.
        </p>
        <a href="/articles" class="btn">Retour aux articles</a>
    </div>
@endsection