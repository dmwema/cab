@php
    $self_style = "/css/styles.css";
    $i = 0;
    $title = "products";
@endphp

@include('partials.header')

@include('partials.nav')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="buttons not-to-print" style="margin-top: 25px;">
  <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i> Ajouter un produit</button>
  <a href="#" class="btn btn-primary" id="print" style="color: #fff"><i style="color: #fff" class="fas fa-print"></i></a>
</div>

<div id="toprint">
  <div class="head" style="margin-top: 30px;">
    <div>
      <h3>Congo Avenir Business <span style="font-weight: lighter"> | Tous les produits</span></h3>
      <p style="opacity: .5; margin-bottom: 0; margin-top: 15px;">Tous les produits enrégistrés</p>
    </div>
  </div>
  <div class="divider"></div>
  <table class="table table-bordered ">
      <thead>
        <tr style="background-color: #eee">
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">Téléphone</th>
          <th scope="col" style="width: 200px;">Actions</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($products as $product)  
          @php
              $i++
          @endphp        
          <tr>
              <th scope="row">{{ $i }}</th>
              <td>{{ $product->name }}</td>
              <td>{{ $product->price }}</td>
              <td>
                  <form action="{{ route('products.delete', ['id' => $product->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                      @csrf
                      <input type="hidden" name="_method" value="DELETE" />
                      <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                      <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-success"><i style="color: #fff" class="fas fa-pencil-alt"></i></a>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" action="{{ route('products.store') }}">
    @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajouter un produit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label for="name" class="form-label">Nom</label>
              <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
              <label for="price" class="form-label">Prix (par Carton en $)</label>
              <input type="text" class="form-control" id="price" name="price" aria-describedby="emailHelp">
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