@extends('layouts.app')

@section('title', $recipe->title)

@section('content')
    <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        
        <!-- Image -->
        <div style="position: relative;">
            @if($recipe->image_path)
                <img src="{{ Storage::url($recipe->image_path) }}" alt="{{ $recipe->title }}" style="width: 100%; max-height: 400px; object-fit: cover;">
            @else
                <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 5rem;">
                    🍳
                </div>
            @endif

            <!-- Actions -->
            <div style="position: absolute; top: 1rem; right: 1rem; display: flex; gap: 0.5rem;">
                @auth
                    @if($userHasFavorited)
                        <form action="{{ route('favorites.destroy', $recipe) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background-color: #dc3545;">❤️ Retirer des favoris</button>
                        </form>
                    @else
                        <form action="{{ route('favorites.store', $recipe) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn" style="background-color: #28a745;">🤍 Ajouter aux favoris</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Header -->
        <div style="padding: 2rem; border-bottom: 1px solid #eee;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <div>
                    <h1 style="margin-bottom: 0.5rem;">{{ $recipe->title }}</h1>
                    <p style="color: #666;">Par <strong>{{ $recipe->user->name }}</strong> • {{ $recipe->created_at->format('d/m/Y') }}</p>
                </div>

                <!-- Edit/Delete buttons -->
                @auth
                    @if(auth()->user()->id === $recipe->user_id)
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('recipes.edit', $recipe) }}" class="btn" style="background-color: #ffc107; color: #333;">✏️ Modifier</a>
                            <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">🗑️ Supprimer</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Meta info -->
            <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
                <div>
                    <span style="color: #999;">Temps de préparation</span>
                    <p style="font-size: 1.2rem; font-weight: bold;">⏱️ {{ $recipe->prep_time }} min</p>
                </div>
                <div>
                    <span style="color: #999;">Temps de cuisson</span>
                    <p style="font-size: 1.2rem; font-weight: bold;">🔥 {{ $recipe->cook_time }} min</p>
                </div>
                <div>
                    <span style="color: #999;">Portions</span>
                    <p style="font-size: 1.2rem; font-weight: bold;">👥 {{ $recipe->servings }} personnes</p>
                </div>
                <div>
                    <span style="color: #999;">Type de cuisine</span>
                    <p style="font-size: 1.2rem; font-weight: bold;">🏷️ {{ $recipe->cuisine_type }}</p>
                </div>
                <div>
                    <span style="color: #999;">Difficulté</span>
                    <p style="font-size: 1.2rem; font-weight: bold;">
                        @if($recipe->difficulty === 'facile')
                            🟢 Facile
                        @elseif($recipe->difficulty === 'moyen')
                            🟡 Moyen
                        @else
                            🔴 Difficile
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; padding: 2rem;">
            
            <!-- Left column -->
            <div>
                <!-- Description -->
                <section style="margin-bottom: 2rem;">
                    <h2 style="margin-bottom: 1rem;">📝 Description</h2>
                    <p style="color: #666; line-height: 1.6;">{{ $recipe->description }}</p>
                </section>

                <!-- Ingrédients -->
                @if($recipe->ingredients->count() > 0)
                    <section style="margin-bottom: 2rem;">
                        <h2 style="margin-bottom: 1rem;">🥘 Ingrédients</h2>
                        <ul style="list-style: none;">
                            @foreach($recipe->ingredients as $ingredient)
                                <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                                    <input type="checkbox" style="margin-right: 0.5rem;">
                                    <span>{{ $ingredient->name }}</span>
                                    <span style="color: #999; float: right;">{{ $ingredient->pivot->quantity }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                <!-- Instructions -->
                <section style="margin-bottom: 2rem;">
                    <h2 style="margin-bottom: 1rem;">👨‍🍳 Instructions</h2>
                    <p style="color: #666; line-height: 1.8; white-space: pre-wrap;">{{ $recipe->instructions }}</p>
                </section>
            </div>

            <!-- Right column -->
            <div>
                <!-- Rating -->
                <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                    <h3 style="margin-bottom: 1rem;">⭐ Avis et notes</h3>
                    
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        <p style="font-size: 2.5rem; font-weight: bold; color: #ffc107;">{{ number_format($averageRating, 1) }}</p>
                        <div style="color: #ffc107; font-size: 1.5rem; margin-bottom: 0.5rem;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $averageRating)
                                    ⭐
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                        <p style="color: #666;">{{ $recipe->ratings->count() }} avis</p>
                    </div>

                    @auth
                        <form action="{{ route('ratings.store', $recipe) }}" method="POST">
                            @csrf
                            
                            <div style="margin-bottom: 1rem;">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Ma note</label>
                                <select name="rating" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                                    <option value="">Sélectionner une note</option>
                                    <option value="1" {{ $userRating && $userRating->rating == 1 ? 'selected' : '' }}>⭐ 1 - Mauvais</option>
                                    <option value="2" {{ $userRating && $userRating->rating == 2 ? 'selected' : '' }}>⭐⭐ 2 - Passable</option>
                                    <option value="3" {{ $userRating && $userRating->rating == 3 ? 'selected' : '' }}>⭐⭐⭐ 3 - Bon</option>
                                    <option value="4" {{ $userRating && $userRating->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ 4 - Très bon</option>
                                    <option value="5" {{ $userRating && $userRating->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ 5 - Excellent</option>
                                </select>
                            </div>

                            <div style="margin-bottom: 1rem;">
                                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Mon avis</label>
                                <textarea name="review" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px; resize: none;" rows="3" placeholder="Partagez votre expérience...">{{ $userRating ? $userRating->review : '' }}</textarea>
                            </div>

                            <button type="submit" class="btn" style="width: 100%; background-color: #28a745;">Enregistrer ma note</button>
                        </form>
                    @else
                        <p style="text-align: center; color: #666;">
                            <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none;">Connectez-vous</a> 
                            pour noter cette recette
                        </p>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Comments -->
        <div style="border-top: 1px solid #eee; padding: 2rem;">
            <h2 style="margin-bottom: 1rem;">💬 Commentaires</h2>

            @auth
                <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                    <form action="{{ route('comments.store', $recipe) }}" method="POST">
                        @csrf
                        <textarea name="content" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; resize: vertical;" rows="3" placeholder="Partagez votre avis..." required></textarea>
                        <button type="submit" class="btn" style="margin-top: 0.5rem; background-color: #28a745;">Poster un commentaire</button>
                    </form>
                </div>
            @endauth

            @if($recipe->comments->count() > 0)
                <div>
                    @foreach($recipe->comments as $comment)
                        <div style="border-bottom: 1px solid #eee; padding: 1rem 0;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.5rem;">
                                <strong>{{ $comment->user->name }}</strong>
                                @auth
                                    @if(auth()->user()->id === $comment->user_id)
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer;">🗑️</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                            <p style="color: #999; font-size: 0.85rem; margin-bottom: 0.5rem;">{{ $comment->created_at->format('d/m/Y à H:i') }}</p>
                            <p style="color: #666;">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p style="text-align: center; color: #999;">Aucun commentaire pour le moment</p>
            @endif
        </div>
    </div>

    <!-- Back link -->
    <div style="margin-top: 2rem;">
        <a href="{{ route('recipes.index') }}" style="color: #667eea; text-decoration: none;">← Retour aux recettes</a>
    </div>
@endsection