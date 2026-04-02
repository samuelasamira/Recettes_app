<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Recettes App - L'excellence Culinaire Camerounaise</title>
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
        
        /* Animation flottante pour les images */
        @keyframes float {
            0% {
                transform: scale(1) translateY(0);
            }
            50% {
                transform: scale(1.05) translateY(-20px);
            }
            100% {
                transform: scale(1) translateY(0);
            }
        }
        
        @keyframes float-slow {
            0% {
                transform: scale(1) translateY(0);
            }
            50% {
                transform: scale(1.03) translateY(-15px);
            }
            100% {
                transform: scale(1) translateY(0);
            }
        }
        
        .floating-bg {
            animation: float 20s ease-in-out infinite;
        }
        
        .floating-bg-slow {
            animation: float-slow 25s ease-in-out infinite;
        }
        
        .overlay-gradient {
            background: linear-gradient(135deg, rgba(0,0,0,0.5) 0%, rgba(102,126,234,0.3) 50%, rgba(118,75,162,0.5) 100%);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface selection:bg-primary-container selection:text-on-primary-container">
<!-- Header / TopNavBar -->
<nav class="fixed top-0 w-full z-50 bg-white/70 dark:bg-gray-900/70 backdrop-blur-md shadow-[0_20px_40px_rgba(44,47,48,0.06)]">
<div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto font-['Plus_Jakarta_Sans'] font-medium">
<div class="text-2xl font-bold tracking-tighter text-indigo-600 dark:text-indigo-400">Recettes App</div>
<div class="hidden md:flex items-center gap-8">
<a class="text-indigo-600 dark:text-indigo-400 border-b-2 border-indigo-600 pb-1 hover:text-indigo-500 transition-colors duration-300" href="{{ route('recipes.index') }}">Accueil</a>
<a class="text-gray-600 dark:text-gray-400 hover:text-indigo-500 transition-colors duration-300" href="{{ route('recipes.index') }}">Recettes</a>
<a class="text-gray-600 dark:text-gray-400 hover:text-indigo-500 transition-colors duration-300" href="{{ route('dashboard') }}">Tableau de bord</a>
</div>
<div class="flex items-center gap-6">
<a href="{{ route('recipes.create') }}" class="hidden lg:block text-indigo-600 dark:text-indigo-400 hover:scale-95 duration-200 ease-in-out font-semibold">
    + Nouvelle recette
</a>
<div class="w-10 h-10 rounded-full overflow-hidden bg-surface-container">
<img alt="Chef Profile Avatar" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzGUvOvOtRkvYMMTjQDNlwTz5rgmBflcvUR1DirtSrNic8_SNeUy3wPb1KBipmCFjoq_O95o7PGehDU_x0xlDhSb9uHP7eKyBfLnOypKw30GWioIpKmdQSN9Bc12LWMIaedIRObkjhrJeQrpwbN81YJKClsgvBy07_4LCNOt7HIYjx5yYPK8vpyM7GOVRWIXG2C-JexNXf-colCihIkkdP7A9-rCmg_vUJvv4wC_lVZN40SMvuJ9fQBPkkAp1isv1Cb2ATuArhTHuS"/>
</div>
</div>
</div>
</nav>
<!-- Main Content -->
<main>
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
<!-- Background Image with Animation -->
<div class="absolute inset-0 z-0 overflow-hidden">
<img alt="Cooking background" class="w-full h-full object-cover floating-bg" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjlB7b1jRUjTVl-l6x-mrWWVVzrDRct69t8JMrpl6oX9ufj0RXQh-uO16pzeDYvvSX_Zp-tft9xGgGt_FgoK6um914MKN43t5ifHu_xNPKH3N65l2KgvNXch-4fr_fgEotECQ9ZB6bfh1PLXPsLmRVZRRk9yaxPCtiA6-cQPz4pvoLbU7wzujpqjmxoVWeXPgdMjxVmKFIu4HfIdxTwHx0h9UTcnRsmqSqYPyKgUY8aPSnQ010Lh6jJQfeBcL_NT0sP5k62c0lU2ff"/>
<div class="absolute inset-0 editorial-gradient mix-blend-multiply opacity-60"></div>
</div>
<div class="relative z-10 max-w-5xl mx-auto px-8 text-center">
<span class="inline-block py-2 px-4 rounded-full bg-white/10 backdrop-blur-md text-white text-xs font-bold tracking-[0.2em] uppercase mb-6">L'art de la table</span>
<h1 class="font-headline font-extrabold text-5xl md:text-7xl lg:text-8xl text-white tracking-tighter mb-8 leading-[1.1]">
                    🍳 Recettes App
                </h1>
<p class="font-body text-xl md:text-2xl text-white/90 max-w-2xl mx-auto mb-12 font-light leading-relaxed">
                    Découvrez et partagez l'excellence culinaire camerounaise à travers une plateforme élégante dédiée aux gastronomes.
                </p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-6">
<a href="{{ route('login') }}" class="px-10 py-4 rounded-xl bg-primary text-on-primary font-bold text-lg hover:scale-95 transition-transform duration-300 shadow-xl inline-block">
    Se connecter
</a>
<a href="{{ route('register') }}" class="px-10 py-4 rounded-xl border-2 border-white text-white font-bold text-lg hover:bg-white hover:text-indigo-600 transition-all duration-300 inline-block">
    S'inscrire
</a>
</div>
</div>
</section>
<!-- Features Section (Bento Grid Inspired) -->
<section class="py-32 px-8 max-w-7xl mx-auto bg-surface">
<div class="mb-20 text-center">
<h2 class="font-headline font-extrabold text-4xl text-on-surface tracking-tight mb-4">L'expérience Gastronome</h2>
<div class="h-1.5 w-24 editorial-gradient mx-auto rounded-full"></div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
<!-- Card: Partager -->
<div class="group p-8 rounded-3xl bg-surface-container-lowest shadow-[0_20px_40px_rgba(44,47,48,0.06)] hover:shadow-2xl transition-all duration-500 flex flex-col items-start gap-6">
<div class="w-14 h-14 rounded-2xl bg-primary-container/20 flex items-center justify-center group-hover:bg-primary-container transition-colors duration-300">
<span class="material-symbols-outlined text-primary text-3xl group-hover:text-on-primary-container">restaurant</span>
</div>
<div>
<h3 class="font-headline font-bold text-xl mb-3 text-on-surface">Partager</h3>
<p class="text-on-surface-variant leading-relaxed">Partagez vos secrets de cuisine avec le monde et valorisez votre héritage culinaire.</p>
</div>
</div>
<!-- Card: Découvrir -->
<div class="group p-8 rounded-3xl bg-surface-container-lowest shadow-[0_20px_40px_rgba(44,47,48,0.06)] hover:shadow-2xl transition-all duration-500 flex flex-col items-start gap-6">
<div class="w-14 h-14 rounded-2xl bg-secondary-container/20 flex items-center justify-center group-hover:bg-secondary-container transition-colors duration-300">
<span class="material-symbols-outlined text-secondary text-3xl group-hover:text-on-secondary-container">explore</span>
</div>
<div>
<h3 class="font-headline font-bold text-xl mb-3 text-on-surface">Découvrir</h3>
<p class="text-on-surface-variant leading-relaxed">Explorez des milliers de recettes authentiques, du Ndolé au Poulet DG.</p>
</div>
</div>
<!-- Card: Commenter -->
<div class="group p-8 rounded-3xl bg-surface-container-lowest shadow-[0_20px_40px_rgba(44,47,48,0.06)] hover:shadow-2xl transition-all duration-500 flex flex-col items-start gap-6">
<div class="w-14 h-14 rounded-2xl bg-tertiary-container/20 flex items-center justify-center group-hover:bg-tertiary-container transition-colors duration-300">
<span class="material-symbols-outlined text-tertiary text-3xl group-hover:text-on-tertiary-container">forum</span>
</div>
<div>
<h3 class="font-headline font-bold text-xl mb-3 text-on-surface">Commenter</h3>
<p class="text-on-surface-variant leading-relaxed">Échangez avec une communauté de passionnés et perfectionnez vos techniques.</p>
</div>
</div>
<!-- Card: Noter -->
<div class="group p-8 rounded-3xl bg-surface-container-lowest shadow-[0_20px_40px_rgba(44,47,48,0.06)] hover:shadow-2xl transition-all duration-500 flex flex-col items-start gap-6">
<div class="w-14 h-14 rounded-2xl bg-error-container/20 flex items-center justify-center group-hover:bg-error-container transition-colors duration-300">
<span class="material-symbols-outlined text-error text-3xl group-hover:text-on-error-container" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<div>
<h3 class="font-headline font-bold text-xl mb-3 text-on-surface">Noter</h3>
<p class="text-on-surface-variant leading-relaxed">Évaluez et enregistrez vos plats favoris pour créer votre carnet personnel.</p>
</div>
</div>
</div>
</section>
<!-- Visual Filler Section with Floating Animation -->
<section class="py-20 px-8 max-w-7xl mx-auto overflow-hidden">
<div class="relative rounded-[3rem] overflow-hidden bg-surface-container-low h-[400px]">
<img alt="Culinary art" class="w-full h-full object-cover floating-bg-slow" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDfPUdyfIMGTznCbiUfhs8Oe9vzjhqi1c746gGmY8nHG0gAX6_kO3OxrBTFFTjS-j8rPlnQETBlRWeKXeOEdbJJ4Td4eFa49VcBN91nHUcgaiOEGSeFQrslQw_21NYfq0ahPxwzxogMqSEvDkDJ3NmeGK03ggcXbK4MbN0ALuDK3aFIhCihc96zAwfdTDXClz-HU3BnnZY9G9VIAkRiYs-keO4oVFCczUCwuHpX70NEQpqvXpwdY1osXFQ5Uqs-e5xRLr_QdNhijR21"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-16">
<div class="max-w-xl">
<h2 class="text-white font-headline font-bold text-3xl mb-4 italic">"La cuisine est le langage universel de l'amour et du partage."</h2>
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md"></div>
<span class="text-white font-label tracking-widest uppercase text-xs">Chef M. Eteki</span>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="w-full py-12 mt-auto bg-gray-100 dark:bg-gray-950 font-['Manrope'] text-sm">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-8 max-w-7xl mx-auto">
<div class="flex flex-col gap-4">
<div class="text-lg font-bold text-gray-900 dark:text-gray-100">Recettes App</div>
<p class="text-gray-500 dark:text-gray-400">Célébrer le patrimoine culinaire du Cameroun, une recette à la fois.</p>
</div>
<div class="flex flex-col gap-3">
<h4 class="font-bold text-gray-900 dark:text-gray-100 uppercase text-xs tracking-widest mb-2">Explorer</h4>
<a class="text-gray-500 dark:text-gray-400 hover:underline transition-all" href="#">À propos</a>
<a class="text-gray-500 dark:text-gray-400 hover:underline transition-all" href="#">Index des recettes</a>
</div>
<div class="flex flex-col gap-3">
<h4 class="font-bold text-gray-900 dark:text-gray-100 uppercase text-xs tracking-widest mb-2">Légal</h4>
<a class="text-gray-500 dark:text-gray-400 hover:underline transition-all" href="#">Confidentialité</a>
<a class="text-gray-500 dark:text-gray-400 hover:underline transition-all" href="#">Conditions d'utilisation</a>
</div>
<div class="flex flex-col gap-3">
<h4 class="font-bold text-gray-900 dark:text-gray-100 uppercase text-xs tracking-widest mb-2">Contact</h4>
<a class="text-gray-500 dark:text-gray-400 hover:underline transition-all" href="#">Nous contacter</a>
<div class="flex gap-4 mt-2">
<span class="material-symbols-outlined text-gray-400 cursor-pointer">share</span>
</div>
</div>
</div>
<div class="max-w-7xl mx-auto px-8 mt-12 pt-8 border-t border-gray-200 dark:border-gray-800 text-center md:text-left">
<p class="text-gray-500 dark:text-gray-400 opacity-80 hover:opacity-100 transition-opacity">© 2024 Recettes App - Patrimoine Culinaire Camerounais</p>
</div>
</footer>
</body>
</html>