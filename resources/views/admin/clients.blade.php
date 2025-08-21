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
                            <h4 class="mb-0">Liste des clients</h4>
                            <span class="text-muted">Historique complet</span>
                        </div>
                    </div>
            
                    <input type="text" id="search-client" class="form-control mt-3" placeholder="Rechercher un client...">

                </div>
            </div>
            

            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Inscription</th>
                                </tr>
                            </thead>
                            <tbody id="clients-table">
                                @include('admin.clientsliste', ['clients' => $clients])
                            </tbody>
                        </table>                    
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('search-client').addEventListener('keyup', function () {
        let query = this.value;

        fetch(`{{ route('admin.clients.search') }}?query=${query}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('clients-table').innerHTML = data.html;
            });
    });
</script>



@endsection