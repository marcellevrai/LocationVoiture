<table class="table table-striped mb-0">
    <thead class="bg-light">
        <tr>
            <th>Référence</th>
            <th>Client</th>
            <th>Voiture</th>
            <th>Date de paiement</th>
            <th>Montant</th>
        </tr>
    </thead>
    <tbody>
        @forelse($paiements as $paiement)
        <tr>
            <td><strong>{{ $paiement->reference }}</strong></td>
            <td>{{ $paiement->reservation->client->firstname }} {{ $paiement->reservation->client->name }}</td>
            <td>{{ $paiement->reservation->voiture->marque }} {{ $paiement->reservation->voiture->modele }}</td>
            <td>{{ $paiement->created_at->format('d/m/Y') }}</td>
            <td>{{ number_format($paiement->total_calculé, 0, ',', ' ') }} FCFA</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center text-muted">Aucun paiement trouvé.</td>
        </tr>
        @endforelse
    </tbody>
</table>
