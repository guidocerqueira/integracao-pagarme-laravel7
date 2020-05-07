@extends('site.master.master')

@section('content')
<div class="px-md-5 py-5 mx-md-5 text-center">
    <h1 class="display-4">Nossos Planos</h1>
    <p class="lead">
        Escolha o plano ideal e aproveite os recursos para utilizar a nossa plataforma. 
        Você pode cancelar a qualquer momento sem que seja cobrado taxas extras. 
        Afinal, aqui nunca terá taxas extras! :)
    </p>
</div>

<div class="row">
    <div class="col-md-4 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Free</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">R$0 <small class="text-muted">/ mês</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>10 usuários</li>
                    <li>2 GB de armazenamento</li>
                    <li>Suporte E-mail</li>
                    <li>Acesso a comunidade</li>
                </ul>
                <button type="button" class="btn btn-lg btn-block btn-outline-primary">Continuar Free</button>
            </div>
        </div>
    </div>
    <div class="col-md-4 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Pro</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">R$15 <small class="text-muted">/ mês</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>20 usuários</li>
                    <li>10 GB de armazenamento</li>
                    <li>*Suporte Vip E-mail</li>
                    <li>Acesso a comunidade</li>
                </ul>
                <button type="button" class="btn btn-lg btn-block btn-primary">Assinar</button>
            </div>
        </div>
    </div>
    <div class="col-md-4 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Enterprise</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">R$29 <small class="text-muted">/ mês</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>30 usuários</li>
                    <li>15 GB de armazenamento</li>
                    <li>Suporte Vip E-mail + WhatsApp</li>
                    <li>Acesso a comunidade</li>
                </ul>
                <button type="button" class="btn btn-lg btn-block btn-primary">Assinar</button>
            </div>
        </div>
    </div>
</div>
@endsection