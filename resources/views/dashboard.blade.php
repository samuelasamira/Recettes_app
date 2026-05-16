@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- BANNER PROFIL --}}
<div class="page-hero">
    <div style="display:flex; align-items:center; gap:20px;">
        <div style="width:64px; height:64px; background:var(--orange); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:24px; font-weight:800; color:#fff; flex-shrink:0;">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div>
            <div class="page-hero-title">Bonjour, {{ auth()->user()->name }} 👋</div>
            <div class="page-hero-sub">{{ auth()->user()->email }} · Membre depuis {{ auth()->user()->created_at->format('M Y') }}</div>
        </div>
    </div>
    <a href="{{ route('recipes.create') }}" class="btn btn-primary">+ Créer une recette</a>
</div>

<div class="container page-content">

    {{-- STATS --}}
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:36px;">
        <div class="stat-card">
            <div class="stat-card-number">{{ auth()->user()->recipes()->count() }}</div>
            <div class="stat-card-label">Recettes créées</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-number">{{ auth()->user()->favorites()->count() }}</div>
            <div class="stat-card-label">Favoris</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-number">{{ auth()->user()->comments()->count() }}</div>
            <div class="stat-card-label">Commentaires</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-number">
                {{ number_format(auth()->user()->ratings()->avg('rating') ?? 0, 1) }}
            </div>
            <div class="stat-card-label">Note moyenne donnée</div>
        </div>
    </div>

    {{-- MES RECETTES --}}
<div style="margin-bottom:40px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <div style="font-size:18px; font-weight:700; color:var(--bleu-nuit);">🍳 Mes recettes</div>
        <a href="{{ route('recipes.create') }}" class="btn btn-dark btn-sm">+ Nouvelle recette</a>
    </div>

    @php $myRecipes = auth()->user()->recipes()->latest()->take(6)->get(); @endphp

    @if($myRecipes->count() > 0)
        <div class="recipes-grid">
            @foreach($myRecipes as $recipe)
                <div class="recipe-card">

                    {{-- IMAGE --}}
                    @if($recipe->image_path)
                        @if(str_starts_with($recipe->image_path, 'http'))
                            <img src="{{ $recipe->image_path }}"
                                 alt="{{ $recipe->title }}"
                                 class="recipe-card-img"/>
                        @else
                            <img src="{{ Storage::url($recipe->image_path) }}"
                                 alt="{{ $recipe->title }}"
                                 class="recipe-card-img"/>
                        @endif
                    @else
                        <div class="recipe-card-img-placeholder">🍳</div>
                    @endif

                    {{-- BODY --}}
                    <div class="recipe-card-body">
                        <div style="display:flex; gap:6px; margin-bottom:8px;">
                            <span class="badge badge-{{ $recipe->difficulty }}">{{ ucfirst($recipe->difficulty) }}</span>
                        </div>
                        <div class="recipe-card-title">{{ $recipe->title }}</div>
                        <div class="recipe-card-meta">
                            <span>⏱ {{ $recipe->prep_time + $recipe->cook_time }} min</span>
                            <span>⭐ {{ number_format($recipe->averageRating(), 1) }}/5</span>
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:6px; margin-top:10px;">
                            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-dark btn-sm" style="text-align:center;">Voir</a>
                            <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning btn-sm" style="text-align:center;">✏️</a>
                            <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-full">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align:center; padding:48px; background:#fff; border-radius:14px; border:1px solid var(--border);">
            <div style="font-size:48px; margin-bottom:16px;">🍳</div>
            <div style="font-size:16px; font-weight:600; color:var(--bleu-nuit); margin-bottom:8px;">Aucune recette pour le moment</div>
            <div style="font-size:14px; color:var(--muted); margin-bottom:20px;">Partagez votre première recette camerounaise !</div>
            <a href="{{ route('recipes.create') }}" class="btn btn-primary">Créer ma première recette</a>
        </div>
    @endif
</div>

    {{-- MES FAVORIS --}}
<div style="margin-bottom:40px;">
    <div style="font-size:18px; font-weight:700; color:var(--bleu-nuit); margin-bottom:20px;">❤️ Mes favoris</div>

    @php $myFavorites = auth()->user()->favorites()->with('recipe')->latest()->take(5)->get(); @endphp

    @if($myFavorites->count() > 0)
        <div style="background:#fff; border-radius:14px; border:1px solid var(--border); overflow:hidden;">
            @foreach($myFavorites as $favorite)
                <div style="display:flex; align-items:center; gap:16px; padding:14px 20px; border-bottom:1px solid var(--border);">

                    {{-- IMAGE --}}
                    @if($favorite->recipe->image_path)
                        @if(str_starts_with($favorite->recipe->image_path, 'http'))
                            <img src="{{ $favorite->recipe->image_path }}"
                                 style="width:64px; height:64px; border-radius:10px; object-fit:cover; flex-shrink:0;"/>
                        @else
                            <img src="{{ Storage::url($favorite->recipe->image_path) }}"
                                 style="width:64px; height:64px; border-radius:10px; object-fit:cover; flex-shrink:0;"/>
                        @endif
                    @else
                        <div style="width:64px; height:64px; border-radius:10px; background:linear-gradient(135deg,var(--bleu-nuit),var(--bleu-mid)); display:flex; align-items:center; justify-content:center; font-size:26px; flex-shrink:0;">🍳</div>
                    @endif

                    {{-- INFOS --}}
                    <div style="flex:1;">
                        <div style="font-size:15px; font-weight:600; color:var(--bleu-nuit);">{{ $favorite->recipe->title }}</div>
                        <div style="font-size:13px; color:var(--muted); margin-top:2px;">
                            ⏱ {{ $favorite->recipe->prep_time + $favorite->recipe->cook_time }} min
                            · ⭐ {{ number_format($favorite->recipe->averageRating(), 1) }}/5
                            · <span class="badge badge-{{ $favorite->recipe->difficulty }}">{{ ucfirst($favorite->recipe->difficulty) }}</span>
                        </div>
                    </div>

                    {{-- BOUTON --}}
                    <a href="{{ route('recipes.show', $favorite->recipe) }}" class="btn btn-dark btn-sm">Voir →</a>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align:center; padding:32px; background:#fff; border-radius:14px; border:1px solid var(--border); color:var(--muted);">
            Aucun favori pour le moment. Explorez les recettes et ajoutez vos préférées !
        </div>
    @endif
</div>

    {{-- MES COMMENTAIRES RÉCENTS --}}
    <div>
        <div style="font-size:18px; font-weight:700; color:var(--bleu-nuit); margin-bottom:20px;">💬 Mes commentaires récents</div>

        @php $myComments = auth()->user()->comments()->with('recipe')->latest()->take(5)->get(); @endphp

        @if($myComments->count() > 0)
            <div style="background:#fff; border-radius:14px; border:1px solid var(--border); overflow:hidden;">
                @foreach($myComments as $comment)
                    <div style="padding:14px 20px; border-bottom:1px solid var(--border);">
                        <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
                            <a href="{{ route('recipes.show', $comment->recipe) }}" style="font-size:14px; font-weight:600; color:var(--orange); text-decoration:none;">{{ $comment->recipe->title }}</a>
                            <span style="font-size:12px; color:var(--muted);">{{ $comment->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div style="font-size:14px; color:#444;">{{ Str::limit($comment->content, 100) }}</div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align:center; padding:32px; background:#fff; border-radius:14px; border:1px solid var(--border); color:var(--muted);">
                Aucun commentaire pour le moment.
            </div>
        @endif
    </div>

</div>

@endsection