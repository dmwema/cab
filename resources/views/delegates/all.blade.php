@php
    $self_style = "/css/styles.css";
    $i = 0;
    $title = "delegates";
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
  <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i> Ajouter un délégué</button>
  <a href="#" class="btn btn-primary" id="print" style="color: #fff"><i style="color: #fff" class="fas fa-print"></i></a>
</div>

<div id="toprint">
  <div class="head" style="margin-top: 30px;">
    <div>
      <h3>Congo Avenir Business <span style="font-weight: lighter"> | Tous les délégués</span></h3>
      <p style="opacity: .5; margin-bottom: 0; margin-top: 15px;">Tous les délégués enrégistrés</p>
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
          @foreach ($delegates as $delegate)  
          @php
              $i++
          @endphp        
          <tr>
              <th scope="row">{{ $i }}</th>
              <td>{{ $delegate->name }}</td>
              <td>{{ $delegate->phone }}</td>
              <td>
                  <form action="{{ route('delegates.delete', ['id' => $delegate->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce délégué ?')">
                      @csrf
                      <input type="hidden" name="_method" value="DELETE" />
                      <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                      <a href="{{ route('delegates.edit', ['id' => $delegate->id]) }}" class="btn btn-success"><i style="color: #fff" class="fas fa-pencil-alt"></i></a>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" action="{{ route('delegates.store') }}">
    @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajouter un délégué</h5>
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