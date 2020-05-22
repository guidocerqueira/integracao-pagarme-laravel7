@extends('site.master.master')

@section('content')
<x-alert/>
<div class="px-md-5 py-5 mx-md-5">
    <h1 class="display-4 text-primary text-center mb-5">Resumo do Pedido</h1>
    
    <table class="table table-borderless">
        <thead>
            <tr>
                <th scope="col">Produto</th>
                <th class="text-center" scope="col">Quantidade</th>
                <th class="text-right" scope="col">Valor</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cart as $value)
                <tr>
                    <td>{{ $value['name'] }}</td>
                    <td class="text-center">{{ $value['qtd'] }}</td>
                    <td class="text-right">R$ {{ number_format($value['amount'], 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="alert alert-danger w-100 text-center" role="alert">
                            Não possui itens no seu pedido, adicione itens para finalizar o pedido
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right pt-5">
                    <hr>
                    <h3>Total: R$ {{ number_format($cart->sum('amount'), 2, ',', '.') }}</h3>
                </td>
            </tr>
        </tfoot>
    </table>

    <hr>
    <h3 class="display-6">Pagar com Cartão de Crédito</h3>
    <form action="{{ route('site.account.checkout.transaction') }}" method="POST">
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

    <hr>
    <h3 class="display-6">Pagar com Boleto</h3>
    <a href="{{ route('site.account.checkout.transaction.billet') }}" class="btn btn-primary">Gerar Boleto</a>
</div>
@endsection