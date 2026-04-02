<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Créer une Recette - Recettes App</title>
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
              "on-primary-container": "#001867",
              "success-green": "#28a745"
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
            vertical-align: middle;
        }
        body { font-family: 'Manrope', sans-serif; }
        h1, h2, h3 { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-md shadow-[0_20px_40px_rgba(44,47,48,0.06)]">
<div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto">
<div class="text-2xl font-bold tracking-tighter text-indigo-600">Recettes App</div>
<div class="hidden md:flex items-center space-x-8">
<a class="text-gray-600 hover:text-indigo-500 transition-colors duration-300 font-medium" href="{{ route('recipes.index') }}">Accueil</a>
<a class="text-gray-600 hover:text-indigo-500 transition-colors duration-300 font-medium" href="{{ route('recipes.index') }}">Recettes</a>
<a class="text-gray-600 hover:text-indigo-500 transition-colors duration-300 font-medium" href="{{ route('dashboard') }}">Tableau de bord</a>
</div>
<div class="flex items-center space-x-6">
<a href="{{ route('recipes.create') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition-all transform active:scale-95 duration-200">+ Nouvelle recette</a>
<div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary-container">
@auth
<img alt="Avatar" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=667eea&color=fff"/>
@else
<img alt="Avatar" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=Guest&background=667eea&color=fff"/>
@endauth
</div>
</div>
</div>
</nav>

<!-- Main Content -->
<main class="flex-grow pt-32 pb-20 px-6 max-w-5xl mx-auto w-full">
<!-- Header Section -->
<header class="mb-12">
<div class="flex flex-col gap-2">
<span class="text-xs font-extrabold uppercase tracking-[0.2em] text-primary">Nouveau Contenu</span>
<h1 class="text-5xl font-extrabold tracking-tight text-on-surface">Partagez votre héritage culinaire</h1>
<p class="text-on-surface-variant text-lg max-w-2xl mt-4">Documentez vos secrets de cuisine avec précision. Notre interface éditoriale transforme vos étapes en une expérience gastronomique visuelle.</p>
</div>
</header>

<!-- Affichage des erreurs -->
@if ($errors->any())
    <div class="mb-6 p-4 rounded-lg bg-error/10 border border-error/30">
        <ul class="list-disc list-inside text-error text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-12">
    @csrf
    
    <!-- Left Column: Primary Info & Image -->
    <div class="lg:col-span-7 space-y-12">
        <!-- Section 1: Identity -->
        <section class="space-y-6">
            <div class="flex items-center gap-3">
                <span class="w-8 h-[2px] bg-primary"></span>
                <h2 class="text-xl font-bold">Identité de la Recette</h2>
            </div>
            <div class="space-y-4">
                <label class="block group">
                    <span class="text-sm font-bold text-on-surface-variant mb-2 block group-focus-within:text-primary transition-colors">Titre de la recette *</span>
                    <input class="w-full bg-surface-container-lowest border-none rounded-xl p-4 shadow-sm focus:ring-2 focus:ring-primary/40 transition-all placeholder:text-outline-variant" name="title" value="{{ old('title') }}" placeholder="ex: Poulet DG Traditionnel" type="text" required/>
                </label>
                <label class="block group">
                    <span class="text-sm font-bold text-on-surface-variant mb-2 block group-focus-within:text-primary transition-colors">Description / Histoire *</span>
                    <textarea class="w-full bg-surface-container-lowest border-none rounded-xl p-4 shadow-sm focus:ring-2 focus:ring-primary/40 transition-all placeholder:text-outline-variant" name="description" placeholder="Racontez l'origine de ce plat ou ce qui le rend spécial..." rows="4" required>{{ old('description') }}</textarea>
                </label>
            </div>
        </section>

        <!-- Section 2: Instructions -->
        <section class="space-y-6">
            <div class="flex items-center gap-3">
                <span class="w-8 h-[2px] bg-primary"></span>
                <h2 class="text-xl font-bold">Instructions de Préparation</h2>
            </div>
            <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border-l-4 border-tertiary-container">
                <textarea class="w-full border-none focus:ring-0 p-0 text-on-surface bg-transparent resize-none leading-relaxed" name="instructions" placeholder="Étape 1: Nettoyer soigneusement les condiments...&#10;Étape 2: Faire revenir les oignons...&#10;Étape 3: Ajouter les épices..." rows="10" required>{{ old('instructions') }}</textarea>
            </div>
            <p class="text-xs text-on-surface-variant">💡 Séparez chaque étape par un saut de ligne pour une meilleure lisibilité.</p>
        </section>

        <!-- Section 3: Ingredients Builder -->
        <section class="space-y-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-[2px] bg-primary"></span>
                    <h2 class="text-xl font-bold">Ingrédients</h2>
                </div>
                <button type="button" class="flex items-center gap-2 text-primary font-bold text-sm hover:underline" onclick="addIngredient()">
                    <span class="material-symbols-outlined text-lg">add_circle</span>
                    Ajouter un ingrédient
                </button>
            </div>
            <div id="ingredients-container" class="space-y-3">
                <div class="flex gap-4 items-center ingredient-row">
                    <div class="flex-grow grid grid-cols-3 gap-3">
                        <input class="col-span-1 bg-surface-container-lowest border-none rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-primary/40" name="ingredients[0][quantity]" placeholder="Quantité (ex: 500g)" type="text"/>
                        <select name="ingredients[0][id]" class="col-span-2 bg-surface-container-lowest border-none rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-primary/40">
                            <option value="">Sélectionner un ingrédient</option>
                            @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="p-2 text-outline hover:text-error transition-colors" onclick="removeIngredient(this)">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>
        </section>
    </div>

    <!-- Right Column: Settings & Media -->
    <div class="lg:col-span-5 space-y-8">
        <div class="sticky top-28 space-y-8">
            <!-- Media Upload Preview -->
            <section class="bg-surface-container-low rounded-3xl p-8 border-2 border-dashed border-outline-variant/30 text-center space-y-4">
                <div class="w-20 h-20 bg-primary-container/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-primary text-4xl">cloud_upload</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Image de couverture</h3>
                    <p class="text-sm text-on-surface-variant mt-1">Glissez une photo haute résolution pour illustrer votre chef-d'œuvre.</p>
                </div>
                <input type="file" name="image" accept="image/*" class="hidden" id="image-upload"/>
                <button type="button" class="px-6 py-2 bg-surface-container-lowest text-primary font-bold rounded-lg shadow-sm hover:shadow-md transition-all" onclick="document.getElementById('image-upload').click()">
                    Parcourir les fichiers
                </button>
                <div id="image-preview" class="hidden mt-4">
                    <img id="preview-img" class="rounded-xl max-h-48 mx-auto" alt="Aperçu"/>
                </div>
            </section>

            <!-- Metrics & Taxonomy -->
            <section class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm space-y-8">
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-outline-variant mb-4 block">Paramètres de cuisine</span>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="block">
                            <span class="text-xs font-bold mb-2 block">⏱️ Préparation (min) *</span>
                            <input class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-primary/40" name="prep_time" value="{{ old('prep_time') }}" placeholder="20" type="number" required/>
                        </label>
                        <label class="block">
                            <span class="text-xs font-bold mb-2 block">🔥 Cuisson (min) *</span>
                            <input class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-primary/40" name="cook_time" value="{{ old('cook_time') }}" placeholder="45" type="number" required/>
                        </label>
                        <label class="block">
                            <span class="text-xs font-bold mb-2 block">🍽️ Portions *</span>
                            <input class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-primary/40" name="servings" value="{{ old('servings') }}" placeholder="4" type="number" required/>
                        </label>
                        <label class="block">
                            <span class="text-xs font-bold mb-2 block">📊 Difficulté *</span>
                            <select class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-primary/40 appearance-none" name="difficulty" required>
                                <option value="facile" {{ old('difficulty') == 'facile' ? 'selected' : '' }}>Facile</option>
                                <option value="moyen" {{ old('difficulty') == 'moyen' ? 'selected' : '' }}>Moyen</option>
                                <option value="difficile" {{ old('difficulty') == 'difficile' ? 'selected' : '' }}>Difficile</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-outline-variant mb-4 block">Type de Recette *</span>
                    <input class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-primary/40" name="cuisine_type" value="{{ old('cuisine_type') }}" placeholder="ex: Traditionnel, Street Food, Moderne" required/>
                </div>
                <div class="pt-4 space-y-4">
                    <button class="w-full py-4 bg-success-green text-white font-bold rounded-xl shadow-lg shadow-success-green/20 hover:scale-[1.02] active:scale-95 transition-all" type="submit">Créer la recette</button>
                    <a href="{{ route('recipes.index') }}" class="w-full py-4 bg-transparent border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-xl hover:bg-error/10 hover:border-error/20 hover:text-error transition-all text-center block">Annuler</a>
                </div>
            </section>
        </div>
    </div>
</form>
</main>

<!-- Footer -->
<footer class="bg-gray-100 py-12 mt-auto">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-8 max-w-7xl mx-auto">
<div class="col-span-1">
<div class="text-lg font-bold text-gray-900 mb-4">Recettes App</div>
<p class="text-sm text-gray-500 leading-relaxed">Célébrer et préserver l'héritage culinaire camerounais à travers une expérience numérique moderne.</p>
</div>
<div>
<h4 class="font-bold text-sm mb-4">Explorer</h4>
<ul class="space-y-2 text-sm text-gray-500">
<li><a class="hover:underline hover:text-indigo-600 transition-all" href="#">À propos</a></li>
<li><a class="hover:underline hover:text-indigo-600 transition-all" href="#">Contact</a></li>
</ul>
</div>
<div>
<h4 class="font-bold text-sm mb-4">Légal</h4>
<ul class="space-y-2 text-sm text-gray-500">
<li><a class="hover:underline hover:text-indigo-600 transition-all" href="#">Confidentialité</a></li>
<li><a class="hover:underline hover:text-indigo-600 transition-all" href="#">Conditions</a></li>
</ul>
</div>
<div>
<h4 class="font-bold text-sm mb-4">Newsletter</h4>
<div class="flex gap-2">
<input class="bg-white border-none rounded-lg p-2 text-sm w-full shadow-sm" placeholder="Votre email" type="email"/>
<button class="bg-indigo-600 text-white p-2 rounded-lg"><span class="material-symbols-outlined text-sm">send</span></button>
</div>
</div>
</div>
<div class="max-w-7xl mx-auto px-8 mt-12 pt-8 border-t border-gray-200 text-center">
<p class="text-xs text-gray-400">© 2024 Recettes App - Patrimoine Culinaire Camerounais</p>
</div>
</footer>

<script>
    let ingredientCount = 1;
    
    function addIngredient() {
        const container = document.getElementById('ingredients-container');
        const index = ingredientCount++;
        
        const html = `
            <div class="flex gap-4 items-center ingredient-row animate-fade-in">
                <div class="flex-grow grid grid-cols-3 gap-3">
                    <input class="col-span-1 bg-surface-container-lowest border-none rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-primary/40" name="ingredients[${index}][quantity]" placeholder="Quantité (ex: 500g)" type="text"/>
                    <select name="ingredients[${index}][id]" class="col-span-2 bg-surface-container-lowest border-none rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-primary/40">
                        <option value="">Sélectionner un ingrédient</option>
                        @foreach($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" class="p-2 text-outline hover:text-error transition-colors" onclick="removeIngredient(this)">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', html);
    }
    
    function removeIngredient(button) {
        const rows = document.querySelectorAll('.ingredient-row').length;
        if (rows > 1) {
            button.closest('.ingredient-row').remove();
        } else {
            alert('Vous devez avoir au moins un ingrédient!');
        }
    }
    
    // Preview image
    document.getElementById('image-upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview-img').src = event.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>