@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')

{{-- BANNER --}}
<div class="page-hero">
    <div style="display:flex; align-items:center; gap:20px;">
        <div style="width:64px; height:64px; background:var(--orange); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:26px; font-weight:800; color:#fff;">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div>
            <div class="page-hero-title">Mon Profil</div>
            <div class="page-hero-sub">Gérez vos informations personnelles</div>
        </div>
    </div>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Dashboard</a>
</div>

<div class="container page-content">
    <div style="max-width:680px; margin:0 auto; display:flex; flex-direction:column; gap:24px;">

        {{-- INFOS PERSONNELLES --}}
        <div class="white-card">
            <div class="card-section-title">👤 Informations personnelles</div>

            @if(session('status') === 'profile-updated')
                <div class="alert alert-success" style="margin-bottom:20px;">✅ Profil mis à jour avec succès !</div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required/>
                    @error('name')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Adresse email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required/>
                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div style="display:flex; gap:12px; margin-top:8px;">
                    <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
                </div>
            </form>
        </div>

        {{-- CHANGER MOT DE PASSE --}}
        <div class="white-card">
            <div class="card-section-title">🔐 Changer le mot de passe</div>

            @if(session('status') === 'password-updated')
                <div class="alert alert-success" style="margin-bottom:20px;">✅ Mot de passe mis à jour !</div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Mot de passe actuel</label>
                    <input type="password" name="current_password" class="form-control" placeholder="••••••••"/>
                    @error('current_password')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="Min. 8 caractères"/>
                    @error('password')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••"/>
                </div>

                <button type="submit" class="btn btn-primary">🔐 Mettre à jour</button>
            </form>
        </div>

        {{-- STATISTIQUES --}}
        <div class="white-card">
            <div class="card-section-title">📊 Mes statistiques</div>
            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px;">
                <div class="stat-card">
                    <div class="stat-card-number">{{ auth()->user()->recipes()->count() }}</div>
                    <div class="stat-card-label">Recettes publiées</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-number">{{ auth()->user()->favorites()->count() }}</div>
                    <div class="stat-card-label">Favoris</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-number">{{ auth()->user()->comments()->count() }}</div>
                    <div class="stat-card-label">Commentaires</div>
                </div>
            </div>
        </div>

        {{-- SUPPRIMER COMPTE --}}
        <div class="white-card" style="border:1px solid #fde8e8;">
            <div class="card-section-title" style="color:#8b1a1a;">⚠️ Zone dangereuse</div>
            <p style="font-size:14px; color:var(--muted); margin-bottom:20px;">
                La suppression de votre compte est irréversible. Toutes vos recettes, commentaires et favoris seront définitivement supprimés.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Êtes-vous sûr ? Cette action est irréversible !')">
                @csrf
                @method('DELETE')

                <div class="form-group">
                    <label class="form-label">Confirmez votre mot de passe pour supprimer</label>
                    <input type="password" name="password" class="form-control" placeholder="Votre mot de passe actuel"/>
                    @error('password', 'userDeletion')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-danger">🗑️ Supprimer définitivement mon compte</button>
            </form>
        </div>

    </div>
</div>

@endsection