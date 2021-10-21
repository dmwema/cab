@php
    $self_style = "/css/styles.css";
    $title = "edit";
@endphp

@include('partials.header')
@include('partials.nav')

<div class="head" style="margin-top: 40px;">
    <h3>{{ $client->name }} {{ $client->adress ? ' - ' . $client->adress: ''}} <span style="font-weight: lighter">| Modifier</span></h3>
    <div class="buttons">
        <form action="{{ route('clients.delete', ['id' => $client->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Supprimer ce client</button>
        </form>
    </div>
</div>
<hr style="opacity: .09">

<form method="POST" action="{{ route('clients.update', ['id' => $client->id]) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="mb-3">
      <label for="name" class="form-label">Nom du client</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}">
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">Numéro de téléphone</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{{ $client->phone }}">
    </div>
    <div class="mb-3">
      <label for="adress" class="form-label">Adresse</label>
      <input type="text" class="form-control" id="adress" name="adress" value="{{ $client->adress }}">
    </div>
    <div class="mb-3">
        <label for="delegate" class="form-label">Delégué</label>
        <select name="delegate" id="delegate" class="form-select">
            @foreach ($delegates as $delegate)
            @if ($client->delegate == null)
                <option value="" selected></option>
            @endif
            <option value="{{ $delegate->id }}" {{ $delegate->id == $client->delegate ? 'selected': ''}}>{{ $delegate->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
      <label for="initial" class="form-label">Solde initial (en $)</label>
      <input type="text" class="form-control" id="initial" name="initial" value="{{ $client->initial }}">
    </div>
    <button type="submit" class="btn btn-primary">Enrégistrer</button>
</form>

@include('partials.footer')
