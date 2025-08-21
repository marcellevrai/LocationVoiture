@extends('layouts.proprietaire')

@section('title', 'Ajouter une voiture')

@section('content')

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-header start -->
            <div class="page-header card">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="icofont icofont-layout bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Formulaire d'enregistrement de voiture</h4>
                                <span>Enregistrez ici les véhicules disponibles à la location</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('proprietaire.dashboard') }}">
                                        <i class="icofont icofont-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Gestion</a></li>
                                <li class="breadcrumb-item"><a href="#">Ajouter</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-header end -->

            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Informations du véhicule</h5>
                                @if(session('success'))
                                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                @endif
                            </div>
                            <div class="card-block">
                                <form action="{{ route('proprietaire.voitures.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- Colonne gauche -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Matricule</label>
                                                <input type="text" name="matricule" class="form-control" required value="{{ old('matricule') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Marque</label>
                                                <input type="text" name="marque" class="form-control" required value="{{ old('marque') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Modèle</label>
                                                <input type="text" name="modele" class="form-control" required value="{{ old('modele') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Nombre de places</label>
                                                <input type="number" name="nbre_place" class="form-control" required value="{{ old('nbre_place') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Transmission</label>
                                                <select name="transmission" class="form-control" required>
                                                    <option value="">-- Sélectionner --</option>
                                                    <option value="manuelle" {{ old('transmission') == 'manuelle' ? 'selected' : '' }}>Manuelle</option>
                                                    <option value="automatique" {{ old('transmission') == 'automatique' ? 'selected' : '' }}>Automatique</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Colonne droite -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Type de carburant</label>
                                                <select name="type_carburant" class="form-control" required>
                                                    <option value="">-- Sélectionner --</option>
                                                    <option value="essence" {{ old('type_carburant') == 'essence' ? 'selected' : '' }}>Essence</option>
                                                    <option value="diesel" {{ old('type_carburant') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                                    <option value="electrique" {{ old('type_carburant') == 'electrique' ? 'selected' : '' }}>Électrique</option>
                                                    <option value="hybride" {{ old('type_carburant') == 'hybride' ? 'selected' : '' }}>Hybride</option>
                                                    <option value="gaz" {{ old('type_carburant') == 'gaz' ? 'selected' : '' }}>Gaz</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Prix du chauffeur (par jour)</label>
                                                <input type="number" name="prix_chauffeur_jour" class="form-control" value="{{ old('prix_chauffeur_jour') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Prix de la voiture (par jour)</label>
                                                <input type="number" name="prix_voiture_jour" class="form-control" required value="{{ old('prix_voiture_jour') }}">
                                            </div>                                          

                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" name="image_voiture" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 text-end">
                                        <button type="reset" class="btn btn-secondary me-2">Réinitialiser</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-body end -->
        </div>
    </div>
    <!-- Main-body end -->

    <div id="styleSelector"></div>
</div>



@endsection



