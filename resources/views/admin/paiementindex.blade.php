@extends('layouts.admin')

@section('title', 'Historique des paiements')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <!-- Titre -->
            <div class="page-header card mb-4">
                <div class="row align-items-end">
                    <div class="col">
                        <div class="page-header-title">
                            <i class="icofont icofont-credit-card bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Historique des paiements</h4>
                                <span>Suivez les paiements effectués sur la plateforme</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barre de recherche -->
            <div class="card mb-3">
                <div class="card-body">
                    <input type="text" id="search-paiement" class="form-control" placeholder="Recherche par client ou date (ex: 2025-06-30)">
                </div>
            </div>

            <!-- Liste des paiements -->
            <div class="card">
                <div class="card-body table-responsive p-0" id="paiements-container">
                    @include('admin.paiementliste')
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script JS de recherche dynamique -->
<script>
    document.getElementById('search-paiement').addEventListener('keyup', function () {
        let query = this.value;
        fetch(`{{ route('admin.paiements.search') }}?query=${query}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('paiements-container').innerHTML = data.html;
            });
    });
</script>
@endsection
