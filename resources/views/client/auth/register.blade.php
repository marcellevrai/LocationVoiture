@extends('layouts.auth')

@section('title', 'connexion client')

@section('form')
<div class="right-column">
        <div class="w-100" style="max-width: 500px;">
            <h3 class="mb-4 text-center">Créer un compte client</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('client.register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="name" class="form-control" placeholder="Votre nom" required value="{{ old('name') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                        <input type="text" name="firstname" class="form-control" placeholder="Votre prénom" required value="{{ old('firstname') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="ex: email@exemple.com" required value="{{ old('email') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="********" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="********" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">S'inscrire</button>

                <div class="text-center mt-3">
                    <a href="{{ route('client.login') }}">Déjà un compte ? Se connecter</a>
                </div>
            </form>
        </div>
    </div>

@endsection