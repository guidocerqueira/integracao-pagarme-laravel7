@extends('admin.master.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Usuários</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Usuários</a></li>
                    <li class="breadcrumb-item active">Editar Usuário</li>
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
                <h3 class="card-title">Editar Usuário</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>

            <form action="{{ route('admin.user.update', ['user' => $user->id]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group">
                        <label>*Nome</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') ?? $user->name }}">
                    </div>
                    <div class="form-group">
                        <label>*Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') ?? $user->email }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*CPF</label>
                            <input type="text" class="form-control mask-doc" name="cpf" value="{{ old('cpf') ?? $user->cpf }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>*RG</label>
                            <input type="text" class="form-control" name="rg" value="{{ old('rg') ?? $user->rg }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Data de Nascimento</label>
                            <input type="text" class="form-control mask-date" name="birth_date" value="{{ old('birth_date') ?? $user->birth_date }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gênero</label>
                            <select class="form-control" name="genre">
                                <option selected disabled>Selecione...</option>
                                <option value="male" {{ old('genre') == 'male' ? 'selected' : ($user->genre == 'male' ? 'selected' : '') }}>Masculino</option>
                                <option value="female" {{ old('genre') == 'female' ? 'selected' : ($user->genre == 'female' ? 'selected' : '') }}>Feminino</option>
                                <option value="other" {{ old('genre') == 'other' ? 'selected' : ($user->genre == 'other' ? 'selected' : '') }}>Outros</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Telefone</label>
                            <input type="text" class="form-control mask-phone" name="phone" value="{{ old('phone') ?? $user->phone }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Celular</label>
                            <input type="text" class="form-control mask-cell" name="cell" value="{{ old('cell') ?? $user->cell }}">
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*CEP</label>
                            <input type="text" class="form-control mask-zipcode zip_code_search" name="zip_code" value="{{ old('zip_code') ?? $user->zip_code }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label>*Logradouro</label>
                            <input type="text" name="street" class="form-control street" value="{{ old('street') ?? $user->street }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Nº</label>
                            <input type="text" name="number" class="form-control" value="{{ old('number') ?? $user->number }}">
                        </div>
                    </div>
        
                    <div class="form-group">
                        <label>Complemento</label>
                        <input type="text" name="complement" class="form-control" value="{{ old('complement') ?? $user->complement }}">
                    </div>
        
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Bairro</label>
                            <input type="text" name="district" class="form-control district" value="{{ old('district') ?? $user->district }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Cidade</label>
                            <input type="text" name="city" class="form-control city" value="{{ old('city') ?? $user->city }}">
                        </div>
                    </div>
        
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Estado</label>
                            <input type="text" name="state" class="form-control state" value="{{ old('state') ?? $user->state }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>*País</label>
                            <input type="text" name="country" class="form-control" value="{{ old('country') ?? $user->country }}">
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-group">
                        <label>*Senha</label>
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" {{ $user->is_admin == true ? 'checked' : '' }} type="checkbox" id="is_admin" name="is_admin">
                            <label for="is_admin" class="custom-control-label">Usuário Administrador</label>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                    <a href="javascript:void(0);" class="btn btn-danger delete_item_sweet" data-action="{{ route('admin.user.destroy', ['user' => $user->id]) }}"><i class="fas fa-trash"></i> Excluir</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection