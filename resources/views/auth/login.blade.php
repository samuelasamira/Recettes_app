<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Connexion | Recettes App</title>
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
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .signature-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Animation flottante pour l'image de fond */
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
        .floating-bg {
            animation: float 20s ease-in-out infinite;
        }
        /* Overlay dynamique */
        .overlay-gradient {
            background: linear-gradient(135deg, rgba(0,0,0,0.6) 0%, rgba(102,126,234,0.4) 50%, rgba(118,75,162,0.6) 100%);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface min-h-screen flex items-center justify-center p-4 overflow-hidden">
<!-- Background Image avec animation flottante -->
<div class="fixed inset-0 z-0 overflow-hidden">
    <img class="w-full h-full object-cover floating-bg" src="https://img.freepik.com/photos-premium/chef-africain-creant-plats-gourmets-ia-generative_431161-21957.jpg" alt="Chef africain"/>
    <div class="absolute inset-0 overlay-gradient"></div>
</div>

<!-- Main Login Container - Réduit et centré -->
<main class="relative z-10 w-full max-w-[450px] glass-panel rounded-2xl shadow-2xl overflow-hidden mx-auto">
    <!-- Form Panel -->
    <div class="p-8 md:p-10">
        <div class="text-center mb-8">
            <div class="w-16 h-16 signature-gradient rounded-2xl flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl">🍳</span>
            </div>
            <h2 class="font-headline font-bold text-2xl text-on-surface mb-2">Bon retour</h2>
            <p class="text-on-surface-variant text-sm">Entrez vos identifiants pour continuer</p>
        </div>

        <!-- Affichage des erreurs dynamique -->
        @if ($errors->any())
            <div class="mb-6 p-3 rounded-lg bg-error/10 border border-error/30">
                <ul class="list-disc list-inside text-error text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="mb-6 p-3 rounded-lg bg-green-100 border border-green-400 text-green-700 text-xs">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Field -->
            <div>
                <label class="block font-headline font-semibold text-xs text-on-surface-variant mb-1 ml-1" for="email">
                    Email
                </label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">mail</span>
                    <input class="w-full pl-9 pr-3 py-2.5 bg-white/50 border-none rounded-lg ring-1 ring-outline-variant/30 focus:ring-2 focus:ring-primary/40 focus:bg-white transition-all outline-none text-sm" id="email" name="email" value="{{ old('email') }}" placeholder="chef@recettes.cm" required type="email"/>
                </div>
            </div>

            <!-- Password Field -->
            <div>
                <div class="flex justify-between items-center mb-1 px-1">
                    <label class="block font-headline font-semibold text-xs text-on-surface-variant" for="password">
                        Mot de passe
                    </label>
                    <a class="text-primary text-xs font-medium hover:underline" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                </div>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">lock</span>
                    <input class="w-full pl-9 pr-9 py-2.5 bg-white/50 border-none rounded-lg ring-1 ring-outline-variant/30 focus:ring-2 focus:ring-primary/40 focus:bg-white transition-all outline-none text-sm" id="password" name="password" placeholder="••••••••" required type="password"/>
                    <button class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface" type="button" onclick="togglePassword()">
                        <span class="material-symbols-outlined text-sm" id="password-icon">visibility</span>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input class="w-3.5 h-3.5 rounded border-outline-variant text-primary focus:ring-primary/40" id="remember" name="remember" type="checkbox"/>
                <label class="ml-2 text-xs text-on-surface-variant" for="remember">Se souvenir de moi</label>
            </div>

            <!-- Submit Button -->
            <button class="w-full signature-gradient text-white font-headline font-bold py-2.5 rounded-lg shadow-lg shadow-primary/30 hover:shadow-primary/50 transform active:scale-[0.98] transition-all flex items-center justify-center gap-2 text-sm" type="submit">
                Se connecter
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </button>
        </form>

        <!-- Footer Link -->
        <div class="mt-6 text-center">
            <p class="text-on-surface-variant text-xs">
                Nouveau sur Recettes App ? 
                <a class="text-primary font-bold hover:underline ml-1" href="{{ route('register') }}">Créer un compte</a>
            </p>
        </div>
    </div>
</main>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('password-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.textContent = 'visibility_off';
        } else {
            passwordInput.type = 'password';
            passwordIcon.textContent = 'visibility';
        }
    }
</script>
</body>
</html>