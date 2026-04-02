<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Modifier le profil - Recettes App</title>
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
        body {
            font-family: 'Manrope', sans-serif;
        }
        h1, h2, h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col">
    <!-- TopNavBar -->
    <nav class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-md shadow-[0_20px_40px_rgba(44,47,48,0.06)]">
        <div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto">
            <div class="text-2xl font-bold tracking-tighter text-indigo-600">🍳 Recettes App</div>
            <div class="hidden md:flex items-center gap-8">
                <a class="font-medium text-gray-600 hover:text-indigo-500 transition-colors duration-300" href="{{ route('recipes.index') }}">Accueil</a>
                <a class="font-medium text-gray-600 hover:text-indigo-500 transition-colors duration-300" href="{{ route('recipes.index') }}">Recettes</a>
                <a class="font-medium text-gray-600 hover:text-indigo-500 transition-colors duration-300" href="{{ route('dashboard') }}">Tableau de bord</a>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('recipes.create') }}" class="bg-[#28a745] text-white px-6 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 hover:opacity-90 transition-all active:scale-95 duration-200">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add</span>
                    + Nouvelle recette
                </a>
                <div class="w-10 h-10 rounded-full overflow-hidden bg-surface-container">
                    <img alt="Avatar" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=667eea&color=fff"/>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-32 pb-20 px-8 max-w-4xl mx-auto w-full">
        <!-- Header -->
        <header class="mb-12">
            <h1 class="font-headline font-extrabold text-4xl tracking-tight text-on-surface mb-2">Modifier mon profil</h1>
            <p class="text-on-surface-variant">Modifiez vos informations personnelles et vos paramètres de compte.</p>
        </header>

        <!-- Messages flash -->
        @if (session('status') === 'profile-updated')
            <div class="mb-6 p-4 rounded-lg bg-green-100 border border-green-400 text-green-700 text-sm">
                Profil mis à jour avec succès !
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-error/10 border border-error/30">
                <ul class="list-disc list-inside text-error text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire d'édition du profil -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-[0_20px_40px_rgba(44,47,48,0.06)] overflow-hidden mb-8">
            <div class="border-b border-surface-container p-6">
                <h2 class="font-headline font-bold text-xl">Informations personnelles</h2>
                <p class="text-on-surface-variant text-sm">Mettez à jour votre nom et votre adresse email.</p>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm font-bold text-on-surface-variant mb-2" for="name">Nom complet</label>
                        <input class="w-full px-4 py-3 bg-surface-container-low rounded-xl border-none focus:ring-2 focus:ring-primary/40" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus/>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-on-surface-variant mb-2" for="email">Email</label>
                        <input class="w-full px-4 py-3 bg-surface-container-low rounded-xl border-none focus:ring-2 focus:ring-primary/40" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required/>
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <p class="text-sm text-on-surface-variant mt-2">
                                Votre adresse email n'est pas vérifiée.
                                <a href="{{ route('verification.send') }}" class="text-primary font-bold hover:underline">Renvoyer le lien de vérification</a>
                            </p>
                        @endif
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="editorial-gradient text-white font-bold py-3 px-8 rounded-xl hover:opacity-90 transition-all">Enregistrer</button>
                        <a href="{{ route('dashboard') }}" class="bg-surface-container-high text-on-surface-variant font-bold py-3 px-8 rounded-xl hover:bg-surface-variant transition-all">Annuler</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Formulaire de changement de mot de passe -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-[0_20px_40px_rgba(44,47,48,0.06)] overflow-hidden mb-8">
            <div class="border-b border-surface-container p-6">
                <h2 class="font-headline font-bold text-xl">Modifier le mot de passe</h2>
                <p class="text-on-surface-variant text-sm">Assurez-vous d'utiliser un mot de passe long et sécurisé.</p>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-on-surface-variant mb-2" for="current_password">Mot de passe actuel</label>
                        <input class="w-full px-4 py-3 bg-surface-container-low rounded-xl border-none focus:ring-2 focus:ring-primary/40" id="current_password" name="current_password" type="password" required/>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-on-surface-variant mb-2" for="password">Nouveau mot de passe</label>
                        <input class="w-full px-4 py-3 bg-surface-container-low rounded-xl border-none focus:ring-2 focus:ring-primary/40" id="password" name="password" type="password" required/>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-on-surface-variant mb-2" for="password_confirmation">Confirmer le mot de passe</label>
                        <input class="w-full px-4 py-3 bg-surface-container-low rounded-xl border-none focus:ring-2 focus:ring-primary/40" id="password_confirmation" name="password_confirmation" type="password" required/>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="editorial-gradient text-white font-bold py-3 px-8 rounded-xl hover:opacity-90 transition-all">Modifier le mot de passe</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Formulaire de suppression de compte -->
        <div class="bg-error/5 rounded-2xl border border-error/20 overflow-hidden">
            <div class="border-b border-error/20 p-6">
                <h2 class="font-headline font-bold text-xl text-error">Supprimer le compte</h2>
                <p class="text-error/70 text-sm">Une fois votre compte supprimé, toutes ses données seront définitivement effacées.</p>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')

                    <div>
                        <label class="block text-sm font-bold text-on-surface-variant mb-2" for="password">Mot de passe requis</label>
                        <input class="w-full px-4 py-3 bg-surface-container-low rounded-xl border-none focus:ring-2 focus:ring-error/40" id="password" name="password" type="password" placeholder="Entrez votre mot de passe pour confirmer" required/>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-error text-white font-bold py-3 px-8 rounded-xl hover:bg-error/80 transition-all">Supprimer mon compte</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 py-12 mt-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-8 max-w-7xl mx-auto">
            <div class="flex flex-col gap-4">
                <span class="text-lg font-bold text-gray-900">Recettes App</span>
                <p class="text-gray-500 text-sm leading-relaxed">Célébrer et préserver l'héritage culinaire camerounais à travers une plateforme digitale moderne et gourmande.</p>
            </div>
            <div>
                <h4 class="font-bold text-sm mb-4 uppercase tracking-widest text-on-surface-variant">Liens utiles</h4>
                <ul class="flex flex-col gap-2">
                    <li><a class="text-gray-500 text-sm hover:underline hover:text-indigo-600 transition-all" href="#">À propos</a></li>
                    <li><a class="text-gray-500 text-sm hover:underline hover:text-indigo-600 transition-all" href="#">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm mb-4 uppercase tracking-widest text-on-surface-variant">Légal</h4>
                <ul class="flex flex-col gap-2">
                    <li><a class="text-gray-500 text-sm hover:underline hover:text-indigo-600 transition-all" href="#">Confidentialité</a></li>
                    <li><a class="text-gray-500 text-sm hover:underline hover:text-indigo-600 transition-all" href="#">Conditions</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm mb-4 uppercase tracking-widest text-on-surface-variant">Newsletter</h4>
                <div class="flex gap-2">
                    <input class="bg-white border-none rounded-lg text-xs w-full py-2 px-3 focus:ring-1 focus:ring-primary/40" placeholder="Votre email" type="email"/>
                    <button class="bg-primary text-white p-2 rounded-lg">
                        <span class="material-symbols-outlined text-sm">send</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-8 mt-12 pt-8 border-t border-gray-200">
            <p class="text-center text-gray-500 text-xs">© 2024 Recettes App - Patrimoine Culinaire Camerounais</p>
        </div>
    </footer>
</body>
</html>