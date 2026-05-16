@extends('layouts.app')

@section('title', 'Créer une recette')

@section('content')

<div class="page-hero">
    <div>
        <div class="page-hero-title">➕ Créer une recette</div>
        <div class="page-hero-sub">Partagez votre savoir-faire culinaire avec la communauté</div>
    </div>
    <a href="{{ route('recipes.index') }}" class="btn btn-secondary">← Retour</a>
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

            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- TITRE --}}
                <div class="form-group">
                    <label class="form-label">Titre de la recette *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="ex: Ndolé aux crevettes de mer" required/>
                </div>

                {{-- DESCRIPTION --}}
                <div class="form-group">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Décrivez votre recette en quelques mots..." required>{{ old('description') }}</textarea>
                </div>

                {{-- IMAGE --}}
                <div class="form-group">
                    <label class="form-label">Photo de la recette</label>
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
                    </div>
                </div>

                {{-- TYPE & DIFFICULTÉ --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Type de cuisine *</label>
                        <input type="text" name="cuisine_type" class="form-control" value="{{ old('cuisine_type') }}" placeholder="ex: Camerounaise, Africaine..." required/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Difficulté *</label>
                        <select name="difficulty" class="form-control" required>
                            <option value="">Sélectionner</option>
                            <option value="facile"    {{ old('difficulty') == 'facile'    ? 'selected' : '' }}>🟢 Facile</option>
                            <option value="moyen"     {{ old('difficulty') == 'moyen'     ? 'selected' : '' }}>🟡 Moyen</option>
                            <option value="difficile" {{ old('difficulty') == 'difficile' ? 'selected' : '' }}>🔴 Difficile</option>
                        </select>
                    </div>
                </div>

                {{-- TEMPS & PORTIONS --}}
                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Préparation (min) *</label>
                        <input type="number" name="prep_time" class="form-control" value="{{ old('prep_time') }}" placeholder="30" min="1" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Cuisson (min) *</label>
                        <input type="number" name="cook_time" class="form-control" value="{{ old('cook_time') }}" placeholder="60" min="1" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Portions *</label>
                        <input type="number" name="servings" class="form-control" value="{{ old('servings') }}" placeholder="4" min="1" required/>
                    </div>
                </div>

                {{-- INGRÉDIENTS --}}
                <div class="form-group">
                    <label class="form-label">Ingrédients *</label>
                    <div id="ingredients-container">
                        <div class="ingredient-row">
                            <select name="ingredients[0][id]" class="form-control" required>
                                <option value="">Sélectionner un ingrédient</option>
                                @foreach($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="ingredients[0][quantity]" class="form-control qty-input" placeholder="ex: 500g, 2 c.s." required/>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeIngredient(this)">✕</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm" style="margin-top:8px;" onclick="addIngredient()">
                        ➕ Ajouter un ingrédient
                    </button>
                </div>

                {{-- INSTRUCTIONS --}}
                <div class="form-group">
                    <label class="form-label">Instructions de préparation *</label>
                    <textarea name="instructions" class="form-control" rows="8"
                        placeholder="Étape 1 : Faire tremper les feuilles...&#10;Étape 2 : ..." required>{{ old('instructions') }}</textarea>
                    <div class="form-hint">Décrivez chaque étape clairement, une par ligne.</div>
                </div>

                {{-- BOUTONS --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:8px;">
                    <button type="submit" class="btn btn-primary btn-full" style="padding:13px; font-size:15px;">
                        ✅ Publier la recette
                    </button>
                    <a href="{{ route('recipes.index') }}" class="btn btn-secondary btn-full" style="padding:13px; font-size:15px; text-align:center;">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let count = 1;

    function addIngredient() {
        const container = document.getElementById('ingredients-container');
        const html = `
            <div class="ingredient-row">
                <select name="ingredients[${count}][id]" class="form-control" required>
                    <option value="">Sélectionner un ingrédient</option>
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