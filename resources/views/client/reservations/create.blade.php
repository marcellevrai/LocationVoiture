@extends('layouts.client')

@section('title', 'Réserver une voiture')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-header card mb-4">
                <h4>Réserver {{ $voiture->marque }} {{ $voiture->modele }}</h4>
                <span class="text-muted">Complétez le formulaire</span>
            </div>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card p-4">
                <form id="form-reservation" action="{{ route('reservation.store', $voiture->id) }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Date de début</label>
                            <input type="date" name="date_debut" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Date de fin</label>
                            <input type="date" name="date_fin" class="form-control" required>
                        </div>
                    </div>

                    @if($voiture->prix_chauffeur_jour)
                        <div class="form-group mb-3">
                            <label>Avec chauffeur ?</label><br>
                            <input type="radio" name="avec_chauffeur" value="1"> Oui
                            <input type="radio" name="avec_chauffeur" value="0" checked> Non
                        </div>
                    @endif

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Confirmer</button>
                        <a href="{{route('voitures.public.index')}}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
