@extends('layouts.app')
@section('title', 'Page introuvable')
@section('content')
<div style="text-align:center; padding:100px 20px;">
    <div style="font-size:80px; margin-bottom:20px;">😕</div>
    <div style="font-size:32px; font-weight:800; color:var(--bleu-nuit); margin-bottom:12px;">Page introuvable</div>
    <div style="font-size:16px; color:var(--muted); margin-bottom:32px;">La page que vous cherchez n'existe pas ou a été déplacée.</div>
    <a href="{{ route('home') }}" class="btn btn-primary" style="padding:12px 32px;">← Retour à l'accueil</a>
</div>
@endsection