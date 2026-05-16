@extends('layouts.app')

@section('title', $recipe->title)

@section('content')

{{-- IMAGE HERO --}}
<div style="height:380px; position:relative; overflow:hidden;">
    @if($recipe->image_path)
        @if(str_starts_with($recipe->image_path, 'http'))
            <img src="{{ $recipe->image_path }}"
                 alt="{{ $recipe->title }}"
                 style="width:100%; height:100%; object-fit:cover; object-position:center; transition:transform 0.6s ease;"
                 onmouseover="this.style.transform='scale(1.05)'"
                 onmouseout="this.style.transform='scale(1)'"/>
        @else
            <img src="{{ Storage::url($recipe->image_path) }}"
                 alt="{{ $recipe->title }}"
                 style="width:100%; height:100%; object-fit:cover; object-position:center; transition:transform 0.6s ease;"
                 onmouseover="this.style.transform='scale(1.05)'"
                 onmouseout="this.style.transform='scale(1)'"/>
        @endif
    @else
        <div style="height:100%; background:linear-gradient(135deg, var(--bleu-nuit), var(--bleu-mid)); display:flex; align-items:center; justify-content:center; font-size:100px;">🍳</div>
    @endif

    {{-- Dégradé bas --}}
    <div style="position:absolute; bottom:0; left:0; right:0; height:120px; background:linear-gradient(to top, rgba(10,15,46,0.7), transparent);"></div>

    {{-- Bouton favori --}}
    @auth
        <div style="position:absolute; top:20px; right:24px; z-index:10;">
            @if($userHasFavorited)
                <form action="{{ route('favorites.destroy', $recipe) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn" style="background:rgba(10,15,46,0.7); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.3); color:#fff;">❤️ Retirer des favoris</button>
                </form>
            @else
                <form action="{{ route('favorites.store', $recipe) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn" style="background:rgba(10,15,46,0.7); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.3); color:#fff;">🤍 Ajouter aux favoris</button>
                </form>
            @endif
        </div>
    @endauth
</div>

    {{-- Bouton favori --}}
    @auth
        <div style="position:absolute; top:20px; right:24px; z-index:10;">
            @if($userHasFavorited)
                <form action="{{ route('favorites.destroy', $recipe) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn" style="background:rgba(10,15,46,0.7); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.3); color:#fff;">❤️ Retirer des favoris</button>
                </form>
            @else
                <form action="{{ route('favorites.store', $recipe) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn" style="background:rgba(10,15,46,0.7); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.3); color:#fff;">🤍 Ajouter aux favoris</button>
                </form>
            @endif
        </div>
    @endauth
</div>

<div class="container page-content">
    <div style="display:grid; grid-template-columns:2fr 1fr; gap:24px;">

        {{-- COLONNE GAUCHE --}}
        <div>

            {{-- HEADER --}}
            <div class="white-card" style="margin-bottom:20px;">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
                    <div>
                        <h1 style="font-size:26px; font-weight:800; color:var(--bleu-nuit); margin-bottom:6px;">{{ $recipe->title }}</h1>
                        <div style="font-size:14px; color:var(--muted);">
                            Par <strong style="color:var(--bleu-nuit);">{{ $recipe->user->name }}</strong>
                            · {{ $recipe->created_at->format('d/m/Y') }}
                        </div>
                        <div style="display:flex; gap:8px; margin-top:10px; flex-wrap:wrap;">
                            <span class="badge badge-{{ $recipe->difficulty }}">{{ ucfirst($recipe->difficulty) }}</span>
                            <span class="badge badge-cuisine">{{ $recipe->cuisine_type }}</span>
                        </div>
                    </div>
                    @auth
                        @if(auth()->user()->id === $recipe->user_id)
                            <div style="display:flex; gap:8px;">
                                <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning btn-sm">✏️ Modifier</a>
                                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Supprimer cette recette ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>

                {{-- STATS --}}
                <div style="display:flex; gap:24px; flex-wrap:wrap; padding:16px; background:var(--surface); border-radius:10px;">
                    <div><div style="font-size:12px; color:var(--muted);">Préparation</div><div style="font-size:16px; font-weight:700;">⏱ {{ $recipe->prep_time }} min</div></div>
                    <div><div style="font-size:12px; color:var(--muted);">Cuisson</div><div style="font-size:16px; font-weight:700;">🔥 {{ $recipe->cook_time }} min</div></div>
                    <div><div style="font-size:12px; color:var(--muted);">Portions</div><div style="font-size:16px; font-weight:700;">👥 {{ $recipe->servings }} pers.</div></div>
                    <div><div style="font-size:12px; color:var(--muted);">Note moyenne</div><div style="font-size:16px; font-weight:700; color:var(--orange);">★ {{ number_format($averageRating, 1) }}/5</div></div>
                </div>
            </div>

            {{-- DESCRIPTION --}}
            <div class="white-card" style="margin-bottom:20px;">
                <div class="card-section-title">📝 Description</div>
                <p style="font-size:15px; color:#444; line-height:1.8;">{{ $recipe->description }}</p>
            </div>

            {{-- INGRÉDIENTS --}}
            @if($recipe->ingredients->count() > 0)
                <div class="white-card" style="margin-bottom:20px;">
                    <div class="card-section-title">🥘 Ingrédients</div>
                    <div>
                        @foreach($recipe->ingredients as $ingredient)
                            <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid var(--border); font-size:14px;">
                                <span style="display:flex; align-items:center; gap:8px;">
                                    <input type="checkbox" style="accent-color:var(--orange);"/>
                                    {{ $ingredient->name }}
                                </span>
                                <span style="color:var(--muted); font-weight:500;">{{ $ingredient->pivot->quantity }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- INSTRUCTIONS --}}
            <div class="white-card" style="margin-bottom:20px;">
                <div class="card-section-title">👨‍🍳 Instructions</div>
                <div style="font-size:15px; color:#444; line-height:2; white-space:pre-line;">{{ $recipe->instructions }}</div>
            </div>

            {{-- COMMENTAIRES --}}
            <div class="white-card">
                <div class="card-section-title">💬 Commentaires ({{ $recipe->comments->count() }})</div>

                @auth
                    <form action="{{ route('comments.store', $recipe) }}" method="POST" style="margin-bottom:24px;">
                        @csrf
                        <textarea name="content" class="form-control" rows="3" placeholder="Partagez votre avis sur cette recette..." required style="margin-bottom:10px;"></textarea>
                        <button type="submit" class="btn btn-dark">Poster un commentaire</button>
                    </form>
                @else
                    <div style="background:var(--surface); border-radius:10px; padding:16px; margin-bottom:20px; font-size:14px; color:var(--muted);">
                        <a href="{{ route('login') }}" style="color:var(--orange); font-weight:600;">Connectez-vous</a> pour laisser un commentaire.
                    </div>
                @endauth

                @forelse($recipe->comments as $comment)
                    <div class="comment-item">
                        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                            <div>
                                <div class="comment-author">{{ $comment->user->name }}</div>
                                <div class="comment-date">{{ $comment->created_at->format('d/m/Y à H:i') }}</div>
                            </div>
                            @auth
                                @if(auth()->user()->id === $comment->user_id)
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Supprimer ce commentaire ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" style="background:none; border:none; color:#dc3545; cursor:pointer; font-size:16px;">🗑️</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                        <div class="comment-text">{{ $comment->content }}</div>
                    </div>
                @empty
                    <div style="text-align:center; padding:24px; color:var(--muted); font-size:14px;">Aucun commentaire pour le moment</div>
                @endforelse
            </div>
        </div>

        {{-- COLONNE DROITE --}}
        <div>

            {{-- RATING --}}
            <div class="white-card" style="margin-bottom:16px;">
                <div class="card-section-title">⭐ Notes et avis</div>
                <div style="text-align:center; margin-bottom:20px; padding:16px; background:var(--surface); border-radius:10px;">
                    <div style="font-size:44px; font-weight:800; color:var(--orange);">{{ number_format($averageRating, 1) }}</div>
                    <div class="stars" style="font-size:20px; margin:4px 0;">
                        @for($i=1; $i<=5; $i++){{ $i <= round($averageRating) ? '★' : '☆' }}@endfor
                    </div>
                    <div style="font-size:13px; color:var(--muted);">{{ $recipe->ratings->count() }} avis</div>
                </div>

                @auth
                    <form action="{{ route('ratings.store', $recipe) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Ma note</label>
                            <select name="rating" class="form-control">
                                <option value="">Choisir une note</option>
                                @for($i=1; $i<=5; $i++)
                                    <option value="{{ $i }}" {{ $userRating && $userRating->rating == $i ? 'selected' : '' }}>
                                        {{ str_repeat('★', $i) }} {{ $i }}/5
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mon avis</label>
                            <textarea name="review" class="form-control" rows="3" placeholder="Décrivez votre expérience...">{{ $userRating ? $userRating->review : '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-full">Enregistrer ma note</button>
                    </form>
                @else
                    <div style="text-align:center; font-size:14px; color:var(--muted);">
                        <a href="{{ route('login') }}" style="color:var(--orange); font-weight:600;">Connectez-vous</a> pour noter cette recette.
                    </div>
                @endauth
            </div>

            {{-- INFOS AUTEUR --}}
            <div class="white-card">
                <div class="card-section-title">👨‍🍳 À propos de l'auteur</div>
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                    <div style="width:44px; height:44px; background:var(--bleu-nuit); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--orange); font-weight:700; font-size:16px;">
                        {{ strtoupper(substr($recipe->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-weight:700; color:var(--bleu-nuit);">{{ $recipe->user->name }}</div>
                        <div style="font-size:13px; color:var(--muted);">{{ $recipe->user->recipes()->count() }} recettes publiées</div>                    </div>
                </div>
                <a href="{{ route('recipes.index') }}" class="btn btn-secondary btn-full">← Retour aux recettes</a>
            </div>

        </div>
    </div>
</div>

@endsection