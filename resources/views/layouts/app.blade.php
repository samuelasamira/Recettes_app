<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Recettes App') - Recettes App</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Manrope:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .editorial-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
        }
        body {
            font-family: 'Manrope', sans-serif;
        }
        h1, h2, h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-surface font-body text-on-surface min-h-screen flex flex-col">
    <!-- TopNavBar -->
    <nav class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-md shadow-[0_20px_40px_rgba(44,47,48,0.06)]">
        <div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto">
            <a href="{{ route('welcome') }}" class="text-2xl font-bold tracking-tighter text-indigo-600">🍳 Recettes App</a>
            <div class="hidden md:flex items-center gap-8">
                <a class="font-medium text-gray-600 hover:text-indigo-500 transition-colors duration-300" href="{{ route('recipes.index') }}">Recettes</a>
                @auth
                    <a class="font-medium text-gray-600 hover:text-indigo-500 transition-colors duration-300" href="{{ route('dashboard') }}">Tableau de bord</a>
                @endauth
            </div>
            <div class="flex items-center gap-4">
                <!-- Formulaire de recherche -->
                <form method="GET" action="{{ route('recipes.index') }}" class="relative hidden lg:block">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="pl-10 pr-4 py-2 bg-surface-container-lowest border-none rounded-xl focus:ring-2 focus:ring-primary/40 text-sm w-64" 
                           placeholder="Rechercher une saveur..."/>
                </form>
                @auth
                    <a href="{{ route('recipes.create') }}" class="bg-[#28a745] text-white px-6 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 hover:opacity-90 transition-all active:scale-95 duration-200">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add</span>
                        + Nouvelle recette
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700 font-medium text-sm flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">logout</span>
                            Déconnexion
                        </button>
                    </form>
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-surface-container">
                        <img alt="Avatar" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=667eea&color=fff"/>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-indigo-600 font-medium">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium">Inscription</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Messages flash -->
    <div class="pt-24 px-8 max-w-7xl mx-auto w-full">
        @if ($message = Session::get('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-400 text-green-700 text-sm">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="mb-4 p-4 rounded-lg bg-error/10 border border-error/30 text-error text-sm">
                {{ $message }}
            </div>
        @endif
    </div>

    <!-- Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 py-12 mt-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-8 max-w-7xl mx-auto">
            <div class="flex flex-col gap-4">
                <span class="text-lg font-bold text-gray-900">Recettes App</span>
                <p class="text-gray-500 text-sm leading-relaxed">Célébrer et préserver l'héritage culinaire camerounais à travers une plateforme digitale moderne et gourmande.</p>
            </div>
            <div>
                <h4 class="font-bold text-sm mb-4 uppercase tracking-widest text-on-surface-variant">Liens utiles</h4>
                <ul class="flex flex-col gap-2">
                    <li><a class="text-gray-500 text-sm hover:underline hover:text-indigo-600 transition-all" href="{{ route('pages.about') }}">À propos</a></li>
                    <li><a class="text-gray-500 text-sm hover:underline hover:text-indigo-600 transition-all" href="{{ route('pages.contact') }}">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm mb-4 uppercase tracking-widest text-on-surface-variant">Légal</h4>
                <ul class="flex flex-col gap-2">
                    <li><a class="text-gray-500 text-sm hover:underline hover:text-indigo-600 transition-all" href="{{ route('pages.privacy') }}">Confidentialité</a></li>
                    <li><a class="text-gray-500 text-sm hover:underline hover:text-indigo-600 transition-all" href="{{ route('pages.terms') }}">Conditions</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-8 mt-12 pt-8 border-t border-gray-200">
            <p class="text-center text-gray-500 text-xs">© 2024 Recettes App - Patrimoine Culinaire Camerounais</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>