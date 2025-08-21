@extends('layouts.auth')

@section('title', 'connexion client')

@section('form')
<div class="right-column">
        <div class="w-100" style="max-width: 450px;">
            <h3 class="mb-4 text-center">Connexion Client</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('client.login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Adresse Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="email@exemple.com" required value="{{ old('email') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="********" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">Se connecter</button>

                <div class="text-center mt-3">
                    <a href="{{ route('client.register') }}">Créer un compte</a>
                </div>
            </form>
        </div>
    </div>

@endsection