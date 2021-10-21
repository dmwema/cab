@php
    $self_style = "/css/styles.css";
    $title = "edit";
@endphp

@include('partials.header')
@include('partials.nav')

<div class="head" style="margin-top: 40px;">
    <h3>{{ $delegate->name }} {{ $delegate->adress ? ' - ' . $delegate->adress: ''}} <span style="font-weight: lighter">| Modifier</span></h3>
    <div class="buttons">
        <form action="{{ route('delegates.delete', ['id' => $delegate->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce délégué ?')">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Supprimer ce délégué</button>
        </form>
    </div>
</div>
<hr style="opacity: .09">

<form method="POST" action="{{ route('delegates.update', ['id' => $delegate->id]) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="mb-3">
      <label for="name" class="form-label">Nom du délégué</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $delegate->name }}">
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">Numéro de téléphone</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{{ $delegate->phone }}">
    </div>
    <button type="submit" class="btn btn-primary">Enrégistrer</button>
</form>

@include('partials.footer')