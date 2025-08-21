@extends('layouts.proprietaire')

@section('title', 'Mes Voitures')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

            <div class="page-header card">
                <div class="row align-items-end">
                    <div class="col-lg-12">
                        <div class="page-header-title">
                            <i class="icofont icofont-car bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Mes Voitures</h4>
                                <span>Liste des voitures enregistrées</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableau -->
            <div class="page-body">
                <div class="card">
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Matricule</th>
                                        <th>Marque</th>
                                        <th>Modèle</th>
                                        <th>Places</th>
                                        <th>Transmission</th>
                                        <th>Carburant</th>
                                        <th>Prix/Jour</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($voitures as $voiture)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($voiture->image_voiture)
                                                    <img src="{{ asset('storage/' . $voiture->image_voiture) }}" alt="voiture" width="60">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $voiture->matricule }}</td>
                                            <td>{{ $voiture->marque }}</td>
                                            <td>{{ $voiture->modele }}</td>
                                            <td>{{ $voiture->nbre_place }}</td>
                                            <td>{{ ucfirst($voiture->transmission) }}</td>
                                            <td>{{ ucfirst($voiture->type_carburant) }}</td>
                                            <td>{{ number_format($voiture->prix_voiture_jour, 0, ',', ' ') }} F</td>
                                            <td>
                                                <!-- Bouton modifier -->
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $voiture->id }}">
                                                    Modifier
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $voiture->id }}">
                                                    Supprimer
                                                </button>

                                                <!-- Modale d'édition -->
                                                <div class="modal fade" id="editModal{{ $voiture->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $voiture->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ route('proprietaire.voitures.update', $voiture->id) }}">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel{{ $voiture->id }}">
                                                                        Modifier les prix – {{ $voiture->marque }} {{ $voiture->modele }}
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                                </div>

                                                                <div class="modal-body row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label>Prix de la voiture (par jour)</label>
                                                                        <input type="number" name="prix_voiture_jour" class="form-control" required value="{{ $voiture->prix_voiture_jour }}">
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label>Prix du chauffeur (par jour)</label>
                                                                        <input type="number" name="prix_chauffeur_jour" class="form-control" value="{{ $voiture->prix_chauffeur_jour }}">
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-success">Enregistrer</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
<!-- Modale de confirmation -->
<div class="modal fade" id="deleteModal{{ $voiture->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $voiture->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('proprietaire.voitures.destroy', $voiture->id) }}">
                @csrf
                @method('DELETE')

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel{{ $voiture->id }}">Supprimer cette voiture ?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>

                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer <strong>{{ $voiture->marque }} {{ $voiture->modele }}</strong> ({{ $voiture->matricule }}) ?</p>
                    <p class="text-danger small">Cette action est irréversible.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted">Aucune voiture enregistrée.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<!-- Bouton supprimer -->

