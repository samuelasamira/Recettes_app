<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Tableau de bord | Recettes App</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Manrope:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "error": "#b41340",
              "inverse-on-surface": "#9b9d9e",
              "on-primary-fixed": "#000000",
              "primary-fixed": "#859aff",
              "outline": "#757778",
              "tertiary-fixed-dim": "#ee88d8",
              "surface-variant": "#dadddf",
              "primary-fixed-dim": "#748cf9",
              "surface": "#f5f6f7",
              "tertiary-dim": "#832c76",
              "surface-dim": "#d1d5d7",
              "surface-container-lowest": "#ffffff",
              "surface-bright": "#f5f6f7",
              "on-secondary-fixed": "#481c73",
              "error-dim": "#a70138",
              "on-error": "#ffefef",
              "on-error-container": "#510017",
              "inverse-primary": "#7991ff",
              "secondary-fixed-dim": "#dab4ff",
              "on-secondary-fixed-variant": "#663c92",
              "on-primary-fixed-variant": "#00207e",
              "secondary-container": "#e4c6ff",
              "secondary": "#72479e",
              "inverse-surface": "#0c0f10",
              "primary-dim": "#2b45af",
              "on-tertiary-fixed": "#42003b",
              "primary-container": "#859aff",
              "surface-tint": "#3952bc",
              "on-tertiary": "#ffeef6",
              "surface-container-highest": "#dadddf",
              "on-secondary-container": "#5d3288",
              "on-surface": "#2c2f30",
              "outline-variant": "#abadae",
              "primary": "#3952bc",
              "on-background": "#2c2f30",
              "tertiary-container": "#fd95e6",
              "secondary-dim": "#653b91",
              "tertiary-fixed": "#fd95e6",
              "surface-container-high": "#e0e3e4",
              "on-primary": "#f2f1ff",
              "surface-container-low": "#eff1f2",
              "on-tertiary-fixed-variant": "#6f1964",
              "tertiary": "#913983",
              "secondary-fixed": "#e4c6ff",
              "background": "#f5f6f7",
              "error-container": "#f74b6d",
              "on-secondary": "#fbefff",
              "on-surface-variant": "#595c5d",
              "on-tertiary-container": "#640d5a",
              "surface-container": "#e6e8ea",
              "on-primary-container": "#001867"
            },
            fontFamily: {
              "headline": ["Plus Jakarta Sans"],
              "body": ["Manrope"],
              "label": ["Manrope"]
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
          },
        },
      }
    </script>
<style>
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      }
      .glass-effect {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
      }
      .editorial-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
<!-- TopNavBar Component -->
<header class="fixed top-0 w-full z-50 bg-white/70 dark:bg-gray-900/70 backdrop-blur-md shadow-[0_20px_40px_rgba(44,47,48,0.06)]">
<div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto font-['Plus_Jakarta_Sans'] font-medium">
<div class="text-2xl font-bold tracking-tighter text-indigo-600 dark:text-indigo-400">Recettes App</div>
<nav class="hidden md:flex items-center gap-8">
<a class="text-gray-600 dark:text-gray-400 hover:text-indigo-500 transition-colors duration-300" href="{{ route('recipes.index') }}">Recettes</a>
<a class="text-indigo-600 dark:text-indigo-400 border-b-2 border-indigo-600 pb-1 hover:text-indigo-500 transition-colors duration-300" href="{{ route('dashboard') }}">Tableau de bord</a>
</nav>
<div class="flex items-center gap-6">
<a href="{{ route('recipes.create') }}" class="editorial-gradient text-white px-5 py-2.5 rounded-lg font-semibold hover:opacity-90 transition-all scale-95 duration-200 ease-in-out">+ Nouvelle recette</a>
<div class="w-10 h-10 rounded-full bg-surface-container overflow-hidden">
<img alt="Avatar" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=667eea&color=fff"/>
</div>
</div>
</div>
</header>

<main class="pt-32 pb-20 px-8 max-w-7xl mx-auto min-h-screen">
<!-- Hero Profile Section -->
<section class="mb-16">
<div class="relative bg-surface-container-lowest rounded-xl p-8 overflow-hidden shadow-[0_20px_40px_rgba(44,47,48,0.06)] flex flex-col md:flex-row items-center gap-10">
<div class="absolute top-0 right-0 w-64 h-64 editorial-gradient opacity-5 rounded-full -mr-20 -mt-20"></div>
<div class="relative z-10">
<div class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden">
<img alt="Profile" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=667eea&color=fff&size=128"/>
</div>
</div>
<div class="relative z-10 flex-1 text-center md:text-left">
<span class="text-primary font-bold uppercase tracking-[0.2em] text-[0.65rem] mb-2 block">Membre Premium</span>
<h1 class="font-headline text-4xl font-extrabold text-on-surface mb-1">{{ Auth::user()->name }}</h1>
<p class="text-on-surface-variant mb-6 font-medium">{{ Auth::user()->email }}</p>
<div class="flex flex-wrap justify-center md:justify-start gap-4">
<div class="bg-surface-container-low px-4 py-2 rounded-full flex items-center gap-2">
<span class="text-lg">🥘</span>
<span class="text-sm font-semibold">{{ $userRecipesCount }} Recettes</span>
</div>
<div class="bg-surface-container-low px-4 py-2 rounded-full flex items-center gap-2">
<span class="text-lg">⭐</span>
<span class="text-sm font-semibold">{{ number_format($averageRating, 1) }} Rating</span>
</div>
<div class="bg-surface-container-low px-4 py-2 rounded-full flex items-center gap-2">
<span class="text-lg">🏅</span>
<span class="text-sm font-semibold">Chef Passionné</span>
</div>
</div>
</div>
<div class="relative z-10 flex flex-col gap-3">
<a href="{{ route('profile.edit') }}" class="bg-surface-container-highest text-primary font-bold py-3 px-8 rounded-lg hover:bg-surface-variant transition-colors text-center">Modifier Profil</a>
<a href="{{ route('profile.edit') }}" class="text-on-surface-variant hover:text-primary font-semibold text-sm transition-colors text-center">Paramètres du compte</a>
</div>
</div>
</section>

<!-- Dashboard Bento Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
<!-- Left Column: My Recipes -->
<div class="lg:col-span-8 space-y-12">
<div>
<div class="flex justify-between items-end mb-8">
<div>
<span class="text-primary font-bold uppercase tracking-widest text-[0.7rem]">Votre cuisine</span>
<h2 class="font-headline text-2xl font-bold mt-1">Mes recettes</h2>
</div>
<a class="text-primary font-bold text-sm hover:underline" href="{{ route('recipes.index') }}">Voir tout</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @forelse($userRecipes as $recipe)
    <div class="group bg-surface-container-lowest rounded-xl overflow-hidden hover:shadow-[0_20px_40px_rgba(44,47,48,0.06)] transition-all duration-300">
        <div class="h-48 overflow-hidden">
            @if($recipe->image_path)
                <img src="{{ $recipe->image_path }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <div class="w-full h-full editorial-gradient flex items-center justify-center">
                    <span class="text-4xl">🍳</span>
                </div>
            @endif
        </div>
        <div class="p-6">
            <div class="flex gap-2 mb-3">
                <span class="bg-surface-container-low px-2 py-1 rounded text-[0.65rem] font-bold uppercase tracking-tight">{{ $recipe->cuisine_type }}</span>
            </div>
            <h3 class="font-headline font-bold text-lg mb-2">{{ $recipe->title }}</h3>
            <div class="flex items-center gap-4 text-on-surface-variant text-xs">
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">schedule</span> {{ $recipe->prep_time + $recipe->cook_time }} min</span>
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">group</span> {{ $recipe->servings }} pers.</span>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-2 text-center py-10">
        <p class="text-on-surface-variant">Vous n'avez pas encore de recettes</p>
        <a href="{{ route('recipes.create') }}" class="inline-block mt-3 text-primary font-bold">Créer ma première recette →</a>
    </div>
    @endforelse
</div>
</div>

<!-- My Favorites Section -->
<div>
<div class="flex justify-between items-end mb-8">
<div>
<span class="text-primary font-bold uppercase tracking-widest text-[0.7rem]">Coups de coeur</span>
<h2 class="font-headline text-2xl font-bold mt-1">Mes favoris</h2>
</div>
<a class="text-primary font-bold text-sm hover:underline" href="{{ route('recipes.index') }}">Explorer</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse($favoriteRecipes as $favorite)
    <div class="bg-surface-container-lowest p-3 rounded-lg flex items-center gap-3 group cursor-pointer hover:bg-primary-container/10 transition-colors">
        <div class="w-12 h-12 rounded-lg overflow-hidden flex-shrink-0">
            @if($favorite->image_path)
                <img src="{{ $favorite->image_path }}" alt="{{ $favorite->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full editorial-gradient flex items-center justify-center">
                    <span class="text-xl">🍳</span>
                </div>
            @endif
        </div>
        <div class="overflow-hidden">
            <h4 class="font-headline font-bold text-sm truncate">{{ $favorite->title }}</h4>
            <p class="text-[0.65rem] text-on-surface-variant">Par {{ $favorite->user->name }}</p>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-6">
        <p class="text-on-surface-variant text-sm">Aucun favori pour le moment</p>
        <a href="{{ route('recipes.index') }}" class="inline-block mt-2 text-primary text-sm font-bold">Découvrir des recettes →</a>
    </div>
    @endforelse
</div>
</div>
</div>

<!-- Right Column: Recent Activity -->
<div class="lg:col-span-4">
<div class="bg-surface-container-low rounded-xl p-8 h-full">
<span class="text-primary font-bold uppercase tracking-widest text-[0.7rem]">Fil d'actualité</span>
<h2 class="font-headline text-2xl font-bold mt-1 mb-8">Mes notes récentes</h2>
<div class="space-y-8">
    @forelse($recentRatings as $rating)
    <div class="relative pl-8 before:content-[''] before:absolute before:left-0 before:top-2 before:w-3 before:h-3 before:bg-primary before:rounded-full before:z-10 after:content-[''] after:absolute after:left-[5.5px] after:top-4 after:w-[1px] after:h-[calc(100%+2rem)] after:bg-outline-variant/30">
        <p class="text-xs text-on-surface-variant mb-1">{{ $rating->created_at->diffForHumans() }}</p>
        <h4 class="font-bold text-sm mb-1">Note publiée</h4>
        <p class="text-sm text-on-surface-variant">"{{ Str::limit($rating->review ?? 'Aucun commentaire', 60) }}" sur <span class="text-primary font-medium">{{ $rating->recipe->title }}</span>.</p>
        <div class="flex gap-0.5 mt-2">
            @for($i = 1; $i <= 5; $i++)
                <span class="material-symbols-outlined text-sm {{ $i <= $rating->rating ? 'text-yellow-500' : 'text-outline' }}" style="font-variation-settings: 'FILL' {{ $i <= $rating->rating ? 1 : 0 }};">star</span>
            @endfor
        </div>
    </div>
    @empty
    <p class="text-on-surface-variant text-sm text-center py-4">Aucune note récente</p>
    @endforelse
</div>

<div class="mt-12 p-6 bg-surface-container-highest rounded-lg">
<h4 class="font-headline font-bold text-sm mb-2">Statistiques du mois</h4>
<div class="space-y-4">
<div>
<div class="flex justify-between text-xs mb-1">
<span>Vues totales</span>
<span class="font-bold">{{ $totalViews }}</span>
</div>
<div class="w-full bg-surface-container rounded-full h-1.5">
<div class="editorial-gradient h-full rounded-full" style="width: {{ min(100, ($totalViews / 2000) * 100) }}%"></div>
</div>
</div>
<div>
<div class="flex justify-between text-xs mb-1">
<span>Recettes créées</span>
<span class="font-bold">{{ $userRecipesCount }}</span>
</div>
<div class="w-full bg-surface-container rounded-full h-1.5">
<div class="bg-tertiary h-full rounded-full" style="width: {{ min(100, ($userRecipesCount / 20) * 100) }}%"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</main>

<!-- Footer -->
<footer class="bg-gray-100 dark:bg-gray-950 w-full py-12 mt-auto font-['Manrope'] text-sm">
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-8 max-w-7xl mx-auto">
<div class="col-span-1">
<div class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Recettes App</div>
<p class="text-gray-500 dark:text-gray-400 leading-relaxed">Le patrimoine culinaire camerounais revisité pour les gastronomes modernes.</p>
</div>
<div>
<h5 class="font-bold text-gray-900 dark:text-gray-100 mb-4">Liens</h5>
<ul class="space-y-2">
<li><a class="text-gray-500 dark:text-gray-400 hover:underline hover:text-indigo-600 transition-all" href="#">À propos</a></li>
<li><a class="text-gray-500 dark:text-gray-400 hover:underline hover:text-indigo-600 transition-all" href="#">Confidentialité</a></li>
<li><a class="text-gray-500 dark:text-gray-400 hover:underline hover:text-indigo-600 transition-all" href="#">Contact</a></li>
<li><a class="text-gray-500 dark:text-gray-400 hover:underline hover:text-indigo-600 transition-all" href="#">Conditions</a></li>
</ul>
</div>
</div>
<div class="max-w-7xl mx-auto px-8 mt-12 pt-8 border-t border-outline-variant/10 text-center text-gray-500 dark:text-gray-400">
            © 2024 Recettes App - Patrimoine Culinaire Camerounais
        </div>
</footer>
</body>
</html>