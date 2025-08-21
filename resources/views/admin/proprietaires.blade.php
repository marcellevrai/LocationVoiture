@extends('layouts.admin')

@section('content')


<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
             
            <div class="page-header card mb-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center">
                        <i class="icofont icofont-book-alt bg-c-blue text-white me-3" style="font-size: 1.8rem; padding: 0.6rem; border-radius: 10px;"></i>
                        <div>
                            <h4 class="mb-0">Liste des Proprietaires</h4>
                            <span class="text-muted">Historique complet</span>
                        </div>
                    </div>
            
                    <input type="text" id="search-proprietaires" class="form-control mt-3" placeholder="Rechercher un proprietaire...">

                </div>
            </div>
            

            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Number</th>
                                    <th>Inscription</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="proprietaires-table">
                                @include('admin.proprietairesliste', ['proprietaires' => $proprietaires])
                            </tbody>
                        </table>                    
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('search-proprietaires').addEventListener('keyup', function () {
        let query = this.value;

        fetch(`{{ route('admin.proprietaires.search') }}?query=${query}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('proprietaires-table').innerHTML = data.html;
            });
    });
</script>



@endsection