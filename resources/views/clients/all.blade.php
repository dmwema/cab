@php
    $self_style = "/css/styles.css";
    $i = 0;
    $title = "clients";
@endphp

@include('partials.header')

@include('partials.nav')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="buttons not-to-print" style="margin-top: 25px">
  <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i> Ajouter un client</button>
  <a href="#" class="btn btn-primary" id="print" style="color: #fff"><i style="color: #fff" class="fas fa-print"></i></a>
  <form method="get" class="filter row mt-2" style="border: 1px solid #eee; padding: 15px; border-radius: 4px;">
    <div class="col-md-3">
      <label for="dalegate2" class="form-label" style="margin-bottom: -5px">Délégué</label>
      <select name="delegate2" id="delegate2" class="form-select">
      <option value="0" {{ $is_filter ? 'selected': '' }}> - </option>
        @foreach ($delegates_obj as $delegate)
          @if($delegate2_obj == null)
          <option value="{{ $delegate->id ?? '' }}">{{ $delegate->name ?? '' }}</option>
          @else
          <option value="{{ $delegate->id ?? '' }}" {{ $delegate2_obj->id == $delegate->id ? 'selected': '' }}>{{ $delegate->name ?? '' }}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label" style="margin-bottom: -5px"></label>
      <div class="">
        <input type="submit" class="btn btn-primary" name="button" value="Filtrer">
      </div>
    </div>
  </form>
</div>

<div id="toprint">
  <div class="head" style="margin-top: 30px;">
    <div>
      <h3>Congo Avenir Business <span style="font-weight: lighter"> | Tous les clients</span></h3>
      <p style="opacity: .5; margin-bottom: 0; margin-top: 15px;">Situation financière de tous les clients</p>
    </div>
  </div>
  <div class="divider"></div>
  <table class="table table-bordered ">
      <thead>
        <tr style="background-color: #eee">
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">Adresse</th>
          <th scope="col">Délégué</th>
          <th scope="col">Balance</th>
          <th scope="col" style="width: 200px;">Actions</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($clients as $client)
          @php
              $i++
          @endphp
          <tr>
              <th scope="row">{{ $i }}</th>
              <td>{{ $client->name }}</td>
              <td>{{ $client->adress ?? 'Non définit' }}</td>
              <td>{{ $delegates[$client->id] }}</td>
              <td style="font-weight: bolder; text-align: right;">{{ number_format($balances[$client->id], 1  , ',', ' ') }}$</td>
              <td>
                  <form action="{{ route('clients.delete', ['id' => $client->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                      @csrf
                      <input type="hidden" name="_method" value="DELETE" />
                      <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                      <a href="{{ route('clients.edit', ['id' => $client->id]) }}" class="btn btn-success"><i style="color: #fff" class="fas fa-pencil-alt"></i></a>
                  </form>
              </td>
          </tr>
          @endforeach
          <tr style="font-weight: bolder; text-align: right; font-size: 25px">
            <td></td>
            <td></td>
            <td></td>
            <td>Total</td>
            <td style="background: rgb(222, 255, 236); color: green">{{ number_format($total, 1, ',', ' ') }}$</td>
            <td></td>
          </tr>
      </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" action="{{ route('clients.store') }}">
    @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajouter un client</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label for="name" class="form-label">Nom</label>
              <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
              <label for="phone" class="form-label">Téléphone</label>
              <input type="text" class="form-control" id="phone" name="phone" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
              <label for="adress" class="form-label">Adresse</label>
              <input type="text" class="form-control" id="adress" name="adress" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="delegate" class="form-label">Délégué</label>
            <select name="delegate" id="delegate" class="form-select">
              @foreach ($delegates_obj as $delegate)
              <option value="{{ $delegate->id ?? '' }}">{{ $delegate->name ?? '' }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
              <label for="initial" class="form-label">Solde initial (en $)</label>
              <input type="number" step="any" class="form-control" id="initial" name="initial" aria-describedby="emailHelp">
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
