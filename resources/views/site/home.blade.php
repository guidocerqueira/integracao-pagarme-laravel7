@extends('site.master.master')

@section('content')
<div class="px-md-5 py-5 mx-md-5 text-center">
    <h1 class="display-4">Nossos Produtos</h1>
    <p class="lead">
        Preços e condições especiais nos melhores produtos você só encontra aqui. 
        Aproveite as nossas promoções e faça suas compras!
    </p>
</div>

<div class="row">
    @foreach ($products as $product)
    <div class="col-md-3">
        <div class="card mb-4 shadow-sm">
            <img class="card-img-top" src="https://via.placeholder.com/300X300?text=PRODUCT">
            <div class="card-body">
                <p style="min-height: 50px;">{{ $product->name }}</p>
                <h2 class="card-title pricing-card-title">R$ {{ explode(',', $product->price_formated)[0] }}<small class="text-muted">,{{ explode(',', $product->price_formated)[1] }}</small></h2>
                <ul class="list-unstyled mt-3 mb-4 text-left">
                    <li class="text-muted">10x de R$ {{ number_format($product->price/10, 2, ',', '.') }} sem juros</li>
                    <li class="text-success">Frete Grátis</li>
                </ul>
                <a href="{{ route('site.cart.product.add', ['id' => $product->id]) }}" class="btn btn-lg btn-block btn-primary">Comprar</a>
            </div>
        </div>
    </div>
    @endforeach

    <div class="col-12">
        <nav class="d-flex justify-content-center mt-4">
            {{ $products->links('site.includes.paginator') }}
        </nav>
    </div>
</div>
@endsection