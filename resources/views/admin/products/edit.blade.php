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
                    <li class="breadcrumb-item active">Editar Produto</li>
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
                <h3 class="card-title">Editar Produto</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>

            <form action="{{ route('admin.product.update', ['product' => $product->id]) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $product->id }}">

                <div class="card-body">
                    <div class="form-group">
                        <label>*Nome</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') ?? $product->name }}">
                    </div>
                    <div class="form-group">
                        <label>*Marca</label>
                        <input type="text" class="form-control" name="brand" value="{{ old('brand') ?? $product->brand }}">
                    </div>
                    <div class="form-group">
                        <label>*Valor</label>
                        <input type="text" class="form-control mask-money" name="price" value="{{ old('price') ?? $product->price_formated }}">
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                    <a href="javascript:void(0);" class="btn btn-danger delete_item_sweet" data-action="{{ route('admin.product.destroy', ['product' => $product->id]) }}"><i class="fas fa-trash"></i> Excluir</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection