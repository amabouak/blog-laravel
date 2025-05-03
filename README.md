**Blog Statique Laravel - instructions d'installation et URL**

**Introduction**

Ce projet est une application web développée avec le framework PHP Laravel, implémentant un blog statique sans base de données. Conçu comme travail pratique, il démontre l'utilisation des concepts MVC (Modèle-Vue-Contrôleur), du moteur de templates Blade et du système de routing de Laravel.

URL d'accès : http://localhost:8000/articles (commande pour lancer le serveur : php artisan serve)

**🛠 Configuration Initiale**
Prérequis Système

    PHP 8.0 ou supérieur (Télécharger PHP)
    Composer (Installation Composer)
    Laravel 9.x
    Node.js (optionnel pour les assets)

Installation Pas à Pas

Clonage du dépôt :

    git clone https://github.com/amabouak/blog-laravel.git
    cd blog-laravel

Installation des dépendances

    composer install
    npm install  # Si utilisation de frontend assets

Configuration de l'environnement

    cp .env.example .env
    php artisan key:generate

Modification importante dans .env:

    SESSION_DRIVER=file  # Modification depuis 'database' pour éviter la configuration DB
    APP_URL=http://localhost:8000

Démarrage du serveur

    php artisan serve --port=8000
    L'application sera accessible à l'adresse: http://localhost:8000

🌐 Architecture du Projet
Structure des Fichiers

    blog-laravel/
    ├── app/
    │   └── Http/
    │       └── Controllers/
    │           └── ArticleController.php
    ├── config/
    │   └── session.php  # Configuration des sessions
    ├── public/
    │   ├── css/
    │   │   └── style.css  # Feuille de style principale
    │   └── js/
    ├── resources/
    │   └── views/
    │       ├── layouts/
    │       │   └── app.blade.php  # Template principal
    │       ├── articles/
    │       │   ├── index.blade.php  # Liste des articles
    │       │   └── show.blade.php  # Détail d'un article
    │       └── errors/
    │           └── 404.blade.php  # Page d'erreur personnalisée
    ├── routes/
    │   └── web.php  # Définition des routes
    ├── capturesD'écrans/ # Dossier contenant les captures d'écrans
    │       ├── Article/ # Dossier contenant les captures d'écrans des articles
    │       │   └── Article.png # Capture d'écran d'un article
    │       │   └── menuArticles.png # Capture d'écran du menu des articles
    │       └──  pageAccueil/ # Dossier contenant les captures d'écrans de la page d'accueil
    │            └──  accueil.png # Capture d'écran de la page d'accueil
    └── .env  # Configuration environnement

**🔧 Fonctionnalités Techniques**
**1. Système de Routing**

**Fichier routes/web.php:**

    <?php
    
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ArticleController;
    
    // Route d'accueil redirige vers /articles
    Route::redirect('/', '/articles');
    
    // Route pour la liste des articles
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    
    // Route pour un article spécifique
    Route::get('/articles/{slug}', [ArticleController::class, 'show'])
         ->where('slug', '[a-z0-9-]+')
         ->name('articles.show');

**2. Contrôleur des Articles**

**Fichier app/Http/Controllers/ArticleController.php:**

    <?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Support\Str;
    
    class ArticleController extends Controller
    {
        // Liste des articles statiques
        private $articles = [
            [
                'title' => 'Introduction à Laravel',
                'slug' => 'introduction-laravel',
                'content' => 'Laravel est un framework PHP moderne...',
                'published_at' => '2023-01-15'
            ],
            [
                'title' => 'Le moteur Blade',
                'slug' => 'moteur-blade', 
                'content' => 'Blade est un moteur de templates...',
                'published_at' => '2023-02-20'
            ]
        ];
    
        // Affiche la liste des articles
        public function index()
        {
            return view('articles.index', [
                'articles' => $this->articles
            ]);
        }
    
        // Affiche un article spécifique
        public function show($slug)
        {
            $article = collect($this->articles)->firstWhere('slug', $slug);
            
            if (!$article) {
                abort(404);
            }
    
            return view('articles.show', compact('article'));
        }
    }

**3. Templates Blade**

**Layout principal (resources/views/layouts/app.blade.php):**

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog Laravel | @yield('title')</title>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <header class="header">
            <nav class="navbar">
                <div class="container">
                    <a href="{{ url('/') }}" class="logo">Blog Laravel</a>
                    <ul class="nav-links">
                        <li><a href="{{ route('articles.index') }}">Articles</a></li>
                    </ul>
                </div>
            </nav>
        </header>

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <p>Blog Laravel &copy; {{ date('Y') }}</p>
        </div>
    </footer>
    </body>
    </html>

**🎨 Design et Frontend (CSS)**

**Fichier public/css/style.css:**

    :root {
        --primary-color: #6a3093;
        --secondary-color: #a044ff;
        --text-color: #333;
        --light-bg: #f9f6ff;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: var(--text-color);
        background-color: var(--light-bg);
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    
    .navbar {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        padding: 1rem 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    /* (suite des styles détaillés pour chaque composant) */

**🚀 Déploiement**
**Options de déploiement**

Environnement local (pour développement):

    php artisan serve --host=0.0.0.0 --port=8000

Serveur partagé:

    Uploader les fichiers via FTP
    Configurer le point d'entrée sur public/index.php
    Vérifier les permissions des dossiers storage et bootstrap/cache

Serveur dédié (ex: Laravel Forge):

    git clone https://github.com/votre-utilisateur/blog-laravel.git /var/www/blog-laravel
    cd /var/www/blog-laravel
    composer install --optimize-autoloader --no-dev
    php artisan config:cache
    php artisan route:cache

**🔍 Dépannage**
**Problèmes Courants**

Erreurs de session:
    
    chmod -R 775 storage/
    php artisan cache:clear

Fichiers manquants:
    
    composer dump-autoload
    php artisan view:clear

Problèmes de routing:

    php artisan route:clear

📝 Conclusion

Ce projet démontre avec succès:

    L'architecture MVC de Laravel
    L'utilisation de Blade pour les templates
    Le système de routing avancé
    La gestion des données sans base de données
    La personnalisation de l'expérience utilisateur

Améliorations possibles:

    Ajout d'un système de cache
    Internationalisation (multi-langues)
    Intégration avec une API externe

Pour toute question, ouvrez une issue sur le dépôt GitHub.
