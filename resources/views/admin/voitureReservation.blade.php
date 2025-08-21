@extends('layouts.admin')

@section('title', 'Réservations de ' . $voiture->marque . ' ' . $voiture->modele)

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-header card mb-4">
                <h4 class="mb-0">Réservations pour : {{ $voiture->marque }} {{ $voiture->modele }} ({{ $voiture->matricule }})</h4>
            </div>

            <div class="card">
                <div class="card-header"><h5 class="mb-0">Liste des réservations</h5></div>
                <div class="card-body table-responsive">
                    @if($voiture->reservations->count())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Statut</th>
                                    <th>Avec chauffeur</th>
                                    <th>Date de réservation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($voiture->reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->client->name }} {{ $reservation->client->firstname }}</td>
                                        <td>{{ $reservation->date_debut }}</td>
                                        <td>{{ $reservation->date_fin }}</td>
                                        <td>
                                            <span class="badge @if($reservation->statut == 'confirmé') bg-success @else bg-warning text-dark @endif">
                                                {{ ucfirst($reservation->statut) }}
                                            </span>
                                        </td>
                                        <td>{{ $reservation->avec_chauffeur ? 'Oui' : 'Non' }}</td>
                                        <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted text-center">Aucune réservation pour cette voiture.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
