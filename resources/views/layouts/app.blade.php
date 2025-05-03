<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Laravel de Khamis Amaboua | @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar-->
    <nav class="navbar">
        <div class="nav-links">
            <a href="/">Accueil</a>
            <a href="/articles">Articles</a>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>Blog Laravel de Khamis Amaboua &copy; {{ date('Y') }} - Tous droits réservés</p>
    </footer>
</body>
</html>