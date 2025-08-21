@extends('layouts.client')

@section('title', 'Mon profil')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-header card mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-info text-white d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                        {{ strtoupper(substr($client->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="mb-0">Mon profil</h4>
                        <span class="text-muted">Gérez vos informations personnelles</span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form action="{{ route('client.profil.update') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Prénom</label>
                                <input type="text" name="firstname" class="form-control" value="{{ old('firstname', $client->firstname) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nom</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $client->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Téléphone</label>
                                <input type="text" name="number" class="form-control" value="{{ old('number', $client->number) }}" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Changer le mot de passe -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Changer le mot de passe</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('client.profil.update_password') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Mot de passe actuel</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nouveau mot de passe</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Confirmer le mot de passe</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-warning">Mettre à jour le mot de passe</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
