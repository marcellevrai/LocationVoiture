@extends('layouts.client') {{-- ton layout GuruAble adapté --}}

@section('title', 'Voitures disponibles')

@section('content')
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">

                    @if(session('success'))
                        <div id="flash-message" class="alert alert-success">{{ session('success') }}</div>
                    @endif
            
                    <div class="page-header card">
                        <div class="row align-items-end">
                            <div class="col-lg-12">
                                <div class="page-header-title">
                                    <i class="icofont icofont-car bg-c-blue"></i>
                                    <div class="d-inline">
                                        <h4>Nos voitures disponibles</h4>
                                        <span>Choisissez la voiture de votre choix et réservez-la</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filtrage -->
                    @include('layouts.partials.request')

                    <!-- Affichage des voitures -->
                    <div class="row">
                        @forelse($voitures as $voiture)
                            <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100">
                    <img src="{{ asset('storage/' . $voiture->image_voiture) }}" class="card-img-top" alt="Voiture" style="height: 180px; object-fit: cover;">
                

                <div class="card-body text-center">
                    <h5 class="card-title">{{ $voiture->marque }} {{ $voiture->modele }}</h5>
                    <p class="mb-1"><i class="icofont icofont-gear"></i> Transmission : <strong>{{ ucfirst($voiture->transmission) }}</strong></p>
                    <p class="mb-1"><i class="icofont icofont-fuel"></i> Carburant : <strong>{{ ucfirst($voiture->type_carburant) }}</strong></p>
                    <p class="mb-1"><i class="icofont icofont-users"></i> Places : <strong>{{ $voiture->nbre_place }}</strong></p>
                </div>
                <div class="card-footer bg-white text-center">
                    <button class="btn btn-sm btn-outline-info me-2" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $voiture->id }}">
                        Voir détails
                    </button>

                    <a href="{{ route('reservation.create', $voiture->id) }}" class="btn btn-sm btn-primary">
                        Réserver
                    </a>
                </div>

                {{-- Inclure la modale --}}
                @include('client.voitures._modal', ['voiture' => $voiture])
            </div>
            </div>

                @empty
                    <div class="col-12 text-center text-muted">
                        <p>Aucune voiture trouvée pour le moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $voitures->withQueryString()->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
