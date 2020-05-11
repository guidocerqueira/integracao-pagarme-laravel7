@extends('admin.master.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Planos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Planos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Listagem de Planos</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>

            <div class="card-body">
                <div class="row d-flex align-items-stretch">
                    @forelse ($plans as $plan)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                        <div class="card bg-light w-100">
                            <div class="card-header text-{{ $plan->status == '1' ? 'success' : 'danger' }} border-bottom-0">
                                {{ $plan->status == '1' ? 'Ativo' : 'Inativo' }}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="lead"><b>{{ $plan->name }}</b></h2>
                                        <p class="text-muted text-sm mb-0"><b>Cobrança: </b>R$ {{ $plan->amount_formated }} a cada {{ $plan->days }} dias.</p>
                                        <p class="text-muted text-sm mb-0"><b>Período de Teste: </b>{{ $plan->trial_days }} dia(s).</p>
                                        <p class="text-muted text-sm mb-0"><b>Pagamento aceito: </b>{{ $plan->payment_methods_name }}</p>
                                        <p class="text-muted text-sm mb-0"><b>Benefícios: </b>{{ $plan->benefits }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="{{ route('admin.plan.edit', ['plan' => $plan->id]) }}" class="btn btn-sm btn-success">Editar Plano</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-primary col-12">
                        <h5><i class="icon fas fa-info"></i> Que pena!</h5>
                        Não encontramos planos cadastrados no momento.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('admin.plan.create') }}" class="btn btn-primary">Adicionar Novo Plano</a>
            </div>
        </div>
    </div>
</div>
@endsection