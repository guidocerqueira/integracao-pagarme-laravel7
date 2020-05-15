@extends('site.master.master')

@section('content')
<x-alert/>
<div class="px-md-5 py-5 mx-md-5">
    <h1 class="display-4 text-primary">Contratar Plano</h1>
    <p class="lead">
        Você selecionou o plano <b class="text-success">{{ $plan->name }}</b>. Esse plano tem um valor de <b class="text-success">R$ {{ $plan->amount_formated }}</b> e 
        é cobrado a cada <b class="text-success">{{ $plan->days }}</b> dias.
    </p>
    <p class="lead">
        Período de Teste: <b class="text-success">{{ $plan->trial_days }} dias(s).</b>
    </p>
    <p class="lead">
        Forma de pagamento: <b class="text-success">{{ $plan->payment_methods_name }}</b>
    </p>

    @if ($plan->payment_methods == 1 || $plan->payment_methods == 3)
        <hr>
        <h3 class="display-6">Pagar com Cartão de Crédito</h3>
        <form action="{{ route('site.account.plan.subscription.store', ['id' => $plan->id]) }}" method="POST">
            @csrf
            @if (Auth::user()->usercards()->count() > 0)
                @foreach (Auth::user()->usercards as $usercard)
                    <div class="alert alert-secondary">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="card{{ $loop->iteration }}" name="card_id" value="{{ $usercard->card_id }}">
                            <label class="form-check-label" for="card{{ $loop->iteration }}">
                                Bandeira: {{ $usercard->brand }}<br>
                                Final: **** **** **** {{ $usercard->last_digits }}<br>
                                {{ mb_strtoupper($usercard->holder_name) }}
                            </label>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="alert alert-secondary">
                <div class="form-group">
                    <label>Número do Cartão</label>
                    <input class="form-control" type="text" name="card_number">
                </div>

                <div class="form-group">
                    <label>Nome do Titular</label>
                    <input class="form-control" type="text" name="card_holder_name">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Mês Vencimento</label>
                        <input class="form-control" maxlength="2" type="text" name="month">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Ano Vencimento</label>
                        <input class="form-control" maxlength="2" type="text" name="year">
                    </div>

                    <div class="form-group col-md-6">
                        <label>CVV</label>
                        <input class="form-control" type="text" name="card_cvv">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Efetuar Pagamento</button>
        </form>
    @endif

    @if ($plan->payment_methods == 2 || $plan->payment_methods == 3)
    <hr>
    <h3 class="display-6">Pagar com Boleto</h3>
    <a href="{{ route('site.account.plan.subscription.store.billet', ['id' => $plan->id]) }}" class="btn btn-primary">Gerar Boleto</a>
    @endif
</div>
@endsection