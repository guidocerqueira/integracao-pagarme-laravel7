@extends('admin.master.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cash-register"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">A Compensar</span>
                        <span class="info-box-number">R$ {{ number_format($balance['waiting_funds']['amount'] / 100, 2, ',', '.') }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cash-register"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Disponível</span>
                        <span class="info-box-number">R$ {{ number_format($balance['available']['amount'] / 100, 2, ',', '.') }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cash-register"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Transferido</span>
                        <span class="info-box-number">R$ {{ number_format($balance['transferred']['amount'] / 100, 2, ',', '.') }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Últimas Transações</h3>
        
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr role="row">
                                        <th>Código</th>
                                        <th>Cliente</th>
                                        <th>Valor</th>
                                        <th>Forma de Pagamento</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                    <tr role="row">
                                        <td>{{ $transaction->transaction_code }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>R$ {{ $transaction->amount_formated }}</td>
                                        <td>{{ $transaction->payment_method }}</td>
                                        <td>{{ $transaction->status }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection