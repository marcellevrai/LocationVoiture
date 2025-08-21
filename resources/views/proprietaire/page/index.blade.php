@extends('layouts.proprietaire')


<div class="container mt-5 mb-5">

    <div class="card shadow-sm bg-white p-4" style="margin: 50px;">
        <h3 class="mb-4">Formulaire d'enregistrement de voiture</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('proprietaire.voitures.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Colonne gauche -->
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label>Matricule</label>
                        <input type="text" name="matricule" class="form-control" required value="{{ old('matricule') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Marque</label>
                        <input type="text" name="marque" class="form-control" required value="{{ old('marque') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Modèle</label>
                        <input type="text" name="modele" class="form-control" required value="{{ old('modele') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Nombre de places</label>
                        <input type="number" name="nbre_place" class="form-control" required value="{{ old('nbre_place') }}">
                    </div>

                    <div class="form-group mb-3">
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
                    <div class="form-group mb-3">
                        <label>Type de carburant</label>
                        <select name="type_carburant" class="form-control" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="essence" {{ old('type_carburant') == 'essence' ? 'selected' : '' }}>Essence</option>
                            <option value="diesel" {{ old('type_carburant') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="electrique" {{ old('type_carburant') == 'electrique' ? 'selected' : '' }}>Électrique</option>
                            <option value="hybride" {{ old('type_carburant') == 'hybride' ? 'selected' : '' }}>Hybride</option>
                        </select>
                    </div>
                    

                    <div class="form-group mb-3">
                        <label>Prix du chauffeur (par jour)</label>
                        <input type="number" name="prix_chauffeur_jour" class="form-control" value="{{ old('prix_chauffeur_jour') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Prix de la voiture (par jour)</label>
                        <input type="number" name="prix_voiture_jour" class="form-control" required value="{{ old('prix_voiture_jour') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Date de création (optionnelle)</label>
                        <input type="date" name="date_creation_voiture" class="form-control" value="{{ old('date_creation_voiture') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Image</label>
                        <input type="file" name="image_voiture" class="form-control">
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-3">
                <button type="reset" class="btn btn-secondary">Réinitialiser</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>