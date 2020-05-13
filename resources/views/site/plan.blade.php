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
    @foreach ($plans as $plan)
        <div class="col-md-4 text-center">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">{{ $plan->name }}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">R$ {{ explode(',', $plan->amount_formated)[0] }}<small class="text-muted">,{{ explode(',', $plan->amount_formated)[1] }}</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        @foreach ($plan->array_benefits as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('site.account.plan.subscription', ['id' => $plan->id]) }}" class="btn btn-lg btn-block btn-primary">Assinar</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection