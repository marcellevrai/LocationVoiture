@extends('layouts.client')

@section('title', 'Facture de réservation')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="card p-4 shadow-sm">
                <h4 class="mb-3">Facture de réservation</h4>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <p><strong>Voiture :</strong> {{ $voiture->marque }} {{ $voiture->modele }}</p>
                <p><strong>Matricule :</strong> {{ $voiture->matricule }}</p>
                <p><strong>Dates :</strong> du {{ $reservation->date_debut }} au {{ $reservation->date_fin }} ({{ $jours }} jours)</p>

                <hr>

                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Location voiture</span>
                        <strong>{{ number_format($voiture->prix_voiture_jour, 0, ',', ' ') }} FCFA x {{ $jours }}</strong>
                    </li>
                    @if($reservation->avec_chauffeur && $voiture->prix_chauffeur_jour)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Chauffeur</span>
                            <strong>{{ number_format($voiture->prix_chauffeur_jour, 0, ',', ' ') }} FCFA x {{ $jours }}</strong>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <strong>Total à payer</strong>
                        <strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                    </li>
                </ul>

                <div class="text-end">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paiementModal" data-id="{{ $reservation->id }}">
                        Payer maintenant
                    </button>
                </div>
                              
            </div>
        </div>
    </div>
</div>
@include('client.reservations._modal')
@endsection
