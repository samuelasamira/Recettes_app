<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Modifier la Recette - Recettes App</title>
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
        .recipe-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
<!-- Top Navigation Bar -->
<nav class="fixed top-0 w-full z-50 bg-white/70 dark:bg-gray-900/70 backdrop-blur-md shadow-[0_20px_40px_rgba(44,47,48,0.06)]">
<div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto">
<div class="text-2xl font-bold tracking-tighter text-indigo-600 dark:text-indigo-400 font-headline">Recettes App</div>
<div class="hidden md:flex items-center gap-8 font-['Plus_Jakarta_Sans'] font-medium">
<a class="text-gray-600 dark:text-gray-400 hover:text-indigo-500 transition-colors duration-300" href="{{ route('recipes.index') }}">Accueil</a>
<a class="text-indigo-600 dark:text-indigo-400 border-b-2 border-indigo-600 pb-1" href="{{ route('recipes.index') }}">Recettes</a>
<a class="text-gray-600 dark:text-gray-400 hover:text-indigo-500 transition-colors duration-300" href="{{ route('dashboard') }}">Tableau de bord</a>
</div>
<div class="flex items-center gap-4">
<a href="{{ route('recipes.create') }}" class="recipe-gradient text-white px-6 py-2 rounded-lg font-medium shadow-lg hover:scale-95 transition-all duration-200">+ Nouvelle recette</a>
<div class="w-10 h-10 rounded-full overflow-hidden ring-2 ring-indigo-100">
@auth
<img alt="Avatar" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=667eea&color=fff"/>
@else
<img alt="Avatar" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=Guest&background=667eea&color=fff"/>
@endauth
</div>
</div>
</div>
</nav>

<main class="pt-28 pb-20 px-6 max-w-5xl mx-auto">
<!-- Header Section -->
<header class="mb-12">
<h1 class="font-headline font-extrabold text-4xl tracking-tight text-on-surface mb-2">Modifier la Recette</h1>
<p class="text-on-surface-variant font-medium">Ajustez les saveurs et les détails de votre chef-d'œuvre culinaire.</p>
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

<!-- Edit Form Canvas -->
<form method="POST" action="{{ route('recipes.update', $recipe) }}" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
    @csrf
    @method('PUT')
    
    <!-- Left Column: Media & Meta -->
    <div class="lg:col-span-1 space-y-8">
        <!-- Image Preview Card -->
        <div class="bg-surface-container-lowest p-4 rounded-xl shadow-[0_20px_40px_rgba(44,47,48,0.06)]">
            <div class="relative group" onclick="document.getElementById('image-upload').click()">
                @if($recipe->image_path)
                    <img id="preview-img" src="{{ $recipe->image_path }}" alt="{{ $recipe->title }}" class="w-full aspect-square object-cover rounded-lg cursor-pointer">
                @else
                    <div id="preview-placeholder" class="w-full aspect-square bg-surface-container-low rounded-lg flex items-center justify-center cursor-pointer">
                        <span class="material-symbols-outlined text-6xl text-outline">restaurant</span>
                    </div>
                    <img id="preview-img" class="w-full aspect-square object-cover rounded-lg hidden cursor-pointer" alt="Aperçu">
                @endif
                <div class="absolute inset-0 bg-on-surface/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg cursor-pointer">
                    <span class="material-symbols-outlined text-white text-4xl">photo_camera</span>
                </div>
            </div>
            <input type="file" name="image" accept="image/*" class="hidden" id="image-upload"/>
            <p class="mt-4 text-center text-xs font-label uppercase tracking-widest text-on-surface-variant">Cliquer pour changer l'image</p>
        </div>

        <!-- Metrics Selection -->
        <div class="bg-surface-container-low p-6 rounded-xl space-y-4">
            <h3 class="font-headline font-bold text-sm tracking-wide uppercase">Paramètres</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-label mb-2 text-on-surface-variant uppercase tracking-wider">Difficulté</label>
                    <div class="flex gap-2">
                        <button type="button" class="flex-1 py-2 text-xs rounded-lg border transition-all difficulty-btn {{ $recipe->difficulty == 'facile' ? 'bg-primary text-white border-primary' : 'bg-surface-container-lowest border-outline-variant/30 text-on-surface-variant' }}" data-value="facile">Facile</button>
                        <button type="button" class="flex-1 py-2 text-xs rounded-lg border transition-all difficulty-btn {{ $recipe->difficulty == 'moyen' ? 'bg-primary text-white border-primary' : 'bg-surface-container-lowest border-outline-variant/30 text-on-surface-variant' }}" data-value="moyen">Moyen</button>
                        <button type="button" class="flex-1 py-2 text-xs rounded-lg border transition-all difficulty-btn {{ $recipe->difficulty == 'difficile' ? 'bg-primary text-white border-primary' : 'bg-surface-container-lowest border-outline-variant/30 text-on-surface-variant' }}" data-value="difficile">Expert</button>
                    </div>
                    <input type="hidden" name="difficulty" id="difficulty-input" value="{{ $recipe->difficulty }}">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-label mb-2 text-on-surface-variant uppercase tracking-wider">⏱️ Préparation (min)</label>
                        <input class="w-full px-4 py-3 bg-surface-container-lowest rounded-lg border-none focus:ring-2 focus:ring-primary/40 font-medium" type="number" name="prep_time" value="{{ $recipe->prep_time }}" required/>
                    </div>
                    <div>
                        <label class="block text-xs font-label mb-2 text-on-surface-variant uppercase tracking-wider">🔥 Cuisson (min)</label>
                        <input class="w-full px-4 py-3 bg-surface-container-lowest rounded-lg border-none focus:ring-2 focus:ring-primary/40 font-medium" type="number" name="cook_time" value="{{ $recipe->cook_time }}" required/>
                    </div>
                    <div>
                        <label class="block text-xs font-label mb-2 text-on-surface-variant uppercase tracking-wider">🍽️ Portions</label>
                        <input class="w-full px-4 py-3 bg-surface-container-lowest rounded-lg border-none focus:ring-2 focus:ring-primary/40 font-medium" type="number" name="servings" value="{{ $recipe->servings }}" required/>
                    </div>
                    <div>
                        <label class="block text-xs font-label mb-2 text-on-surface-variant uppercase tracking-wider">🏷️ Type</label>
                        <input class="w-full px-4 py-3 bg-surface-container-lowest rounded-lg border-none focus:ring-2 focus:ring-primary/40 font-medium" type="text" name="cuisine_type" value="{{ $recipe->cuisine_type }}" required/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Form Fields -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-[0_20px_40px_rgba(44,47,48,0.06)] space-y-6">
            <!-- Recipe Title -->
            <div>
                <label class="block text-xs font-label font-bold text-on-surface-variant mb-2 uppercase tracking-widest">Nom de la Recette</label>
                <input class="w-full px-4 py-4 bg-surface-container-low rounded-lg border-none focus:ring-2 focus:ring-primary/40 text-xl font-headline font-bold text-on-surface" type="text" name="title" value="{{ $recipe->title }}" required/>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-label font-bold text-on-surface-variant mb-2 uppercase tracking-widest">Description</label>
                <textarea class="w-full px-4 py-4 bg-surface-container-low rounded-lg border-none focus:ring-2 focus:ring-primary/40 leading-relaxed" name="description" rows="4" required>{{ $recipe->description }}</textarea>
            </div>

            <!-- Ingredients List -->
            <div class="pt-4">
                <div class="flex justify-between items-end mb-4">
                    <label class="block text-xs font-label font-bold text-on-surface-variant uppercase tracking-widest">Ingrédients</label>
                    <button type="button" class="text-primary text-xs font-bold hover:underline" onclick="addIngredient()">+ Ajouter</button>
                </div>
                <div id="ingredients-container" class="space-y-3">
                    @foreach($recipe->ingredients as $index => $ingredient)
                    <div class="flex gap-3 ingredient-row">
                        <select name="ingredients[{{ $index }}][id]" class="flex-grow px-4 py-3 bg-surface-container-low rounded-lg border-none focus:ring-2 focus:ring-primary/20">
                            <option value="">Sélectionner un ingrédient</option>
                            @foreach($allIngredients as $ing)
                                <option value="{{ $ing->id }}" {{ $ing->id == $ingredient->id ? 'selected' : '' }}>{{ $ing->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="ingredients[{{ $index }}][quantity]" class="w-32 px-4 py-3 bg-surface-container-low rounded-lg border-none focus:ring-2 focus:ring-primary/20" placeholder="Quantité" value="{{ $ingredient->pivot->quantity }}" required/>
                        <button type="button" class="p-3 text-error/60 hover:text-error" onclick="removeIngredient(this)">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Instructions -->
            <div>
                <label class="block text-xs font-label font-bold text-on-surface-variant mb-2 uppercase tracking-widest">Instructions</label>
                <textarea class="w-full px-4 py-4 bg-surface-container-low rounded-lg border-none focus:ring-2 focus:ring-primary/40 leading-relaxed" name="instructions" rows="8" required>{{ $recipe->instructions }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-surface-container-high">
                <button type="submit" class="flex-1 recipe-gradient text-white font-bold py-4 rounded-lg shadow-xl hover:opacity-90 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">save</span>
                    Enregistrer les modifications
                </button>
                <a href="{{ route('recipes.show', $recipe) }}" class="flex-1 bg-surface-container-highest text-on-surface-variant font-bold py-4 rounded-lg hover:bg-surface-variant transition-all text-center">
                    Annuler
                </a>
            </div>
        </div>
    </div>
</form>
</main>

<!-- Footer -->
<footer class="bg-gray-100 dark:bg-gray-950 w-full py-12 mt-auto">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-8 max-w-7xl mx-auto">
<div class="space-y-4">
<div class="text-lg font-bold text-gray-900 dark:text-gray-100 font-headline">Recettes App</div>
<p class="font-['Manrope'] text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                    © 2024 Recettes App - Patrimoine Culinaire Camerounais
                </p>
</div>
<div class="space-y-4">
<h4 class="font-bold text-on-surface">Explorer</h4>
<ul class="font-['Manrope'] text-sm space-y-2">
<li><a class="text-gray-500 dark:text-gray-400 hover:underline transition-all" href="#">À propos</a></li>
<li><a class="text-gray-500 dark:text-gray-400 hover:underline transition-all" href="#">Contact</a></li>
</ul>
</div>
<div class="space-y-4">
<h4 class="font-bold text-on-surface">Légal</h4>
<ul class="font-['Manrope'] text-sm space-y-2">
<li><a class="text-gray-500 dark:text-gray-400 hover:underline transition-all" href="#">Confidentialité</a></li>
<li><a class="text-gray-500 dark:text-gray-400 hover:underline transition-all" href="#">Conditions</a></li>
</ul>
</div>
<div class="space-y-4">
<h4 class="font-bold text-on-surface">Suivez-nous</h4>
<div class="flex gap-4">
<span class="material-symbols-outlined text-indigo-600 cursor-pointer">public</span>
<span class="material-symbols-outlined text-indigo-600 cursor-pointer">share</span>
<span class="material-symbols-outlined text-indigo-600 cursor-pointer">restaurant</span>
</div>
</div>
</div>
</footer>

<script>
    let ingredientCount = {{ $recipe->ingredients->count() }};
    
    function addIngredient() {
        const container = document.getElementById('ingredients-container');
        const index = ingredientCount++;
        
        const html = `
            <div class="flex gap-3 ingredient-row animate-fade-in">
                <select name="ingredients[${index}][id]" class="flex-grow px-4 py-3 bg-surface-container-low rounded-lg border-none focus:ring-2 focus:ring-primary/20">
                    <option value="">Sélectionner un ingrédient</option>
                    @foreach($allIngredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="ingredients[${index}][quantity]" class="w-32 px-4 py-3 bg-surface-container-low rounded-lg border-none focus:ring-2 focus:ring-primary/20" placeholder="Quantité" required/>
                <button type="button" class="p-3 text-error/60 hover:text-error" onclick="removeIngredient(this)">
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
    
    // Gestion de la difficulté
    document.querySelectorAll('.difficulty-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            document.getElementById('difficulty-input').value = value;
            
            document.querySelectorAll('.difficulty-btn').forEach(b => {
                if (b.getAttribute('data-value') === value) {
                    b.classList.add('bg-primary', 'text-white', 'border-primary');
                    b.classList.remove('bg-surface-container-lowest', 'text-on-surface-variant', 'border-outline-variant/30');
                } else {
                    b.classList.remove('bg-primary', 'text-white', 'border-primary');
                    b.classList.add('bg-surface-container-lowest', 'text-on-surface-variant', 'border-outline-variant/30');
                }
            });
        });
    });
    
    // Preview image
    document.getElementById('image-upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview-img').src = event.target.result;
                document.getElementById('preview-img').classList.remove('hidden');
                if (document.getElementById('preview-placeholder')) {
                    document.getElementById('preview-placeholder').classList.add('hidden');
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>