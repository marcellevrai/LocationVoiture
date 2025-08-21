@extends('layouts.admin')
@section('title', 'Liste des voitures')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <!-- Titre -->
            <div class="page-header card mb-4">
                <div class="row align-items-end">
                    <div class="col">
                        <div class="page-header-title">
                            <i class="icofont icofont-car bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Voitures enregistrées</h4>
                                <span>Recherche par matricule</span>
                            </div>
                        </div>
                    </div>
                    <div class="col text-end">
                        <input type="text" id="search-matricule" class="form-control w-auto d-inline" placeholder="Rechercher...">
                    </div>
                </div>
            </div>

            <!-- Tableau -->
            <div class="card">
                <div class="card-header"><h5 class="mb-0">Toutes les voitures</h5></div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Matricule</th>
                                <th>Marque</th>
                                <th>Modèle</th>
                                <th>Propriétaire</th>
                                <th>Places</th>
                            </tr>
                        </thead>
                        <tbody id="voiture-table">
                            @include('admin.voituresliste', ['voitures' => $voitures])
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script AJAX -->
<script>
    document.getElementById('search-matricule').addEventListener('keyup', function () {
        let query = this.value;

        fetch(`{{ route('admin.voitures.search') }}?query=${query}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('voiture-table').innerHTML = data.html;
            });
    });
</script>
@endsection
