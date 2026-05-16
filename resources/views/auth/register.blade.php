@extends('layouts.app')

@section('title', 'Inscription')

@section('content')

<div style="min-height:85vh; background:linear-gradient(135deg, var(--bleu-nuit) 0%, var(--bleu-mid) 60%, var(--bleu-nuit) 100%); display:flex; align-items:center; justify-content:center; padding:40px 20px; position:relative; overflow:hidden;">

    {{-- Cercles flottants --}}
    <div style="position:absolute; top:-100px; left:-100px; width:400px; height:400px; background:rgba(255,107,26,0.06); border-radius:50%; animation:float 7s ease-in-out infinite;"></div>
    <div style="position:absolute; bottom:-120px; right:-80px; width:350px; height:350px; background:rgba(45,63,191,0.12); border-radius:50%; animation:float 9s ease-in-out infinite reverse;"></div>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes tilt {
            0%, 100% { transform: rotate(-1deg) translateY(0px); }
            50% { transform: rotate(1deg) translateY(-8px); }
        }
        .auth-card { animation: tilt 6s ease-in-out infinite; }
        .auth-card:hover {
            animation-play-state: paused;
            transform: rotate(0deg) scale(1.01);
            transition: transform 0.3s ease;
        }
    </style>

    {{-- CARD --}}
    <div class="auth-card" style="background:#fff; border-radius:20px; overflow:hidden; width:100%; max-width:860px; display:grid; grid-template-columns:1fr 1fr; box-shadow:0 24px 80px rgba(10,15,46,0.4);">

        {{-- GAUCHE : visuel --}}
        <div style="background:linear-gradient(160deg, var(--bleu-sombre) 0%, var(--bleu-mid) 100%); padding:44px 36px; display:flex; flex-direction:column; justify-content:center; position:relative; overflow:hidden;">
            <div style="position:absolute; top:-40px; right:-40px; width:180px; height:180px; background:rgba(255,107,26,0.1); border-radius:50%;"></div>
            <div style="position:absolute; bottom:-50px; left:-30px; width:150px; height:150px; background:rgba(255,255,255,0.04); border-radius:50%;"></div>

            <div style="position:relative; z-index:2;">
                <div style="color:var(--orange); font-size:22px; font-weight:800; margin-bottom:18px;">🍳 Recettes App</div>
                <div style="color:#fff; font-size:18px; font-weight:700; margin-bottom:10px; line-height:1.4;">Rejoignez la communauté !</div>
                <div style="color:rgba(255,255,255,0.5); font-size:13px; line-height:1.8; margin-bottom:28px;">Créez votre compte et commencez à partager vos meilleures recettes camerounaises.</div>

                <div style="display:flex; flex-direction:column; gap:10px;">
                    <div style="display:flex; align-items:center; gap:10px; color:rgba(255,255,255,0.7); font-size:13px;">
                        <div style="width:24px; height:24px; background:rgba(255,107,26,0.2); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px;">✓</div>
                        Publiez des recettes illimitées
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; color:rgba(255,255,255,0.7); font-size:13px;">
                        <div style="width:24px; height:24px; background:rgba(255,107,26,0.2); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px;">✓</div>
                        Gérez vos favoris et notes
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; color:rgba(255,255,255,0.7); font-size:13px;">
                        <div style="width:24px; height:24px; background:rgba(255,107,26,0.2); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px;">✓</div>
                        Commentez et interagissez
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; color:rgba(255,255,255,0.7); font-size:13px;">
                        <div style="width:24px; height:24px; background:rgba(255,107,26,0.2); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px;">✓</div>
                        Tableau de bord personnel
                    </div>
                </div>
            </div>
        </div>

        {{-- DROITE : formulaire --}}
        <div style="padding:44px 36px; display:flex; flex-direction:column; justify-content:center;">

            <div style="font-size:22px; font-weight:800; color:var(--bleu-nuit); margin-bottom:4px;">Créer un compte</div>
            <div style="font-size:13px; color:var(--muted); margin-bottom:24px;">Rejoignez des milliers de passionnés</div>

            @if($errors->any())
                <div class="errors-box">
                    <strong>Erreurs :</strong>
                    <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Jean Mballa" required autofocus/>
                </div>

                <div class="form-group">
                    <label class="form-label">Adresse email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="vous@exemple.com" required/>
                </div>

                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="Min. 8 caractères" required/>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required/>
                </div>

                <button type="submit" class="btn btn-primary btn-full" style="padding:12px; font-size:15px; margin-top:4px;">
                    Créer mon compte →
                </button>
            </form>

            <div style="text-align:center; margin-top:20px; font-size:13px; color:var(--muted);">
    Déjà un compte ?
    <a href="{{ route('login') }}" style="color:var(--orange); font-weight:600; text-decoration:none;">Se connecter</a>
</div>

<div style="text-align:center; margin-top:12px;">
    <a href="{{ route('home') }}" style="font-size:13px; color:var(--muted); text-decoration:none;">
        ← Retour à l'accueil
    </a>
</div>
        </div>
    </div>
</div>

@endsection