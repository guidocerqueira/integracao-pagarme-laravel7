@extends('site.master.master')

@section('content')
<div class="row my-5">
    <div class="col-md-6 px-5">
        <h3>Login</h3>
        <p class="mb-4">Já tem uma conta? Faça o Login!</p>

        @if (old('type') && old('type') == 'login')
            <x-alert/>
        @endif
        
        <form class="mt-4 login" name="login" action="{{ route('site.account.login.post') }}" method="POST">
            <input type="hidden" name="type" value="login">
            @csrf
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="E-mail">
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" name="password" placeholder="Senha">
            </div>
            
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>
    <div class="col-md-6 px-5">
        <h3>Cadastro</h3>
        <p class="mb-4">Não tem conta? Cadastre-se!</p>
        @if (old('type') && old('type') == 'register')
            <x-alert/>
        @endif

        @if(session()->exists('message'))
            <x-alert/>
        @endif
        <form class="mt-4 register" name="register" action="{{ route('site.account.register.post') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="register">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" name="password" placeholder="Senha" value="{{ old('password') }}">
            </div>
            
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</div>
@endsection