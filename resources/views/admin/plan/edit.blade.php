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
                    <li class="breadcrumb-item"><a href="{{ route('admin.plan.index') }}">Planos</a></li>
                    <li class="breadcrumb-item active">Editar Plano</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <x-alert />
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Informações do Plano</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>

            <form action="{{ route('admin.plan.update', ['plan' => $plan->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>*Nome</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') ?? $plan->name }}">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Prazo em dias</label>
                            <input disabled type="text" class="form-control" name="days" value="{{ old('days') ?? $plan->days }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Período de teste (Padrão: 0)</label>
                            <input type="text" class="form-control" name="trial_days" value="{{ old('trial_days') ?? $plan->trial_days }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Valor</label>
                            <input disabled type="text" class="form-control mask-money" name="amount" value="{{ old('amount') ?? $plan->amount_formated }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Forma de Pagamento</label>
                            <select disabled name="payment_methods" class="form-control">
                                <option value="1" {{ old('payment_methods') == '1' ? 'selected' : ($plan->payment_methods == 1 ? 'selected' : '') }}>Boleto</option>
                                <option value="2" {{ old('payment_methods') == '2' ? 'selected' : ($plan->payment_methods == 2 ? 'selected' : '') }}>Cartão de Crédito</option>
                                <option value="3" {{ old('payment_methods') == '3' ? 'selected' : ($plan->payment_methods == 3 ? 'selected' : '') }}>Boleto e Cartão de Crédito</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status') == '1' ? 'selected' : ($plan->status == 1 ? 'selected' : '') }}>Ativo</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : ($plan->status == 0 ? 'selected' : '') }}>Inativo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Benefícios (separe por vírgulas)</label>
                        <textarea class="form-control" rows="4" name="benefits" placeholder="Informe os benefícios separados por vírgula...">{{ old('benefits') ?? $plan->benefits }}</textarea>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection