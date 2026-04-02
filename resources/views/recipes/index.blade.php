@extends('layouts.app')

@section('title', 'Toutes les recettes')

@section('content')
<main class="pt-28 pb-20 px-8 max-w-7xl mx-auto w-full flex-grow">
<!-- Editorial Header Section -->
<header class="mb-16">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
<div>
<span class="text-xs font-bold tracking-[0.2em] uppercase text-primary mb-3 block">Héritage Culinaire</span>
<h1 class="text-5xl font-extrabold tracking-tight text-on-surface max-w-2xl leading-[1.1]">Découvrez le goût du Cameroun.</h1>
</div>
<div class="flex gap-3">
    <a href="{{ route('recipes.index') }}" class="px-5 py-2 rounded-full {{ !request('type') && !request('search') ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface hover:bg-surface-variant' }} font-semibold text-sm transition-colors">
        Tout
    </a>
    <a href="{{ route('recipes.index', ['type' => 'Traditionnel']) }}" class="px-5 py-2 rounded-full {{ request('type') == 'Traditionnel' ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface hover:bg-surface-variant' }} font-semibold text-sm transition-colors">
        Traditionnel
    </a>
    <a href="{{ route('recipes.index', ['type' => 'Moderne']) }}" class="px-5 py-2 rounded-full {{ request('type') == 'Moderne' ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface hover:bg-surface-variant' }} font-semibold text-sm transition-colors">
        Moderne
    </a>
    <a href="{{ route('recipes.index', ['type' => 'Street Food']) }}" class="px-5 py-2 rounded-full {{ request('type') == 'Street Food' ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface hover:bg-surface-variant' }} font-semibold text-sm transition-colors">
        Street Food
    </a>
</div>
</div>

<!-- Affichage du terme recherché -->
@if(request('search'))
    <div class="mt-6">
        <p class="text-on-surface-variant">
            Résultats pour : <span class="font-bold text-primary">"{{ request('search') }}"</span>
            <a href="{{ route('recipes.index') }}" class="ml-3 text-sm text-primary hover:underline">× Effacer</a>
        </p>
    </div>
@endif
</header>

<!-- Recipe Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    @forelse($recipes as $recipe)
    <!-- Recipe Card -->
    <article class="group bg-surface-container-lowest rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-[0_20px_40px_rgba(44,47,48,0.06)] flex flex-col h-full">
        <div class="relative h-64 overflow-hidden">
            @if($recipe->image_path)
                <img src="{{ $recipe->image_path }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            @else
                <div class="w-full h-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                    <span class="text-6xl">🍳</span>
                </div>
            @endif
            <div class="absolute top-4 left-4 flex gap-2">
                <span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase text-on-surface shadow-sm">{{ $recipe->cuisine_type }}</span>
                <span class="bg-primary/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase text-white shadow-sm flex items-center gap-1">
                    <span class="material-symbols-outlined text-[12px]" style="font-variation-settings: 'FILL' 1;">star</span> {{ number_format($recipe->averageRating(), 1) }}
                </span>
            </div>
        </div>
        <div class="p-8 flex flex-col flex-grow">
            <h3 class="text-2xl font-bold mb-3 text-on-surface group-hover:text-primary transition-colors">{{ $recipe->title }}</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed mb-6 flex-grow">{{ Str::limit($recipe->description, 100) }}</p>
            <div class="flex items-center gap-4 mb-8">
                <div class="flex items-center gap-1.5 bg-surface-container-low px-3 py-1.5 rounded-lg">
                    <span class="text-sm">⏱️</span>
                    <span class="text-xs font-bold text-on-surface">{{ $recipe->prep_time + $recipe->cook_time }} min</span>
                </div>
                <div class="flex items-center gap-1.5 bg-surface-container-low px-3 py-1.5 rounded-lg">
                    <span class="text-sm">👥</span>
                    <span class="text-xs font-bold text-on-surface">{{ $recipe->servings }} pers</span>
                </div>
            </div>
            <a href="{{ route('recipes.show', $recipe) }}" class="w-full bg-primary-container text-on-primary-container py-3.5 rounded-xl font-bold text-sm hover:bg-primary hover:text-white transition-all duration-300 flex justify-center items-center gap-2">
                Voir la recette
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
    </article>
    @empty
    <div class="col-span-3 text-center py-20">
        @if(request('search'))
            <span class="text-6xl">🔍</span>
            <p class="text-on-surface-variant text-lg mt-4">Aucune recette trouvée pour <span class="font-bold text-primary">"{{ request('search') }}"</span></p>
            <p class="text-on-surface-variant mt-2">Essayez avec d'autres mots-clés ou parcourez toutes nos recettes.</p>
            <a href="{{ route('recipes.index') }}" class="inline-block mt-6 px-6 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition-colors">
                Voir toutes les recettes
            </a>
        @else
            <span class="text-6xl">🍳</span>
            <p class="text-on-surface-variant text-lg mt-4">Aucune recette pour le moment 😢</p>
            <a href="{{ route('recipes.create') }}" class="inline-block mt-4 px-6 py-3 bg-primary text-white rounded-xl">Créer la première recette</a>
        @endif
    </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-20 flex justify-center">
    {{ $recipes->links() }}
</div>
</main>
@endsection