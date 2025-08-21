@forelse($voitures as $voiture)
<tr>
    <td>{{ $voiture->matricule }}</td>
    <td>{{ $voiture->marque }}</td>
    <td>{{ $voiture->modele }}</td>
    <td>{{ $voiture->proprietaire->name ?? 'Non défini' }}</td>
    <td>{{ $voiture->nbre_place }}</td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center text-muted">Aucune voiture trouvée</td>
</tr>
@endforelse
