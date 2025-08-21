@extends('layouts.proprietaire')

@section('title', 'Toutes les réservations')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-header card mb-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center">
                        <i class="icofont icofont-book-alt bg-c-blue text-white me-3" style="font-size: 1.8rem; padding: 0.6rem; border-radius: 10px;"></i>
                        <div>
                            <h4 class="mb-0">Toutes les réservations</h4>
                            <span class="text-muted">Historique complet des réservations</span>
                        </div>
                    </div>
            
                    <form method="GET" class="d-flex align-items-center mt-3 mt-lg-0" action="{{ route('proprietaire.reservations.index') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher un client..." value="{{ $search }}">
                            <button type="submit" class="btn btn-primary">Rechercher</button>
                        </div>
                    </form>
                </div>
            </div>
            

            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                    @if($reservations->count())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Voiture</th>
                                    <th>Client</th>
                                    <th>Dates</th>
                                    <th>Avec chauffeur</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->voiture->marque }} {{ $reservation->voiture->modele }}</td>
                                        <td>{{ $reservation->client->firstname }} {{ $reservation->client->name }}</td>
                                        <td>{{ $reservation->date_debut }} → {{ $reservation->date_fin }}</td>
                                        <td>
                                            @if($reservation->avec_chauffeur)
                                                <span class="badge bg-info">Oui</span>
                                            @else
                                                <span class="badge bg-secondary">Non</span>
                                            @endif
                                        </td>
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
                        <div class="alert alert-info text-center">
                            Aucune réservation trouvée.
                        </div>
                    @endif
                </div>

                <div class="card-footer d-flex justify-content-center">
                    {{ $reservations->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
