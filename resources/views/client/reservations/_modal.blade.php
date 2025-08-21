<!-- Modal de paiement -->
<div class="modal fade" id="paiementModal" tabindex="-1" aria-labelledby="paiementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="paiementModalLabel">Informations de paiement</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
  
        <form method="POST" action="{{ route('reservation.paiement.process', $reservation->id) }}">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Nom sur la carte</label>
                <input type="text" name="nom_carte" class="form-control" required>
            </div>
  
            <div class="mb-3">
                <label class="form-label">Numéro de carte</label>
                <input type="text" name="numero_carte" class="form-control" maxlength="16" required>
            </div>
  
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Expiration (MM/YY)</label>
                    <div class="d-flex gap-2">
                      <div class="flex-fill">
                          <label class="form-label">Mois</label>
                          <select name="expiration_mois" class="form-select" required>
                              <option value="">-- MM --</option>
                              @for ($m = 1; $m <= 12; $m++)
                                  <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}</option>
                              @endfor
                          </select>
                      </div>
                      <div class="flex-fill">
                          <label class="form-label">Année</label>
                          <select name="expiration_annee" class="form-select" required>
                              <option value="">-- YY --</option>
                              @for ($y = now()->year; $y <= now()->year + 6; $y++)
                                  <option value="{{ substr($y, -2) }}">{{ $y }}</option>
                              @endfor
                          </select>
                      </div>
                  </div>
                                  </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Code de securité</label>
                  <input type="text" name="cs" class="form-control" maxlength="3" required>
              </div>
            </div>
          </div>
  
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Valider le paiement</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  