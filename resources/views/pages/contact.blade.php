@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<main class="pt-32 pb-20 px-8 max-w-4xl mx-auto">
    <h1 class="font-headline font-extrabold text-4xl tracking-tight text-on-surface mb-6">Nous contacter</h1>
    <div class="prose prose-lg text-on-surface-variant space-y-4">
        <p>Vous avez une question, une suggestion ou vous souhaitez partager une recette ? N'hésitez pas à nous écrire.</p>
        
        <div class="bg-surface-container-low p-6 rounded-xl mt-8">
            <p class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">person</span> 
                <span class="font-semibold">Samira Samantha</span>
            </p>
            <p class="flex items-center gap-3 mt-3">
                <span class="material-symbols-outlined text-primary">email</span> 
                calebdassi@gmail.com
            </p>
            <p class="flex items-center gap-3 mt-3">
                <span class="material-symbols-outlined text-primary">phone</span> 
                +237 695073477
            </p>
        </div>
        
        <!-- Bloc localisation -->
        <div class="mt-6 p-4 bg-primary-container/10 rounded-xl">
            <p class="text-center text-on-surface-variant">
                📍 Awae, Yaoundé, Cameroun
            </p>
        </div>
    </div>
</main>
@endsection