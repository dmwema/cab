@php
    //dd(\Carbon\Carbon::now()->format('Y-d-m'))
@endphp
<nav> 
    <ul>
        <li class="{{ $title == "home" ? 'active': '' }}"><a href="/">Accueil</a></li>
        <li class="{{ $title == "clients" ? 'active': '' }}"><a href="{{ route('clients') }}">Clients</a></li>
        <li class="{{ $title == "delegates" ? 'active': '' }}"><a href="{{ route('delegates') }}">Delégués</a></li>
        <li class="{{ $title == "products" ? 'active': '' }}"><a href="{{ route('products') }}">Produits</a></li>
        <li><button data-toggle="modal" data-target="#deliveryModal" data-bs-toggle="modal" data-bs-target="#deliveryModal" type="button" class="btn btn-info" style="color: #fff !important"><i class="fas fa-plus"></i> Livraison</button></li>
        <li><button type="button" data-toggle="modal" data-target="#paymentModal" data-bs-toggle="modal" data-bs-target="#paymentModal" class="btn btn-danger" style="color: #fff !important"><i class="fas fa-minus"></i> Versément</button></li>
    </ul>
</nav>

<!-- Modal -->
<div class="modal fade" id="deliveryModal" tabindex="-1" aria-labelledby="deliveryModalLabel" aria-hidden="true">
    <form method="POST" action="{{ route('transactions.store') }}">
      @csrf
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deliveryModalLabel">Ajouter une livraison</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                  <label for="date" class="form-label">Date livraison</label>
                  <input type="date" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::now()->format('Y-d-m') }}">
              </div>
              <div class="mb-3 col-md-6">
                  <label for="product" class="form-label">Produit à livrer</label>
                  <select name="product" id="product" class="form-select">
                      @foreach ($products_nav as $product)
                          <option value="{{ $product->id }}">{{ $product->name }}</option>
                      @endforeach
                  </select>
              </div>
            </div>
            <div class="mb-3">
                <label for="client" class="form-label">Client</label>
                <select name="client" id="client" class="form-select">
                    @foreach ($clients_nav as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                  <label for="qte" class="form-label">Quantité</label>
                  <input type="number" class="form-control" id="qte" name="qte">
              </div>
              <div class="mb-3 col-md-6">
                  <label for="price" class="form-label">Prix</label>
                  <input type="number" step="any" class="form-control" id="price" name="price" aria-describedby="emailHelp">
              </div>
            </div>
            <hr style="opacity: .5; margin: 0; margin-bottom: 7px;; border: 1px solid #eee">
            <p style="margin-bottom: 10px; padding: 0;"><strong>Bonus</strong></p>
            <div class="mb-3">
                <input type="number" class="form-control" id="qte" name="qte">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Enrégistrer</button>
          </div>
        </div>
      </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <form method="POST" action="{{ route('transactions.store') }}">
    @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paymentModalLabel">Ajouter un versément</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label for="date" class="form-label">Date versément</label>
              <input type="date" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::now()->format('Y-d-m') }}">
          </div>
          <div class="mb-3">
              <label for="client" class="form-label">Client</label>
              <select name="client" id="client" class="form-select">
                  @foreach ($clients_nav as $client)
                      <option value="{{ $client->id }}">{{ $client->name }}</option>
                  @endforeach
              </select>
          </div>
          <div class="mb-3">
              <label for="amount" class="form-label">Montant payé</label>
              <input type="number" step="any" class="form-control" id="amount" name="amount">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Enrégistrer</button>
        </div>
      </div>
    </div>
  </form>
</div>

@include('partials.footer')