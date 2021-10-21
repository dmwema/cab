@php
    $self_style = '/css/home.css';
@endphp
@include('partials.header')
        <h1>congo avenir business</h1>  
        <div class="desc">Gestion Client - Gestion Fournisseurs - Gestion Stock</div>
        <div class="buttons">
            <a href="{{ route('clients') }}">
                <h3>Gestion Clients</h3>
                <div class="review">
                    <div class="count"><span class="amount">{{ $clients }}</span> {{ $clients > 1 ? 'Clients enrégistrés' : 'Client enrégistré' }}</div>
                    <div class="total"><span class="amount">{{ $balance }}$</span> de dète</div>
                </div>
            </a>
            <a href="#">
                <h3>Gestion Fournisseurs</h3>
                <div class="review">
                    <div class="count">25 Clients enrégistrés</div>
                    <div class="total">2500$ de dète</div>
                </div>
            </a>
            <a href="#">
                <h3>Gestion Stock</h3>
                <div class="review">
                    <div class="count">25 Clients enrégistré</div>
                    <div class="total">2500$ de dète</div>
                </div>
            </a>
        </div>
    </div>
@include('partials.footer')