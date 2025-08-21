@extends('layouts.admin')

@section('title', 'Mon Profil')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <!-- En-tête avec icône -->
            <div class="page-header card mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-3"
                         style="width: 50px; height: 50px; font-size: 1.5rem;">
                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="mb-0">Mon profil</h4>
                        <span class="text-muted">Gérez les informations de votre compte administrateur</span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Formulaire d'information -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form action="{{route('admin.profil.updateInfo')}}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nom complet</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                    
                </div>
            </div>

            <!-- Changement mot de passe -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Changer le mot de passe</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profil.updatePassword') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Mot de passe actuel</label>
                                <input type="password" name="current_password" class="form-control"  required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Nouveau mot de passe</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Confirmation</label>
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
