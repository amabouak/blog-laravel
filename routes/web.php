<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Page d'accueil 
Route::get('/', function () {
    return view('welcome'); // Créez une vue spécifique pour l'accueil
});

// Liste des articles
Route::get('/articles', [ArticleController::class, 'index']);

// Détail d'un article
Route::get('/articles/{slug}', [ArticleController::class, 'show']);