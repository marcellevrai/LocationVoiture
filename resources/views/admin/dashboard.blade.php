@extends('layouts.admin')

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <!-- Titre principal -->
            <div class="page-header card mb-4">
                <div class="row align-items-end">
                    <div class="col">
                        <div class="page-header-title">
                            <i class="icofont icofont-home bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Tableau de bord</h4>
                                <span>Vue globale de vos activités</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistiques principales -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body text-center">
                            <i class="icofont icofont-users-alt-4 fs-3 mb-2"></i>
                            <h6 class="mb-1">Clients</h6>
                            <h3>{{ $totalClients }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body text-center">
                            <i class="icofont icofont-user-suited fs-3 mb-2"></i>
                            <h6 class="mb-1">Propriétaires</h6>
                            <h3>{{ $totalProprietaires }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning shadow">
                        <div class="card-body text-center">
                            <i class="icofont icofont-car fs-3 mb-2"></i>
                            <h6 class="mb-1">Voitures</h6>
                            <h3>{{ $totalVoitures }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-danger shadow">
                        <div class="card-body text-center">
                            <i class="icofont icofont-calendar fs-3 mb-2"></i>
                            <h6 class="mb-1">Réservations</h6>
                            <h3>{{ $totalReservations }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Réservations récentes -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="icofont icofont-clock-time"></i> 5 Dernières réservations</h5>
                </div>
                <div class="card-body table-responsive">
                    @if($reservationRecentes->count())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Voiture</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservationRecentes as $res)
                                    <tr>
                                        <td>{{ $res->client->firstname }} {{ $res->client->name }}</td>
                                        <td>{{ $res->voiture->marque }} {{ $res->voiture->modele }}</td>
                                        <td>{{ $res->date_debut }}</td>
                                        <td>{{ $res->date_fin }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($res->statut == 'confirmé') bg-success 
                                                @elseif($res->statut == 'en attente') bg-warning text-dark 
                                                @else bg-secondary 
                                                @endif">
                                                {{ ucfirst($res->statut) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted text-center">Aucune réservation récente trouvée.</p>
                    @endif
                </div>
            </div>
        <div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Réservations par statut</h5>
    </div>
    <div class="card-body">
        <canvas id="reservationChart" height="200"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('reservationChart').getContext('2d');

    const reservationChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($reservationsParStatut->keys()) !!},
        datasets: [{
            label: 'Réservations',
            data: {!! json_encode($reservationsParStatut->values()) !!},
            backgroundColor: 'rgba(59, 130, 246, 0.2)',
            borderColor: '#3b82f6',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


</script>



        </div>
    </div>
</div>
@endsection
