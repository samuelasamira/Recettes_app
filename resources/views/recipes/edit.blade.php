@extends('layouts.app')

@section('title', 'Modifier la recette')

@section('content')

<div class="page-hero">
    <div>
        <div class="page-hero-title">✏️ Modifier la recette</div>
        <div class="page-hero-sub">Mettez à jour les informations de votre recette</div>
    </div>
    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-secondary">← Retour</a>
</div>

<div class="container page-content">
    <div style="max-width:780px; margin:0 auto;">
        <div class="white-card">

            @if($errors->any())
                <div class="errors-box">
                    <strong>Veuillez corriger les erreurs suivantes :</strong>
                    <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- TITRE --}}
                <div class="form-group">
                    <label class="form-label">Titre de la recette *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $recipe->title) }}" required/>
                </div>

                {{-- DESCRIPTION --}}
                <div class="form-group">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ old('description', $recipe->description) }}</textarea>
                </div>

                {{-- IMAGE ACTUELLE + UPLOAD --}}
                <div class="form-group">
                    <label class="form-label">Photo de la recette</label>

                    @if($recipe->image_path)
                        <div style="margin-bottom:12px;">
                            @if(str_starts_with($recipe->image_path, 'http'))
                                <img src="{{ $recipe->image_path }}"
                                     style="width:200px; height:130px; object-fit:cover; border-radius:10px; border:1px solid var(--border);"/>
                            @else
                                <img src="{{ Storage::url($recipe->image_path) }}"
                                     style="width:200px; height:130px; object-fit:cover; border-radius:10px; border:1px solid var(--border);"/>
                            @endif
                            <div style="font-size:12px; color:var(--muted); margin-top:6px;">Image actuelle — uploadez une nouvelle pour remplacer</div>
                        </div>
                    @endif

                    <div class="upload-zone" onclick="document.getElementById('image-input').click()">
                        <div class="upload-zone-icon">📷</div>
                        <div class="upload-zone-text">
                            Glissez votre image ici ou <span class="upload-zone-link">parcourir</span>
                        </div>
                        <div style="font-size:12px; color:var(--muted); margin-top:4px;">JPEG, PNG, GIF · max 2MB</div>
                    </div>
                    <input type="file" id="image-input" name="image" accept="image/*" style="display:none;" onchange="previewImage(this)"/>
                    <div id="image-preview" style="display:none; margin-top:10px;">
                        <img id="preview-img" style="max-width:200px; border-radius:10px; border:1px solid var(--border);"/>
                        <div style="font-size:12px; color:var(--muted); margin-top:4px;">Nouvelle image sélectionnée</div>
                    </div>
                </div>

                {{-- TYPE & DIFFICULTÉ --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Type de cuisine *</label>
                        <input type="text" name="cuisine_type" class="form-control" value="{{ old('cuisine_type', $recipe->cuisine_type) }}" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Difficulté *</label>
                        <select name="difficulty" class="form-control" required>
                            <option value="facile"    {{ old('difficulty', $recipe->difficulty) == 'facile'    ? 'selected' : '' }}>🟢 Facile</option>
                            <option value="moyen"     {{ old('difficulty', $recipe->difficulty) == 'moyen'     ? 'selected' : '' }}>🟡 Moyen</option>
                            <option value="difficile" {{ old('difficulty', $recipe->difficulty) == 'difficile' ? 'selected' : '' }}>🔴 Difficile</option>
                        </select>
                    </div>
                </div>

                {{-- TEMPS & PORTIONS --}}
                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Préparation (min) *</label>
                        <input type="number" name="prep_time" class="form-control" value="{{ old('prep_time', $recipe->prep_time) }}" min="1" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Cuisson (min) *</label>
                        <input type="number" name="cook_time" class="form-control" value="{{ old('cook_time', $recipe->cook_time) }}" min="1" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Portions *</label>
                        <input type="number" name="servings" class="form-control" value="{{ old('servings', $recipe->servings) }}" min="1" required/>
                    </div>
                </div>

                {{-- INGRÉDIENTS --}}
                <div class="form-group">
                    <label class="form-label">Ingrédients *</label>
                    <div id="ingredients-container">
                        @foreach($recipe->ingredients as $index => $ingredient)
                            <div class="ingredient-row">
                                <select name="ingredients[{{ $index }}][id]" class="form-control" required>
                                    <option value="">Sélectionner</option>
                                    @foreach($ingredients as $ing)
                                        <option value="{{ $ing->id }}" {{ $ing->id === $ingredient->id ? 'selected' : '' }}>
                                            {{ $ing->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" name="ingredients[{{ $index }}][quantity]"
                                       class="form-control qty-input"
                                       value="{{ $ingredient->pivot->quantity }}"
                                       placeholder="ex: 500g" required/>
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeIngredient(this)">✕</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm" style="margin-top:8px;" onclick="addIngredient()">
                        ➕ Ajouter un ingrédient
                    </button>
                </div>

                {{-- INSTRUCTIONS --}}
                <div class="form-group">
                    <label class="form-label">Instructions de préparation *</label>
                    <textarea name="instructions" class="form-control" rows="8" required>{{ old('instructions', $recipe->instructions) }}</textarea>
                </div>

                {{-- BOUTONS --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:8px;">
                    <button type="submit" class="btn btn-primary btn-full" style="padding:13px; font-size:15px;">
                        💾 Enregistrer les modifications
                    </button>
                    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-secondary btn-full" style="padding:13px; font-size:15px; text-align:center;">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let count = {{ $recipe->ingredients->count() }};

    function addIngredient() {
        const container = document.getElementById('ingredients-container');
        const html = `
            <div class="ingredient-row">
                <select name="ingredients[${count}][id]" class="form-control" required>
                    <option value="">Sélectionner</option>
                    @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="ingredients[${count}][quantity]" class="form-control qty-input" placeholder="ex: 500g" required/>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeIngredient(this)">✕</button>
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
        count++;
    }

    function removeIngredient(btn) {
        const rows = document.querySelectorAll('.ingredient-row');
        if (rows.length > 1) btn.closest('.ingredient-row').remove();
        else alert('Vous devez avoir au moins un ingrédient !');
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection