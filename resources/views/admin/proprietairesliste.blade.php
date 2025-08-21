@forelse($proprietaires as $proprietaire)
<tr>
    <td>{{ $proprietaire->name }} {{ $proprietaire->firstname }}</td>
    <td>{{ $proprietaire->email }}</td>
    <td>{{ $proprietaire->number }}</td>
    <td>{{ $proprietaire->created_at->format('d/m/Y') }}</td>
    <td><a href="{{route('admin.proprietaires.voiture', $proprietaire->id)}}" class="btn btn-sm btn-outline-primary"><i class="icofont icofont-car-alt"></i>Voir voitures</a></td>
</tr>
@empty
<tr>
    <td colspan="4" class="text-center text-muted">Aucun proprietaire trouvé</td>
</tr>
@endforelse
