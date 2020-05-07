<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('site.home') }}">Sua Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_menu" aria-controls="navbar_menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar_menu">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::segment(1) == null ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('site.home') }}">Home</a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'plan' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('site.plan') }}">Planos</a>
            </li>
        </ul>
        <a class="btn btn-sm btn-outline-light mr-2" href="{{ route('site.account.login') }}">Minha Conta</a>
        <a class="btn btn-sm btn-outline-success" href="{{ route('admin.formlogin') }}">Dashboard</a>
    </div>
</nav>