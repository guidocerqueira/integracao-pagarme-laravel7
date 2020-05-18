<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="javascript:;" class="brand-link">
        <span class="brand-text font-weight-light">Painel Administrativo</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link {{ Request::segment(1) == 'admin' && Request::segment(2) == 'home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ Request::segment(2) == 'user' ? 'menu-open' : '' }}">
                    <a href="javascript:;" class="nav-link {{ Request::segment(2) == 'user' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Usuários <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}" class="nav-link {{ Request::segment(2) == 'user' && Request::segment(3) == null ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.create') }}" class="nav-link {{ Request::segment(2) == 'user' && Request::segment(3) == 'create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Novo Usuário</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ Request::segment(2) == 'product' ? 'menu-open' : '' }}">
                    <a href="javascript:;" class="nav-link {{ Request::segment(2) == 'product' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Produtos <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link {{ Request::segment(2) == 'product' && Request::segment(3) == null ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.create') }}" class="nav-link {{ Request::segment(2) == 'product' && Request::segment(3) == 'create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Novo Produto</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ Request::segment(2) == 'pagarme' ? 'menu-open' : '' }}">
                    <a href="javascript:;" class="nav-link {{ Request::segment(2) == 'pagarme' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Pagarme <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.plan.index') }}" class="nav-link {{ Request::segment(2) == 'pagarme' && Request::segment(3) == 'plan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Planos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.transaction.index') }}" class="nav-link {{ Request::segment(2) == 'pagarme' && Request::segment(3) == 'transaction' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transações</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>