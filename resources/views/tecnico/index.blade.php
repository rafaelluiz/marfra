@extends('template')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <table class="table table-striped table-hover dataTables-example" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Número</th>
                            <th>Tipo de cliente</th>
                            <th>Nome do cliente</th>
                            <th>Data da abertura</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr class="gradeX">
                            <td>{{ $registro->id }}</td>
                            <td>#MF{{ $registro->label }}</td>
                            <td>{{ $registro->cliente_tipo }}</td>
                            <td>{{ $registro->cliente }}</td>
                            <td>{{ $registro->created_at }}</td>
                            <td>@if ($registro->tec_orcamentista == 0) <label class="label label-primary">Aberto</label> @else <label class="label label-success">Finalizado</label> @endif</td>
                            <td>
                                <a href="orcamento/editar/{{ $registro->id }}" title="editar"><i class="fa fa-edit text-navy"></i></a>
                                <a href="orcamento/editar/{{ $registro->id }}" title="registro de ocorrência"><i class="fa fa-eye text-navy"></i></a>
                            </td>
                        </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('.dataTables-example').dataTable({
            responsive: true,
            "language": {
                            "sLengthMenu": "_MENU_  resultados por página",
                            "sInfo": "Mostrando _START_ - _END_ de _TOTAL_ entradas",
                            "sSearch": "Procurar:",
                            "sInfoEmpty": "Mostrando 0 - 0 de 0 entradas",
                            "sInfoFiltered": "(filtrado de _MAX_ totais itens)",
                            "sZeroRecords": "Nenhum resultado encontrado",
                            "paginate": {
                                            "first": "Primeira",
                                            "sLast": "Última",
                                            "sNext": "Próxima",
                                            "sPrevious": "Anterior"
                                        }
			}
        });
        
        var utilidade = new Utilidade();
        
        $('.btn-excluir').each(function(){
            $(this).click(function(){
                utilidade.modalExclusao($(this));
            });
        });
    });
</script>
@endsection