@extends('site.master.master')

@section('content')
<div class="row my-5">
    <div class="col-md-3">
        @include('site.includes.sidebar')
    </div>
    <div class="col-md-9 bg-light rounded">
        <h4 class="text-right mb-5 mt-3 text-secondary">Resumo</h4>
        <x-alert/>

        @if (Auth::user()->subscriptions()->count() > 0)
            @foreach (Auth::user()->subscriptions as $subscription)
                <div class="alert alert-primary mt-4">
                    Plano: {{ $subscription->plan->name }}<br>
                    Status: {{ $subscription->status }}<br>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection