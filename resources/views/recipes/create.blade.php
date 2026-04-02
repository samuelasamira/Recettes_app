@extends('layouts.app')

@section('title', 'Créer une recette')

@section('content')
    <div style="max-width: 800px; margin: 0 auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        
        <h1 style="margin-bottom: 2rem;">➕ Créer une nouvelle recette</h1>

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
                <strong>Erreurs :</strong>
                <ul style="margin-top: 0.5rem; margin-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Titre -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Titre de la recette *</label>
                <input type="text" name="title" value="{{ old('title') }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;">
            </div>

            <!-- Description -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Description *</label>
                <textarea name="description" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; resize: vertical;" rows="4">{{ old('description') }}</textarea>
            </div>

            <!-- Image -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Image de la recette</label>
                <input type="file" name="image" accept="image/*" style="padding: 0.5rem;">
                <p style="color: #999; font-size: 0.85rem; margin-top: 0.5rem;">Format: JPEG, PNG, GIF (max 2MB)</p>
            </div>

            <!-- Type de cuisine -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Type de cuisine *</label>
                <input type="text" name="cuisine_type" value="{{ old('cuisine_type') }}" placeholder="ex: Française, Italienne, Asiatique..." required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <!-- Temps de préparation -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Temps de préparation (min) *</label>
                    <input type="number" name="prep_time" value="{{ old('prep_time') }}" min="1" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Temps de cuisson (min) *</label>
                    <input type="number" name="cook_time" value="{{ old('cook_time') }}" min="1" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <!-- Portions et difficulté -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Nombre de portions *</label>
                    <input type="number" name="servings" value="{{ old('servings') }}" min="1" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Difficulté *</label>
                    <select name="difficulty" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">Sélectionner</option>
                        <option value="facile" {{ old('difficulty') === 'facile' ? 'selected' : '' }}>🟢 Facile</option>
                        <option value="moyen" {{ old('difficulty') === 'moyen' ? 'selected' : '' }}>🟡 Moyen</option>
                        <option value="difficile" {{ old('difficulty') === 'difficile' ? 'selected' : '' }}>🔴 Difficile</option>
                    </select>
                </div>
            </div>

            <!-- Ingrédients -->
            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Ingrédients *</label>
                <div id="ingredients-container">
                    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;" class="ingredient-row">
                        <select name="ingredients[0][id]" required style="flex: 1; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="">Sélectionner un ingrédient</option>
                            @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="ingredients[0][quantity]" placeholder="ex: 2 cups, 500g" required style="flex: 1; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                        <button type="button" class="btn btn-danger" onclick="removeIngredient(this)">❌</button>
                    </div>
                </div>
                <button type="button" class="btn" style="background-color: #28a745; margin-top: 0.5rem;" onclick="addIngredient()">➕ Ajouter un ingrédient</button>
            </div>

            <!-- Instructions -->
            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Instructions de préparation *</label>
                <textarea name="instructions" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; resize: vertical;" rows="8" placeholder="Décrivez les étapes de préparation...">{{ old('instructions') }}</textarea>
            </div>

            <!-- Buttons -->
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn" style="background-color: #28a745; flex: 1;">✅ Créer la recette</button>
                <a href="{{ route('recipes.index') }}" class="btn btn-secondary" style="flex: 1; text-align: center; text-decoration: none;">Annuler</a>
            </div>
        </form>
    </div>

    <script>
        let ingredientCount = 1;

        function addIngredient() {
            const container = document.getElementById('ingredients-container');
            const index = ingredientCount++;
            
            const html = `
                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;" class="ingredient-row">
                    <select name="ingredients[${index}][id]" required style="flex: 1; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">Sélectionner un ingrédient</option>
                        @foreach($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="ingredients[${index}][quantity]" placeholder="ex: 2 cups, 500g" required style="flex: 1; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                    <button type="button" class="btn btn-danger" onclick="removeIngredient(this)">❌</button>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', html);
        }

        function removeIngredient(button) {
            const rows = document.querySelectorAll('.ingredient-row').length;
            if (rows > 1) {
                button.parentElement.remove();
            } else {
                alert('Vous devez avoir au moins un ingrédient!');
            }
        }
    </script>
@endsection