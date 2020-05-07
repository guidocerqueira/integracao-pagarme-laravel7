<div class="text-center mb-4 px-5">
    <img class="img-thumbnail rounded-circle" src="https://via.placeholder.com/300X300?text=USER">
</div>

<div class="text-center mb-4 px-2">
    <h4>{{ Auth::user()->name }}</h4>
</div>

<div class="list-group">
    <a href="{{ route('site.account.home') }}" class="list-group-item list-group-item-action {{ Request::segment(1) == 'account' && Request::segment(2) == 'home' ? 'active' : '' }}">Resumo</a>
    <a href="{{ route('site.account.info') }}" class="list-group-item list-group-item-action {{ Request::segment(1) == 'account' && Request::segment(2) == 'info' ? 'active' : '' }}">Meus Dados</a>
    <a href="{{ route('site.account.transaction') }}" class="list-group-item list-group-item-action {{ Request::segment(1) == 'account' && Request::segment(2) == 'transaction' ? 'active' : '' }}">Minhas Compras</a>
    <a href="{{ route('site.account.logout') }}" class="list-group-item list-group-item-action text-danger">Desconectar</a>
</div>