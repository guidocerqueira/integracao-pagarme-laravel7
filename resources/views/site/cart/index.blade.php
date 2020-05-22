@extends('site.master.master')

@section('content')
<div class="px-md-5 py-5 mx-md-5 text-center">
    <h1 class="display-4">Carrinho de Compras</h1>
</div>

<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">Produto</th>
            <th class="text-center" scope="col">Quantidade</th>
            <th scope="col">Valor</th>
            <th class="text-right" scope="col">Ação</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($cart as $value)
            <tr>
                <td>{{ $value['name'] }}</td>
                <td class="text-center">
                    <a href="{{ route('site.cart.product.update.amount', ['id' => $value['id'], 'type' => 'rm']) }}" class="btn btn-primary btn-sm mr-4">-</a>
                        {{ $value['qtd'] }}
                    <a href="{{ route('site.cart.product.update.amount', ['id' => $value['id'], 'type' => 'add']) }}" class="btn btn-primary btn-sm ml-4">+</a>
                </td>
                <td>R$ {{ number_format($value['amount'], 2, ',', '.') }}</td>
                <td class="text-right"><a href="{{ route('site.cart.product.remove', ['id' => $value['id']]) }}" class="btn btn-danger btn-sm">EXCLUIR</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    <div class="alert alert-primary w-100 text-center" role="alert">
                        Seu carrinho está vazio
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

<div class="text-right">
    <a href="{{ route('site.home') }}" class="btn btn-primary">Continuar Comprando</a>
    <a href="{{ route('site.account.checkout') }}" class="btn btn-success">Finalizar Compra</a>
</div>
@endsection