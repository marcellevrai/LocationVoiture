<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Filtrer les voitures</h5>
    </div>
    <div class="card-block">
        <form method="GET"  action="{{ route('client.voitures.filtre') }}">
            <div class="row">
                <!-- Recherche -->
                <div class="col-md-4 mb-3">
                    <input type="text" name="q" class="form-control" placeholder="Recherche par marque, modèle..." value="{{ request('q') }}">
                </div>

                <!-- Transmission -->
                <div class="col-md-3 mb-3">
                    <select name="transmission" class="form-control">
                        <option value="">Transmission</option>
                        <option value="manuelle" {{ request('transmission') == 'manuelle' ? 'selected' : '' }}>Manuelle</option>
                        <option value="automatique" {{ request('transmission') == 'automatique' ? 'selected' : '' }}>Automatique</option>
                    </select>
                </div>

                <!-- Carburant -->
                <div class="col-md-3 mb-3">
                    <select name="carburant" class="form-control">
                        <option value="">Type de carburant</option>
                        <option value="essence" {{ request('carburant') == 'essence' ? 'selected' : '' }}>Essence</option>
                        <option value="diesel" {{ request('carburant') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="electrique" {{ request('carburant') == 'electrique' ? 'selected' : '' }}>Électrique</option>
                        <option value="hybride" {{ request('carburant') == 'hybride' ? 'selected' : '' }}>Hybride</option>
                    </select>
                </div>

                <!-- Bouton filtrer -->
                <div class="col-md-2 mb-3">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
                
            </div>
        </form>
    </div>
</div>
