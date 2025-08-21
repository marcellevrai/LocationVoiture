@forelse($reservations as $reservation)
<tr>
    <td>{{ $reservation->client->firstname }} {{ $reservation->client->name }}</td>
    <td>{{ $reservation->voiture->marque }} {{ $reservation->voiture->modele }}</td>
    <td>{{ $reservation->date_debut }}</td>
    <td>{{ $reservation->date_fin }}</td>
    <td>
        <span class="badge {{ $reservation->statut == 'confirmé' ? 'bg-success' : 'bg-warning text-dark' }}">
            {{ ucfirst($reservation->statut) }}
        </span>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center text-muted">Aucune réservation trouvée</td>
</tr>
@endforelse
