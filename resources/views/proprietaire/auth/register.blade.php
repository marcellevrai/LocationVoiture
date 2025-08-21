@extends('layouts.auth')

@section('title', 'Connexion Client')

@section('form')
<div class="right-column">
        <div class="w-100" style="max-width: 500px;">
            <h3 class="mb-4 text-center">Inscription Propriétaire</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('proprietaire.register') }}">
                @csrf

                <div class="mb-3">
                    <label>Nom</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Prénom</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Téléphone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="number" class="form-control" value="{{ old('number') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label>Confirmer le mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">S'inscrire</button>

                <div class="text-center mt-3">
                    <a href="{{ route('proprietaire.login') }}">Vous avez déjà un compte ? Se connecter</a>
                </div>
            </form>
        </div>
    </div>
    @endsection
