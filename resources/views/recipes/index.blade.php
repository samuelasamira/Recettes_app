@extends('layouts.app')

@section('title', 'Toutes les recettes')

@section('content')

{{-- HERO BANNER --}}
<div class="page-hero">
    <div>
        <div class="page-hero-title">🍽️ Toutes les recettes</div>
        <div class="page-hero-sub">{{ $recipes->total() }} recettes disponibles dans la communauté</div>
    </div>
    @auth
        <a href="{{ route('recipes.create') }}" class="btn btn-primary">
            + Créer une recette
        </a>
    @endauth
</div>

{{-- FILTRES & RECHERCHE --}}
<div style="background:#fff; border-bottom:1px solid var(--border); padding:16px 40px;">
    <form method="GET" action="{{ route('recipes.index') }}" style="display:flex; gap:12px; align-items:center; flex-wrap:wrap;">
        
        <input
            type="text"
            name="search"
            class="form-control"
            style="max-width:260px;"
            placeholder="🔍 Rechercher une recette..."
            value="{{ request('search') }}"
        />

        <select name="difficulty" class="form-control" style="max-width:160px;">
            <option value="">Difficulté</option>
            <option value="facile"    {{ request('difficulty') == 'facile'    ? 'selected' : '' }}>🟢 Facile</option>
            <option value="moyen"     {{ request('difficulty') == 'moyen'     ? 'selected' : '' }}>🟡 Moyen</option>
            <option value="difficile" {{ request('difficulty') == 'difficile' ? 'selected' : '' }}>🔴 Difficile</option>
        </select>

        <select name="cuisine" class="form-control" style="max-width:180px;">
            <option value="">Type de cuisine</option>
            <option value="Camerounaise" {{ request('cuisine') == 'Camerounaise' ? 'selected' : '' }}>Camerounaise</option>
            <option value="Africaine"    {{ request('cuisine') == 'Africaine'    ? 'selected' : '' }}>Africaine</option>
            <option value="Française"    {{ request('cuisine') == 'Française'    ? 'selected' : '' }}>Française</option>
            <option value="Autre"        {{ request('cuisine') == 'Autre'        ? 'selected' : '' }}>Autre</option>
        </select>

        <button type="submit" class="btn btn-dark">Filtrer</button>

        @if(request('search') || request('difficulty') || request('cuisine'))
            <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Réinitialiser</a>
        @endif

    </form>
</div>

{{-- CONTENU --}}
<div class="container page-content">

    @if($recipes->count() > 0)

        <div class="recipes-grid">
            @foreach($recipes as $recipe)
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

                        {{-- Badges --}}
                        <div style="display:flex; gap:6px; margin-bottom:10px; flex-wrap:wrap;">
                            <span class="badge badge-{{ $recipe->difficulty }}">
                                {{ ucfirst($recipe->difficulty) }}
                            </span>
                            <span class="badge badge-cuisine">
                                {{ $recipe->cuisine_type }}
                            </span>
                        </div>

                        <div class="recipe-card-title">{{ $recipe->title }}</div>
                        <div class="recipe-card-desc">{{ Str::limit($recipe->description, 80) }}</div>

                        {{-- Meta --}}
                        <div class="recipe-card-meta">
                            <span>⏱ {{ $recipe->prep_time + $recipe->cook_time }} min</span>
                            <span>👥 {{ $recipe->servings }} pers.</span>
                        </div>

                        {{-- Footer --}}
                        <div class="recipe-card-footer">
                            <div>
                                <span class="stars">
                                    @php $avg = round($recipe->averageRating()); @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= $avg ? '★' : '☆' }}
                                    @endfor
                                </span>
                                <span style="font-size:12px; color:var(--muted); margin-left:4px;">
                                    ({{ $recipe->ratings->count() }})
                                </span>
                            </div>
                            <span style="font-size:12px; color:var(--muted);">
                                Par <strong>{{ $recipe->user->name }}</strong>
                            </span>
                        </div>

                        <a href="{{ route('recipes.show', $recipe) }}"
                           class="btn btn-dark btn-full"
                           style="margin-top:14px;">
                            Voir la recette →
                        </a>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="pagination">
            {{ $recipes->appends(request()->query())->links() }}
        </div>

    @else
        {{-- VIDE --}}
        <div style="text-align:center; padding:80px 20px;">
            <div style="font-size:64px; margin-bottom:20px;">🍳</div>
            <div style="font-size:20px; font-weight:700; color:var(--bleu-nuit); margin-bottom:8px;">Aucune recette trouvée</div>
            <div style="font-size:14px; color:var(--muted); margin-bottom:28px;">
                @if(request('search') || request('difficulty') || request('cuisine'))
                    Essayez avec d'autres filtres
                @else
                    Soyez le premier à partager une recette !
                @endif
            </div>
            @auth
                <a href="{{ route('recipes.create') }}" class="btn btn-primary">+ Créer la première recette</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Se connecter pour créer</a>
            @endauth
        </div>
    @endif

</div>

@endsection