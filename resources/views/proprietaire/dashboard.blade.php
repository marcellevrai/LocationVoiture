@extends('layouts.proprietaire')

@section('title', 'Dashboard')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <!-- Titre -->
            <div class="page-header card mb-4">
                <div class="row align-items-end">
                    <div class="col">
                        <div class="page-header-title">
                            <i class="icofont icofont-home bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Tableau de bord</h4>
                                <span>Vue globale de vos activités</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistiques principales -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body text-center">
                            <h5 class="mb-2">Voitures enregistrées</h5>
                            <h3>{{ $totalVoitures }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body text-center">
                            <h5 class="mb-2">Total Réservations</h5>
                            <h3>{{ $totalReservations }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning shadow">
                        <div class="card-body text-center">
                            <h5 class="mb-2">Revenus estimés</h5>
                            <h3>{{ number_format($revenusEstimes, 0, ',', ' ') }} FCFA</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Réservations récentes -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">5 Dernières réservations</h5>
                </div>
                <div class="card-body table-responsive">
                    @if($dernieresReservations->count())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Voiture</th>
                                    <th>Client</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dernieresReservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->voiture->marque }} {{ $reservation->voiture->modele }}</td>
                                        <td>{{ $reservation->client->firstname }} {{ $reservation->client->name }}</td>
                                        <td>{{ $reservation->date_debut }}</td>
                                        <td>{{ $reservation->date_fin }}</td>
                                        <td>
                                            <span class="badge @if($reservation->statut == 'confirmé') bg-success @else bg-warning text-dark @endif">
                                                {{ ucfirst($reservation->statut) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted text-center">Aucune réservation récente trouvée.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
