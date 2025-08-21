<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $reservation->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background: #f7f7f7;
            padding: 40px;
            color: #333;
        }
        .header, .footer {
            background-color: #111;
            color: #fff;
            padding: 15px 30px;
            border-radius: 8px;
        }
        .header .company-logo {
            font-size: 24px;
            font-weight: bold;
            color: #ffc107;
        }
        .invoice-box {
            background: #fff;
            border-radius: 12px;
            padding: 35px;
            margin-top: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .invoice-title {
            font-size: 26px;
            font-weight: bold;
            color: #fbb500;
        }
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }
        .info-box {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 8px;
        }
        .table thead {
            background-color: #fbb500;
            color: #fff;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total-row td {
            font-weight: bold;
            font-size: 16px;
            background: #eaeaea;
        }
        .note {
            font-size: 13px;
            margin-top: 25px;
            color: #666;
            background-color: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header d-flex justify-content-between align-items-center">
        <div class="company-logo">CARRENTAL</div>
        <div class="text-end">
            <div><strong>Facture N° :</strong> {{ $reservation->id }}</div>
            <div><strong>Date :</strong> {{ now()->format('d/m/Y') }}</div>
        </div>
    </div>

    <!-- Invoice Content -->
    <div class="invoice-box">

        <!-- Infos Client et Réservation -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="section-title">Facturé à :</div>
                <div class="info-box">
                    <strong>{{ $reservation->client->name }} {{ $reservation->client->firstname }}</strong><br>
                    Email : {{ $reservation->client->email ?? 'Non spécifié' }}<br>
                    Tél. : {{ $reservation->client->number ?? 'Non spécifié' }}
                </div>
            </div>
            <div class="col-md-6 text-end">
                <div class="section-title">Détails de la réservation :</div>
                <div class="info-box text-start">
                    Voiture : <strong>{{ $voiture->marque }} {{ $voiture->modele }}</strong><br>
                    Période : {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}
                    au {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}<br>
                    Nombre de jours : {{ $jours }}
                </div>
            </div>
        </div>

        <!-- Tableau des coûts -->
        
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Prix / Jour</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Location voiture</td>
                            <td>{{ number_format($voiture->prix_voiture_jour, 0, ',', ' ') }} FCFA</td>
                            <td>{{ number_format($voiture->prix_voiture_jour * $jours, 0, ',', ' ') }} FCFA</td>
                        </tr>
                        @if($reservation->avec_chauffeur && $voiture->prix_chauffeur_jour)
                        <tr>
                            <td>Service chauffeur</td>
                            <td>{{ number_format($voiture->prix_chauffeur_jour, 0, ',', ' ') }} FCFA</td>
                            <td>{{ number_format($voiture->prix_chauffeur_jour * $jours, 0, ',', ' ') }} FCFA</td>
                        </tr>
                        @endif

                        <tr class="total-row">
                            <td colspan="2" class="text-end">Total TTC</td>
                            <td>{{ number_format($total, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Note -->
        <div class="note">
            <strong>Note :</strong> Cette facture est valable pour le service réservé. Veuillez contacter le propriétaire pour tout renseignement ou pour récupérer la voiture.
        </div>
    </div>

    <!-- Footer -->
    <div class="footer mt-4 text-center">
        <div>
            Contact propriétaire : +228 {{ $voiture->proprietaire->number }} |
            {{ $voiture->proprietaire->email }} |
            Lomé, Togo
        </div>
        <div style="margin-top: 5px;">Merci pour votre confiance.</div>
    </div>

</body>
</html>
