@forelse($clients as $client)
<tr>
    <td>{{ $client->name }} {{ $client->firstname }}</td>
    <td>{{ $client->email }}</td>
    <td>{{ $client->created_at->format('d/m/Y') }}</td>
</tr>
@empty
<tr>
    <td colspan="4" class="text-center text-muted">Aucun client trouvé</td>
</tr>
@endforelse
