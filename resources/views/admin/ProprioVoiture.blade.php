@extends('layouts.admin')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-header card mb-4">
                <div class="row align-items-end">
                    <div class="col">
                        <div class="page-header-title">
                            <i class="icofont icofont-car bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Voitures de {{ $proprietaire->firstname }} {{ $proprietaire->name }}</h4>
                                <span>Liste des véhicules enregistrés par ce propriétaire</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($voitures->count())
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Marque</th>
                                    <th>Modèle</th>
                                    <th>Matricule</th>
                                    <th>Places</th>
                                    <th>Réservations</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($voitures as $voiture)
                                <tr>
                                    <td>{{ $voiture->marque }}</td>
                                    <td>{{ $voiture->modele }}</td>
                                    <td>{{ $voiture->matricule }}</td>
                                    <td>{{ $voiture->nbre_place }}</td>
                                    <td><span class="badge bg-info">{{ $voiture->reservations_count }}</span></td>
                                    <td>
                                        <a href="{{ route('admin.voitures.reservations', $voiture->id) }}" class="btn btn-sm btn-outline-primary">
                                         Voir réservations
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center">
                    Ce propriétaire n’a enregistré aucune voiture.
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
