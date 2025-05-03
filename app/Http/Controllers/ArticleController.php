<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = [
            [
                'title' => 'Introduction à Laravel', 
                'slug' => 'introduction-laravel', 
                'content' => 'Laravel est un framework PHP moderne et élégant qui simplifie le développement d\'applications web. Avec sa syntaxe expressive et ses outils puissants, Laravel vous permet de créer des applications robustes en un temps record.'
            ],
            [
                'title' => 'Le moteur Blade', 
                'slug' => 'moteur-blade', 
                'content' => 'Blade est le moteur de templates simple mais puissant fourni avec Laravel. Contrairement à d\'autres moteurs de templates PHP, Blade vous permet d\'utiliser du code PHP brut dans vos vues si nécessaire.'
            ],
            [
                'title' => 'Le système de routing', 
                'slug' => 'systeme-routing', 
                'content' => 'Le système de routing de Laravel est à la fois simple et puissant. Il vous permet de définir facilement des routes pour votre application et de les associer à des contrôleurs ou des closures.'
            ]
        ];
        
        return view('articles.index', compact('articles'));
    }

    public function show($slug)
    {
        $articles = [
            [
                'title' => 'Introduction à Laravel', 
                'slug' => 'introduction-laravel', 
                'content' => 'Laravel est un framework PHP moderne et élégant qui simplifie le développement d\'applications web. Avec sa syntaxe expressive et ses outils puissants, Laravel vous permet de créer des applications robustes en un temps record.
                
                Quelques fonctionnalités clés :
                - Syntaxe élégante et expressive
                - Système de routing intuitif
                - ORM Eloquent puissant
                - Moteur de templates Blade
                - Système de migration de base de données
                
                Laravel est conçu pour rendre le développement web à la fois agréable et créatif, tout en respectant les bonnes pratiques.'
            ],
            [
                'title' => 'Le moteur Blade', 
                'slug' => 'moteur-blade', 
                'content' => 'Blade est le moteur de templates simple mais puissant fourni avec Laravel. Contrairement à d\'autres moteurs de templates PHP, Blade vous permet d\'utiliser du code PHP brut dans vos vues si nécessaire.
                
                Principales caractéristiques :
                - Héritage de template via @extends
                - Sections avec @section/@yield
                - Structures de contrôle (@if, @foreach, etc.)
                - Inclusion de sous-vues
                - Système de composants
                
                Blade compile toutes les vues en code PHP pur, ce qui signifie qu\'il n\'y a pratiquement aucune surcharge pour l\'utilisation de Blade.'
            ],
            [
                'title' => 'Le système de routing', 
                'slug' => 'systeme-routing', 
                'content' => 'Le système de routing de Laravel est à la fois simple et puissant. Il vous permet de définir facilement des routes pour votre application et de les associer à des contrôleurs ou des closures.
                
                Fonctionnalités avancées :
                - Paramètres de route
                - Contraintes regex
                - Routes nommées
                - Groupes de routes
                - Middleware
                - Liaison de modèle implicite
                
                Le routing est configuré dans le fichier routes/web.php et offre une grande flexibilité pour organiser les points d\'entrée de votre application.'
            ]
        ];
        
        $article = collect($articles)->firstWhere('slug', $slug);
        
        if (!$article) {
            abort(404);
        }
        
        return view('articles.show', compact('article'));
    }
}