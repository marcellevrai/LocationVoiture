<div class="modal fade" id="modalDetail{{ $voiture->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $voiture->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalLabel{{ $voiture->id }}">{{ $voiture->marque }} {{ $voiture->modele }}</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body row">
          <div class="col-md-5">
            @if($voiture->image_voiture)
                <img src="{{ asset('storage/' . $voiture->image_voiture) }}" class="img-fluid w-100" style="height: 220px; object-fit: cover;" alt="Image voiture">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 220px;">Aucune image</div>
            @endif
          </div>
  
          <div class="col-md-7">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Matricule :</strong> {{ $voiture->matricule }}</li>
                <li class="list-group-item"><strong>Transmission :</strong> {{ ucfirst($voiture->transmission) }}</li>
                <li class="list-group-item"><strong>Carburant :</strong> {{ ucfirst($voiture->type_carburant) }}</li>
                <li class="list-group-item"><strong>Places :</strong> {{ $voiture->nbre_place }}</li>
                <li class="list-group-item"><strong>Prix voiture :</strong> {{ number_format($voiture->prix_voiture_jour, 0, ',', ' ') }} FCFA / jour</li>
                @if($voiture->prix_chauffeur_jour)
                    <li class="list-group-item"><strong>Prix chauffeur :</strong> {{ number_format($voiture->prix_chauffeur_jour, 0, ',', ' ') }} FCFA / jour</li>
                @endif
            </ul>
          </div>
        </div>
  
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <a href="{{ route('reservation.create', $voiture->id) }}" class="btn btn-primary">Réserver cette voiture</a>
        </div>
      </div>
    </div>
  </div>
  