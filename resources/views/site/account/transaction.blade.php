@extends('site.master.master')

@section('content')
<div class="row my-5">
    <div class="col-md-3">
        @include('site.includes.sidebar')
    </div>
    <div class="col-md-9 bg-light rounded">
        <h4 class="text-right mb-5 mt-3 text-secondary">Minhas Transações</h4>
        <x-alert/>
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Valor</th>
                    <th>Método Pagameto</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_code }}</td>
                    <td>R$ {{ $transaction->amount_formated }}</td>
                    <td>{{ $transaction->payment_method }}</td>
                    <td>{{ $transaction->status }}</td>
                    <td>{!! $transaction->payment_method == 'boleto' && $transaction->status == 'waiting_payment' ? '<a target="_blank" href="'.$transaction->boleto_url.'">Ver Boleto</a>' : '--' !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                responsive: true,
                pageLength: 25,
                language: {
                    sEmptyTable: "Nenhum registro encontrado",
                    sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
                    sInfoFiltered: "(Filtrados de _MAX_ registros)",
                    sInfoPostFix: "",
                    sInfoThousands: ".",
                    sLengthMenu: "_MENU_ resultados por página",
                    sLoadingRecords: "Carregando...",
                    sProcessing: "Processando...",
                    sZeroRecords: "Nenhum registro encontrado",
                    sSearch: "Pesquisar",
                    oPaginate: {
                        sNext: "Próximo",
                        sPrevious: "Anterior",
                        sFirst: "Primeiro",
                        sLast: "Último"
                    },
                    oAria: {
                        sSortAscending: ": Ordenar colunas de forma ascendente",
                        sSortDescending: ": Ordenar colunas de forma descendente"
                    }
                }
            });
        });
    </script>
@endsection