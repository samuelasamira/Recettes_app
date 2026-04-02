<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>S'inscrire - Recettes App</title>
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
        .editorial-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface min-h-screen flex items-center justify-center p-0 md:p-6">
<main class="w-full max-w-6xl min-h-[921px] grid grid-cols-1 md:grid-cols-2 bg-surface-container-lowest rounded-none md:rounded-xl overflow-hidden shadow-[0_20px_40px_rgba(44,47,48,0.06)]">
<section class="relative hidden md:block overflow-hidden">
<div class="absolute inset-0 z-0">
<img alt="Chef prepping" class="w-full h-full object-cover" src="https://i.pinimg.com/736x/b7/8d/5d/b78d5d6a62c38abae61c10afc9a2a572.jpg"/>
</div>
<div class="absolute inset-0 z-10 editorial-gradient opacity-85"></div>
<div class="absolute inset-0 z-20 flex flex-col justify-between p-12 text-on-primary">
<div>
<h1 class="font-headline font-extrabold text-4xl tracking-tighter mb-4">Recettes App</h1>
<p class="font-body text-lg max-w-sm opacity-90">Rejoignez la plus grande communauté dédiée à l'héritage culinaire camerounais.</p>
</div>
<div class="glass-panel p-8 rounded-xl border border-white/20">
<p class="font-headline font-semibold text-xl text-on-surface mb-2">"La cuisine est le cœur d'une maison."</p>
<p class="font-label text-sm uppercase tracking-widest text-on-surface-variant">Tradition &amp; Innovation</p>
</div>
</div>
</section>
<section class="flex flex-col justify-center px-8 md:px-16 py-12 bg-surface-container-lowest">
<div class="max-w-md w-full mx-auto">
<header class="mb-10">
<h2 class="font-headline font-bold text-3xl text-on-surface mb-2">Créer un compte</h2>
<p class="text-on-surface-variant">Commencez votre voyage culinaire dès aujourd'hui.</p>
</header>

<!-- Affichage des erreurs -->
@if ($errors->any())
    <div class="mb-6 p-4 rounded-lg bg-error-container/20 border border-error/30">
        <ul class="list-disc list-inside text-error text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}" class="space-y-6">
    @csrf

    <div>
        <label class="block font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2 ml-1" for="name">Nom complet</label>
        <input class="w-full px-5 py-4 bg-surface-container-low border-none rounded-lg focus:ring-2 focus:ring-primary/40 text-on-surface placeholder:text-outline-variant transition-all duration-300" id="name" name="name" value="{{ old('name') }}" placeholder="Jean Dupont" type="text" required autofocus>
    </div>

    <div>
        <label class="block font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2 ml-1" for="email">Adresse Email</label>
        <input class="w-full px-5 py-4 bg-surface-container-low border-none rounded-lg focus:ring-2 focus:ring-primary/40 text-on-surface placeholder:text-outline-variant transition-all duration-300" id="email" name="email" value="{{ old('email') }}" placeholder="chef@recettes.cm" type="email" required>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2 ml-1" for="password">Mot de passe</label>
            <input class="w-full px-5 py-4 bg-surface-container-low border-none rounded-lg focus:ring-2 focus:ring-primary/40 text-on-surface placeholder:text-outline-variant transition-all duration-300" id="password" name="password" placeholder="••••••••" type="password" required>
        </div>
        <div>
            <label class="block font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2 ml-1" for="password_confirmation">Confirmer</label>
            <input class="w-full px-5 py-4 bg-surface-container-low border-none rounded-lg focus:ring-2 focus:ring-primary/40 text-on-surface placeholder:text-outline-variant transition-all duration-300" id="password_confirmation" name="password_confirmation" placeholder="••••••••" type="password" required>
        </div>
    </div>

    <div class="flex items-start gap-3 py-2">
        <div class="flex items-center h-5">
            <input class="h-5 w-5 rounded border-outline-variant text-primary focus:ring-primary/40 bg-surface-container-low" id="terms" name="terms" type="checkbox" required>
        </div>
        <label class="text-sm text-on-surface-variant leading-tight" for="terms">
            J'accepte les <a class="text-primary font-semibold hover:underline" href="#">Conditions d'utilisation</a> et la <a class="text-primary font-semibold hover:underline" href="#">Politique de confidentialité</a>.
        </label>
    </div>

    <button class="w-full py-4 editorial-gradient text-on-primary font-headline font-bold rounded-lg shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all duration-300" type="submit">
        S'inscrire
    </button>
</form>

<div class="mt-10 pt-8 border-t border-surface-container">
    <p class="text-center text-on-surface-variant">
        Déjà un compte ? 
        <a class="text-primary font-bold hover:underline ml-1" href="{{ route('login') }}">Se connecter</a>
    </p>
</div>
</div>
<footer class="mt-auto pt-12">
    <p class="text-center font-label text-[10px] uppercase tracking-[0.2em] text-outline">
        © 2024 Recettes App — Cameroonian Culinary Heritage
    </p>
</footer>
</section>
</main>
<div class="fixed inset-0 -z-50 md:hidden">
<img alt="Chef background" class="w-full h-full object-cover" src="https://i.pinimg.com/736x/b7/8d/5d/b78d5d6a62c38abae61c10afc9a2a572.jpg"/>
<div class="absolute inset-0 bg-surface/90 backdrop-blur-sm"></div>
</div>
</body>
</html>