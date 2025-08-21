@extends('layouts.client')

@section('title', 'Détails de la voiture')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-header card mb-4">
                <div class="row align-items-end">
                    <div class="col-lg-12">
                        <div class="page-header-title d-flex align-items-center gap-3">
                            <i class="icofont icofont-eye bg-c-blue"></i>
                            <div>
                                <h4 class="mb-0">{{ $voiture->marque }} {{ $voiture->modele }}</h4>
                                <span class="text-muted">Détails complets du véhicule</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Détail de la voiture -->
            <div class="card shadow-sm">
                <div class="row g-0">
                    <!-- Image -->
                    <div class="col-md-5">
                        @if($voiture->image_voiture)
                            <img src="{{ asset('storage/' . $voiture->image_voiture) }}" alt="Image voiture" class="img-fluid h-100 w-100" style="object-fit: cover;">
                        @else
                            <div class="bg-light d-flex justify-content-center align-items-center h-100 text-muted">
                                Aucune image
                            </div>
                        @endif
                    </div>

                    <!-- Infos -->
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title">{{ $voiture->marque }} {{ $voiture->modele }}</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Matricule :</strong> {{ $voiture->matricule }}</li>
                                <li class="list-group-item"><strong>Transmission :</strong> {{ ucfirst($voiture->transmission) }}</li>
                                <li class="list-group-item"><strong>Carburant :</strong> {{ ucfirst($voiture->type_carburant) }}</li>
                                <li class="list-group-item"><strong>Nombre de places :</strong> {{ $voiture->nbre_place }}</li>
                                <li class="list-group-item"><strong>Prix voiture :</strong> {{ number_format($voiture->prix_voiture_jour, 0, ',', ' ') }} FCFA / jour</li>
                                @if($voiture->prix_chauffeur_jour)
                                    <li class="list-group-item"><strong>Prix chauffeur :</strong> {{ number_format($voiture->prix_chauffeur_jour, 0, ',', ' ') }} FCFA / jour</li>
                                @endif
                            </ul>

                            <div class="mt-4 text-end">
                                <a href="{{ route('reservation.create', ['voiture' => $voiture->id]) }}" class="btn btn-primary">
                                    Réserver cette voiture
                                </a>
                                <a href="" class="btn btn-outline-secondary">Retour</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
