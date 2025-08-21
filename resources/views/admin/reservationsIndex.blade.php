@extends('layouts.admin')
@section('title', 'Gestion des réservations')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <!-- Titre et Filtres -->
            <div class="page-header card mb-4">
                <div class="row align-items-end">
                    <div class="col">
                        <div class="page-header-title">
                            <i class="icofont icofont-list bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Liste des Réservations</h4>
                                <span>Filtrer par statut</span>
                            </div>
                        </div>
                    </div>
                    <div class="col text-end">
                        <select class="form-select w-auto d-inline" id="filtre-statut">
                            <option value="">Tous les statuts</option>
                            <option value="confirmé">Confirmé</option>
                            <option value="en attente">En attente</option>
                            <option value="expirée">Expirée</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tableau -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Réservations</h5>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Client</th>
                                <th>Voiture</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody id="reservation-table">
                            @include('admin.reservationslist', ['reservations' => $reservations])
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script Ajax -->
<script>
    document.getElementById('filtre-statut').addEventListener('change', function () {
        const statut = this.value;
        fetch(`{{ route('admin.reservations.search') }}?statut=${statut}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('reservation-table').innerHTML = data.html;
            });
    });
</script>
@endsection
