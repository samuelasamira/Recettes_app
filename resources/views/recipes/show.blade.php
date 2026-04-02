<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Recettes App - {{ $recipe->title }}</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Manrope:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
      .recipe-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      }
      .glass-nav {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
      }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 bg-white/70 dark:bg-gray-900/70 backdrop-blur-md shadow-[0_20px_40px_rgba(44,47,48,0.06)]">
<div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto">
<div class="text-2xl font-bold tracking-tighter text-indigo-600 dark:text-indigo-400 font-headline">Recettes App</div>
<div class="hidden md:flex items-center space-x-8 font-['Plus_Jakarta_Sans'] font-medium">
<a class="text-gray-600 dark:text-gray-400 hover:text-indigo-500 transition-colors duration-300" href="{{ route('recipes.index') }}">Recettes</a>
<a class="text-indigo-600 dark:text-indigo-400 border-b-2 border-indigo-600 pb-1" href="{{ route('recipes.index') }}">Recettes</a>
<a class="text-gray-600 dark:text-gray-400 hover:text-indigo-500 transition-colors duration-300" href="{{ route('dashboard') }}">Tableau de bord</a>
</div>
<div class="flex items-center space-x-6">
<a href="{{ route('recipes.create') }}" class="bg-primary text-on-primary px-5 py-2 rounded-lg font-medium hover:opacity-90 transition-all">+ Nouvelle recette</a>
@auth
<img alt="Avatar" class="w-10 h-10 rounded-full object-cover ring-2 ring-primary-container" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=667eea&color=fff"/>
@else
<img alt="Avatar" class="w-10 h-10 rounded-full object-cover ring-2 ring-primary-container" src="https://ui-avatars.com/api/?name=Guest&background=667eea&color=fff"/>
@endauth
</div>
</div>
</nav>

<main class="pt-24 pb-20">
<!-- Hero Section -->
<div class="relative w-full h-[614px] overflow-hidden">
    @if($recipe->image_path)
        <img alt="{{ $recipe->title }}" class="w-full h-full object-cover" src="{{ $recipe->image_path }}">
    @else
        <div class="w-full h-full recipe-gradient flex items-center justify-center">
            <span class="text-8xl">🍳</span>
        </div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-full p-12 max-w-7xl mx-auto right-0 flex flex-col items-start">
        <div class="mb-4 flex gap-3">
            <span class="bg-surface-container-low/20 backdrop-blur-md text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest">{{ $recipe->cuisine_type }}</span>
            <span class="bg-surface-container-low/20 backdrop-blur-md text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest">⏱️ {{ $recipe->prep_time + $recipe->cook_time }} min</span>
        </div>
        <h1 class="text-white text-5xl md:text-7xl font-headline font-extrabold tracking-tight mb-4">{{ $recipe->title }}</h1>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-xl">
                {{ substr($recipe->user->name, 0, 1) }}
            </div>
            <div class="text-white">
                <p class="font-headline font-bold">{{ $recipe->user->name }}</p>
                <p class="text-sm opacity-80">Publié le {{ $recipe->created_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Action Bar & Core Content -->
<div class="max-w-7xl mx-auto px-8 mt-12 grid grid-cols-1 lg:grid-cols-3 gap-16">
    <!-- Left Column: Content -->
    <div class="lg:col-span-2 space-y-12">
        <!-- Action Buttons (only for owner) -->
        @auth
            @if(auth()->user()->id === $recipe->user_id)
                <div class="flex gap-4 items-center">
                    <a href="{{ route('recipes.edit', $recipe) }}" class="bg-primary text-on-primary flex items-center gap-2 px-6 py-3 rounded-xl font-headline font-bold hover:scale-[0.98] transition-transform">
                        <span class="material-symbols-outlined">edit</span>
                        Modifier
                    </a>
                    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Supprimer cette recette ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-[#dc3545] text-white flex items-center gap-2 px-6 py-3 rounded-xl font-headline font-bold hover:scale-[0.98] transition-transform">
                            <span class="material-symbols-outlined">delete</span>
                            Supprimer
                        </button>
                    </form>
                </div>
            @endif
        @endauth

        <!-- Description -->
        <section>
            <h2 class="text-xs font-bold uppercase tracking-widest text-primary mb-4 font-label">L'Histoire du Plat</h2>
            <p class="text-xl text-on-surface-variant leading-relaxed font-body">{{ $recipe->description }}</p>
        </section>

        <!-- Ingredients Grid -->
        <section class="bg-surface-container-low p-10 rounded-3xl">
            <h2 class="text-3xl font-headline font-extrabold mb-8 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">shopping_basket</span>
                Ingrédients
            </h2>
            <div class="grid md:grid-cols-2 gap-y-4 gap-x-12">
                @forelse($recipe->ingredients as $ingredient)
                    <div class="flex items-center justify-between border-b border-outline-variant/10 py-3">
                        <span class="font-body text-on-surface">{{ $ingredient->name }}</span>
                        <span class="font-headline font-bold text-primary">{{ $ingredient->pivot->quantity }}</span>
                    </div>
                @empty
                    <p class="text-on-surface-variant">Aucun ingrédient renseigné</p>
                @endforelse
            </div>
        </section>

        <!-- Instructions -->
        <section>
            <h2 class="text-3xl font-headline font-extrabold mb-8">Préparation Pas à Pas</h2>
            <div class="space-y-10">
                @php
                    $steps = explode("\n", $recipe->instructions);
                    $stepNumber = 1;
                @endphp
                @foreach($steps as $step)
                    @if(trim($step))
                        <div class="flex gap-8">
                            <div class="flex-none">
                                <span class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-lg">{{ $stepNumber++ }}</span>
                            </div>
                            <div>
                                <p class="text-on-surface-variant leading-relaxed">{{ trim($step) }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    </div>

    <!-- Right Column: Sidebar -->
    <div class="space-y-12">
        <!-- Rating Summary Card -->
        <div class="bg-surface-container-lowest p-8 rounded-3xl shadow-[0_20px_40px_rgba(44,47,48,0.06)] border border-outline-variant/5 text-center">
            <h3 class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-6 font-label">Note des gourmets</h3>
            <div class="text-6xl font-headline font-extrabold text-on-surface mb-2">{{ number_format($averageRating, 1) }}</div>
            <div class="flex justify-center gap-1 text-[#FFD700] mb-4">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= round($averageRating))
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    @elseif($i - 0.5 <= $averageRating)
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0.5;">star</span>
                    @else
                        <span class="material-symbols-outlined">star</span>
                    @endif
                @endfor
            </div>
            <p class="text-sm text-on-surface-variant font-medium">Basé sur {{ $recipe->ratings->count() }} avis vérifiés</p>
        </div>

        <!-- Rating Form -->
        @auth
            @php
                $userRating = $recipe->ratings()->where('user_id', Auth::id())->first();
            @endphp
            <div class="bg-surface-container-low p-8 rounded-3xl">
                <h3 class="text-xl font-headline font-bold mb-6">Laissez votre avis</h3>
                <form action="{{ route('ratings.store', $recipe) }}" method="POST">
                    @csrf
                    <div class="flex gap-2 text-outline mb-6" id="rating-stars">
                        <input type="hidden" name="rating" id="rating-value" value="{{ $userRating->rating ?? 0 }}">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined cursor-pointer hover:text-primary transition-colors star-rating" data-value="{{ $i }}" style="font-variation-settings: 'FILL' {{ ($userRating && $userRating->rating >= $i) ? 1 : 0 }};">star</span>
                        @endfor
                    </div>
                    <textarea name="review" class="w-full bg-surface-container-lowest border-none rounded-xl p-4 text-sm focus:ring-2 focus:ring-primary/40 min-h-[100px] mb-4" placeholder="Votre expérience culinaire...">{{ $userRating->review ?? '' }}</textarea>
                    <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-xl font-headline font-bold hover:opacity-90 transition-all">Envoyer</button>
                </form>
            </div>
        @else
            <div class="bg-surface-container-low p-8 rounded-3xl text-center">
                <p class="text-on-surface-variant">Connectez-vous pour noter cette recette</p>
                <a href="{{ route('login') }}" class="inline-block mt-4 text-primary font-bold">Se connecter</a>
            </div>
        @endauth

        <!-- Comments Section -->
        <div class="space-y-6">
            <h3 class="text-xl font-headline font-bold flex items-center gap-2">
                Commentaires
                <span class="text-sm font-normal text-on-surface-variant bg-surface-container-high px-2 py-0.5 rounded-full">{{ $recipe->comments->count() }}</span>
            </h3>
            <div class="space-y-4">
                @forelse($recipe->comments as $comment)
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <p class="font-headline font-bold text-sm">{{ $comment->user->name }}</p>
                            <span class="text-[10px] text-on-surface-variant font-label uppercase">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-on-surface-variant leading-relaxed">{{ $comment->content }}</p>
                        @auth
                            @if(auth()->user()->id === $comment->user_id)
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-error text-xs hover:underline">Supprimer</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
                @empty
                <p class="text-on-surface-variant text-sm text-center py-4">Aucun commentaire pour le moment</p>
                @endforelse
            </div>
        </div>

        <!-- Add Comment Form -->
        @auth
        <div class="bg-surface-container-low p-8 rounded-3xl">
            <h3 class="text-xl font-headline font-bold mb-4">Ajouter un commentaire</h3>
            <form action="{{ route('comments.store', $recipe) }}" method="POST">
                @csrf
                <textarea name="content" class="w-full bg-surface-container-lowest border-none rounded-xl p-4 text-sm focus:ring-2 focus:ring-primary/40 min-h-[100px] mb-4" placeholder="Partagez votre avis..." required></textarea>
                <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-xl font-headline font-bold hover:opacity-90 transition-all">Publier</button>
            </form>
        </div>
        @endauth
    </div>
</div>
</main>

<!-- Footer simplifié -->
<footer class="bg-gray-100 py-8 mt-auto">
    <div class="max-w-7xl mx-auto px-8">
        <p class="text-center text-gray-500 text-sm">© 2024 Recettes App - Patrimoine Culinaire Camerounais</p>
    </div>
</footer>

<script>
    // Script pour les étoiles de notation
    document.querySelectorAll('.star-rating').forEach(star => {
        star.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            document.getElementById('rating-value').value = value;
            
            document.querySelectorAll('.star-rating').forEach((s, index) => {
                if (index < value) {
                    s.style.fontVariationSettings = "'FILL' 1";
                } else {
                    s.style.fontVariationSettings = "'FILL' 0";
                }
            });
        });
    });
</script>
</body>
</html>