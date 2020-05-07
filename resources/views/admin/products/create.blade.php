@extends('admin.master.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Produtos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Produtos</a></li>
                    <li class="breadcrumb-item active">Novo Produto</li>
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
                <h3 class="card-title">Cadastro de Produto</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>

            <form action="{{ route('admin.product.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>*Nome</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label>*Marca</label>
                        <input type="text" class="form-control" name="brand" value="{{ old('brand') }}">
                    </div>
                    <div class="form-group">
                        <label>*Valor</label>
                        <input type="text" class="form-control mask-money" name="price" value="{{ old('price') }}">
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection