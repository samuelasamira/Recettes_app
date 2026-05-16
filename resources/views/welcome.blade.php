@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

    {{-- HERO --}}
    <section style="background: var(--bleu-nuit); padding: 100px 40px; text-align: center; position: relative; overflow: hidden;">
        
        {{-- Cercles décoratifs --}}
        <div style="position:absolute; top:-80px; right:-80px; width:400px; height:400px; background:rgba(255,107,26,0.07); border-radius:50%;"></div>
        <div style="position:absolute; bottom:-100px; left:-60px; width:300px; height:300px; background:rgba(45,63,191,0.15); border-radius:50%;"></div>
        
        {{-- Image fond --}}
        <div style="position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&fit=crop') center/cover; opacity:0.08;"></div>

        <div style="position:relative; z-index:2; max-width:640px; margin:0 auto;">
            <div style="display:inline-block; background:rgba(255,107,26,0.15); border:1px solid rgba(255,107,26,0.35); border-radius:30px; padding:6px 22px; font-size:12px; color:var(--orange); letter-spacing:.1em; text-transform:uppercase; margin-bottom:28px;">
                L'art culinaire camerounais
            </div>

            <h1 style="color:#fff; font-size:56px; font-weight:800; margin-bottom:22px; line-height:1.1; letter-spacing:-.02em;">
                🍳 Recettes App
            </h1>

            <p style="color:rgba(255,255,255,0.65); font-size:18px; margin-bottom:44px; line-height:1.8;">
                Découvrez et partagez l'excellence culinaire camerounaise à travers une plateforme moderne dédiée aux passionnés.
            </p>

            <div style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap;">
                @auth
                    <a href="{{ route('recipes.index') }}" class="btn btn-primary" style="font-size:16px; padding:14px 36px;">
                        Voir les recettes →
                    </a>
                    <a href="{{ route('recipes.create') }}" class="btn" style="font-size:16px; padding:14px 36px; background:transparent; color:#fff; border:1.5px solid rgba(255,255,255,0.35);">
                        + Créer une recette
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary" style="font-size:16px; padding:14px 36px;">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="btn" style="font-size:16px; padding:14px 36px; background:transparent; color:#fff; border:1.5px solid rgba(255,255,255,0.35);">
                        Inscription
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section style="background: #fff; padding: 80px 40px;">
        <div class="container">
            <div style="text-align:center; margin-bottom:52px;">
                <h2 style="font-size:32px; font-weight:800; color:var(--bleu-nuit); margin-bottom:12px;">L'expérience gastronome</h2>
                <div style="width:48px; height:4px; background:var(--orange); border-radius:4px; margin:0 auto;"></div>
            </div>

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:24px;">
                
                <div style="background:var(--surface); border-radius:14px; padding:28px; border:1px solid var(--border); transition:all .25s;">
                    <div style="width:48px; height:48px; background:var(--orange-pale); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:18px;">🍳</div>
                    <div style="font-size:16px; font-weight:700; color:var(--bleu-nuit); margin-bottom:8px;">Partager</div>
                    <div style="font-size:14px; color:var(--muted); line-height:1.7;">Publiez vos recettes et valorisez l'héritage culinaire du Cameroun.</div>
                </div>

                <div style="background:var(--surface); border-radius:14px; padding:28px; border:1px solid var(--border);">
                    <div style="width:48px; height:48px; background:#EEF0FF; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:18px;">🔍</div>
                    <div style="font-size:16px; font-weight:700; color:var(--bleu-nuit); margin-bottom:8px;">Découvrir</div>
                    <div style="font-size:14px; color:var(--muted); line-height:1.7;">Explorez des recettes authentiques, du Ndolé au Poulet DG.</div>
                </div>

                <div style="background:var(--surface); border-radius:14px; padding:28px; border:1px solid var(--border);">
                    <div style="width:48px; height:48px; background:#e8f5e0; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:18px;">💬</div>
                    <div style="font-size:16px; font-weight:700; color:var(--bleu-nuit); margin-bottom:8px;">Commenter</div>
                    <div style="font-size:14px; color:var(--muted); line-height:1.7;">Échangez avec une communauté de passionnés de cuisine.</div>
                </div>

                <div style="background:var(--surface); border-radius:14px; padding:28px; border:1px solid var(--border);">
                    <div style="width:48px; height:48px; background:var(--orange-pale); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:18px;">⭐</div>
                    <div style="font-size:16px; font-weight:700; color:var(--bleu-nuit); margin-bottom:8px;">Noter</div>
                    <div style="font-size:14px; color:var(--muted); line-height:1.7;">Évaluez vos plats favoris et créez votre carnet personnel.</div>
                </div>

            </div>
        </div>
    </section>

    {{-- CITATION --}}
<section style="padding: 0 40px 80px;">
    <div class="container">
        <div style="position:relative; border-radius:20px; overflow:hidden; height:260px;">
            <img src="https://images.unsplash.com/photo-1709837167686-a2e33aad1bf0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                 alt="Cuisine camerounaise"
                 style="width:100%; height:100%; object-fit:cover;"/>
            <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(10,15,46,0.85), rgba(10,15,46,0.2));"></div>
            <div style="position:absolute; bottom:0; left:0; padding:36px 48px;">
                <div style="color:#fff; font-size:22px; font-style:italic; margin-bottom:12px; max-width:500px;">"La cuisine est le langage universel de l'amour et du partage."</div>
                <div style="color:var(--orange); font-size:13px; font-weight:600; letter-spacing:.08em; text-transform:uppercase;">Chef M. Eteki</div>
            </div>
        </div>
    </div>
</section>

@endsection