@extends('layouts.client')

@section('title', 'Mes Réservations')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            @if(session('success'))
                <div id="flash-message" class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="page-header card mb-4">
                <h4 class="mb-0">Mes Réservations</h4>
                <span class="text-muted">Suivi de vos réservations</span>
            </div>

            @if($reservations->count())
                <div class="row">
                    @foreach($reservations as $reservation)
                        @php
                            $voiture = $reservation->voiture;
                            $jours = \Carbon\Carbon::parse($reservation->date_debut)->diffInDays(\Carbon\Carbon::parse($reservation->date_fin)) + 1;
                            $total = $voiture->prix_voiture_jour * $jours;
                            if ($reservation->avec_chauffeur && $voiture->prix_chauffeur_jour) {
                                $total += $voiture->prix_chauffeur_jour * $jours;
                            }
                            $estExpire = $reservation->statut == 'en attente' && $reservation->created_at->diffInHours(now()) >= 24;
                        @endphp

                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card shadow h-100 border-0">
                                <div class="card-body d-flex flex-column justify-content-between">

                                    <div class="mb-3">
                                        <h5 class="card-title text-primary mb-1">
                                            <i class="icofont icofont-car-alt"></i> {{ $voiture->marque }} {{ $voiture->modele }}
                                        </h5>
                                        <small class="text-muted">Matricule : {{ $voiture->matricule }}</small>
                                    </div>

                                    <div class="mb-2">
                                        <p class="mb-1"><i class="icofont icofont-calendar"></i>
                                            <strong>Du :</strong> {{ $reservation->date_debut }} <strong>au</strong> {{ $reservation->date_fin }}
                                        </p>
                                        <p class="mb-1"><i class="icofont icofont-users-alt-4"></i>
                                            <strong>Places :</strong> {{ $voiture->nbre_place }}
                                        </p>
                                    </div>

                                    <div class="mb-2">
                                        <p class="mb-1"><i class="icofont icofont-currency"></i>
                                            <strong>Total :</strong> {{ number_format($total, 0, ',', ' ') }} FCFA
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <span class="badge 
                                            @if($reservation->statut == 'confirmé') bg-success 
                                            @elseif($estExpire) bg-danger 
                                            @else bg-warning text-dark @endif 
                                            fs-6 px-3 py-2 rounded-pill shadow-sm">
                                            @if($estExpire)
                                                <i class="icofont icofont-warning-alt"></i> Expirée (non payée)
                                            @else
                                                <i class="icofont icofont-check-circled"></i> {{ ucfirst($reservation->statut) }}
                                            @endif

                                        </span>
                                        @if($reservation->statut === 'confirmé')
                                        <a href="{{ route('reservation.facturePdf', $reservation->id) }}" 
                                            class="btn btn-sm px-3 py-1 text-white" 
                                            style="background-color: #fbb500; border-radius: 20px; font-size: 13px;"
                                            target="_blank">
                                            <i class="ti-download me-1"></i> Télécharger
                                         </a>
                                         
                                        @endif

                                    </div>

                                    @if($reservation->statut == 'en attente' && !$estExpire)
                                        <div class="text-end d-flex gap-2 justify-content-end">      
                                            <button class="btn btn-outline-primary btn-sm mr-5" data-bs-toggle="modal" data-bs-target="#paiementModal">
                                                <i class="icofont icofont-credit-card"></i> Payer maintenant
                                            </button>

                                            <!-- Bouton Annuler -->
                                            <form action="{{ route('reservation.annuler', $reservation->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="icofont icofont-close-circled"></i> Annuler
                                                </button>
                                            </form>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center">
                    Vous n'avez encore effectué aucune réservation.
                </div>
            @endif

        </div>
    </div>
</div>
@if(isset($reservation))
    @include('client.reservations._modal')
@endif

@endsection
