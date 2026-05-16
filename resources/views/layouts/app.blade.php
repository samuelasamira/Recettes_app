<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Accueil') — Recettes App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <a href="{{ route('recipes.index') }}" class="navbar-logo">🍳 Recettes App</a>

        <div class="navbar-links">
            <a href="{{ route('recipes.index') }}" class="navbar-link {{ request()->routeIs('recipes.*') ? 'active' : '' }}">
                Recettes
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="navbar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('recipes.create') }}" class="navbar-btn">
                    + Créer
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="navbar-btn-outline">Déconnexion</button>
                </form>
                <a href="{{ route('profile.edit') }}" class="navbar-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </a>
            @else
                <a href="{{ route('login') }}" class="navbar-btn-outline">Connexion</a>
                <a href="{{ route('register') }}" class="navbar-btn">Inscription</a>
            @endauth
        </div>
    </nav>

    {{-- ALERTS --}}
<div id="alerts-container" style="position:fixed; top:80px; right:24px; z-index:9999; display:flex; flex-direction:column; gap:10px;">
    @if(session('success'))
        <div class="alert alert-success auto-dismiss" style="min-width:280px; box-shadow:0 4px 20px rgba(0,0,0,0.15); animation: slideIn 0.3s ease;">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error auto-dismiss" style="min-width:280px; box-shadow:0 4px 20px rgba(0,0,0,0.15); animation: slideIn 0.3s ease;">
            ❌ {{ session('error') }}
        </div>
    @endif
    @if(session('info'))
        <div class="alert alert-info auto-dismiss" style="min-width:280px; box-shadow:0 4px 20px rgba(0,0,0,0.15); animation: slideIn 0.3s ease;">
            ℹ️ {{ session('info') }}
        </div>
    @endif
</div>

<style>
    @keyframes slideIn {
        from { transform: translateX(120%); opacity: 0; }
        to   { transform: translateX(0);    opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0);    opacity: 1; }
        to   { transform: translateX(120%); opacity: 0; }
    }
    .alert-hiding {
        animation: slideOut 0.4s ease forwards;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alerts = document.querySelectorAll('.auto-dismiss');
        alerts.forEach(function (alert) {
            setTimeout(function () {
                alert.classList.add('alert-hiding');
                setTimeout(function () {
                    alert.remove();
                }, 400);
            }, 3000);
        });
    });
</script>

    {{-- CONTENU PRINCIPAL --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer-grid">
            <div>
                <div class="footer-logo">🍳 Recettes App</div>
                <div class="footer-desc">Célébrer le patrimoine culinaire du Cameroun, une recette à la fois.</div>
            </div>
            <div>
                <div class="footer-heading">Explorer</div>
                <a href="{{ route('recipes.index') }}" class="footer-link">Toutes les recettes</a>
                @auth
                    <a href="{{ route('recipes.create') }}" class="footer-link">Créer une recette</a>
                @endauth
            </div>
            <div>
                <div class="footer-heading">Compte</div>
                @auth
                    <a href="{{ route('dashboard') }}" class="footer-link">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="footer-link">Mon profil</a>
                @else
                    <a href="{{ route('login') }}" class="footer-link">Connexion</a>
                    <a href="{{ route('register') }}" class="footer-link">Inscription</a>
                @endauth
            </div>
            <div>
                <div class="footer-heading">Contact</div>
                <a href="mailto:samuelasamirasamanthabolobolo@gmail.com" class="footer-link">📧 Nous contacter</a>
                <a href="{{ route('register') }}" class="footer-link">🎉 Rejoindre la communauté</a>
            </div>
        </div>
        <div class="footer-bottom">
            © 2026 Recettes App — Excellence Culinaire Camerounaise 🇨🇲
        </div>
    </footer>

</body>
</html>