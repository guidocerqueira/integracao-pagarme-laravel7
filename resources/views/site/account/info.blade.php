@extends('site.master.master')

@section('content')
<div class="row my-5">
    <div class="col-md-3">
        @include('site.includes.sidebar')
    </div>
    <div class="col-md-9 bg-light rounded">
        <h4 class="text-right mb-5 mt-3 text-secondary">Meus Dados</h4>
        <x-alert/>
        <form class="mb-4" action="{{ route('site.account.info.update') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $user->id }}">
            <h5>Dados Pessoais</h5>
            <hr>

            <div class="form-group">
                <label>*Nome</label>
                <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ old('name') ?? $user->name }}">
            </div>

            <div class="form-group">
                <label>*E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') ?? $user->email }}">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>*CPF</label>
                    <input type="text" name="cpf" class="form-control mask-doc" placeholder="CPF" value="{{ old('cpf') ?? $user->cpf }}">
                </div>
                <div class="form-group col-md-6">
                    <label>RG</label>
                    <input type="text" name="rg" class="form-control" placeholder="RG" value="{{ old('rg') ?? $user->rg }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Telefone</label>
                    <input type="text" name="phone" class="form-control mask-phone" placeholder="Telefone" value="{{ old('phone') ?? $user->phone }}">
                </div>
                <div class="form-group col-md-6">
                    <label>*Celular</label>
                    <input type="text" name="cell" class="form-control mask-cell" placeholder="Celular" value="{{ old('cell') ?? $user->cell }}">
                </div>
            </div>

            <h5 class="mt-4">Endereço</h5>
            <hr>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>*CEP</label>
                    <input type="text" name="zip_code" class="form-control mask-zipcode zip_code_search" placeholder="CEP" value="{{ old('zip_code') ?? $user->zip_code }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-10">
                    <label>*Logradouro</label>
                    <input type="text" name="street" class="form-control street" placeholder="Logradouro" value="{{ old('street') ?? $user->street }}">
                </div>
                <div class="form-group col-md-2">
                    <label>Nº</label>
                    <input type="text" name="number" class="form-control" placeholder="Nº" value="{{ old('number') ?? $user->number }}">
                </div>
            </div>

            <div class="form-group">
                <label>Complemento</label>
                <input type="text" name="complement" class="form-control" placeholder="Complemento" value="{{ old('complement') ?? $user->complement }}">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>*Bairro</label>
                    <input type="text" name="district" class="form-control district" placeholder="Bairro" value="{{ old('district') ?? $user->district }}">
                </div>
                <div class="form-group col-md-6">
                    <label>*Cidade</label>
                    <input type="text" name="city" class="form-control city" placeholder="Cidade" value="{{ old('city') ?? $user->city }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>*Estado</label>
                    <input type="text" name="state" class="form-control state" placeholder="Estado" value="{{ old('state') ?? $user->state }}">
                </div>
                <div class="form-group col-md-6">
                    <label>*País</label>
                    <input type="text" name="country" class="form-control" placeholder="País" value="{{ old('country') ?? $user->country }}">
                </div>
            </div>

            <h5 class="mt-4">Alterar Senha de Acesso</h5>
            <hr>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" name="password" placeholder="Senha">
            </div>

            <div class="form-group text-right mt-5">
                <button type="submit" class="btn btn-success">Atualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection