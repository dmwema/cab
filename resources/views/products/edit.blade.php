@php
    $self_style = "/css/styles.css";
    $title = "edit";
@endphp

@include('partials.header')
@include('partials.nav')

<div class="head" style="margin-top: 40px;">
    <h3>{{ $product->name }} <span style="font-weight: lighter">| Modifier</span></h3>
    <div class="buttons">
        <form action="{{ route('products.delete', ['id' => $product->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Supprimer ce produit</button>
        </form>
    </div>
</div>
<hr style="opacity: .09">

<form method="POST" action="{{ route('products.update', ['id' => $product->id]) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="mb-3">
      <label for="name" class="form-label">Nom du produit</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Prix</label>
      <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
    </div>
    <button type="submit" class="btn btn-primary">Enrégistrer</button>
</form>

@include('partials.footer')