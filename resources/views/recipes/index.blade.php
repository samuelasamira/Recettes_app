@extends('layouts.app')

@section('title', 'Toutes les recettes')

@section('content')
    <div style="margin-bottom: 2rem;">
        <h1 style="margin-bottom: 1rem;">🍽️ Toutes les recettes</h1>
        
        @auth
            <a href="{{ route('recipes.create') }}" class="btn" style="background-color: #28a745;">
                ➕ Créer une nouvelle recette
            </a>
        @endauth
    </div>

    @if($recipes->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
            @foreach($recipes as $recipe)
                <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    
                    <!-- Image -->
                    @if($recipe->image_path)
                        <img src="{{ Storage::url($recipe->image_path) }}" alt="{{ $recipe->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                            🍳
                        </div>
                    @endif

                    <!-- Content -->
                    <div style="padding: 1.5rem;">
                        <h3 style="margin-bottom: 0.5rem; color: #333;">{{ $recipe->title }}</h3>
                        
                        <p style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;">
                            {{ Str::limit($recipe->description, 80) }}
                        </p>

                        <!-- Meta -->
                        <div style="display: flex; gap: 1rem; margin-bottom: 1rem; font-size: 0.85rem; color: #666;">
                            <span>⏱️ {{ $recipe->prep_time + $recipe->cook_time }} min</span>
                            <span>👥 {{ $recipe->servings }} pers.</span>
                            <span>🏷️ {{ $recipe->cuisine_type }}</span>
                        </div>

                        <!-- Rating -->
                        <div style="margin-bottom: 1rem;">
                            @php
                                $avgRating = $recipe->averageRating();
                            @endphp
                            <span style="color: #ffc107;">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $avgRating)
                                        ⭐
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </span>
                            <span style="color: #666; font-size: 0.9rem;">({{ $recipe->ratings->count() }} avis)</span>
                        </div>

                        <!-- Author -->
                        <p style="font-size: 0.85rem; color: #999; margin-bottom: 1rem;">
                            Par <strong>{{ $recipe->user->name }}</strong>
                        </p>

                        <!-- Button -->
                        <a href="{{ route('recipes.show', $recipe) }}" class="btn" style="width: 100%; text-align: center; display: block;">
                            Voir la recette →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div style="margin-top: 2rem;">
            {{ $recipes->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem; background: white; border-radius: 8px;">
            <p style="font-size: 1.2rem; color: #666; margin-bottom: 1rem;">Aucune recette pour le moment 😢</p>
            @auth
                <a href="{{ route('recipes.create') }}" class="btn" style="background-color: #28a745;">
                    Créer la première recette
                </a>
            @else
                <p style="color: #999;">
                    <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none;">Connectez-vous</a> 
                    pour créer une recette
                </p>
            @endauth
        </div>
    @endif
@endsection