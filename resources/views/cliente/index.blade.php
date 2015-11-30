@extends('template')

@section('content')
<div class="row m-b-lg">
    <div class="col-lg-4">
        <a href="{{ route('cliente/novo') }}"><button type="button" class="btn btn-primary">Cadastrar novo</button></a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <table class="table table-striped table-hover dataTables-example" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Tel. Fixo</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                        <tr class="gradeX">
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->tipo }}</td>
                            <td class="center">{{ $cliente->telefone }}</td>
                            <td class="center">{{ $cliente->email }}</td>
                            <td>
                                <a href="cliente/editar/{{ $cliente->id }}" title="editar"><i class="fa fa-edit text-navy"></i></a>
                                <a href="atendimento/orcamento/novo/{{ $cliente->id }}" title="abertura de orçamento"><i class="fa fa-dollar text-navy"></i></a>
                                <a href="#" class="btn-excluir" title="excluir" data-toggle="modal" data-target="#modal-confirm" data-id="{{ $cliente->id }}" data-nome="{{ $cliente->nome }}" data-href="cliente/excluir/{{ $cliente->id }}">
                                    <i class="fa fa-trash text-navy"></i></a>
                                <!--href="cliente/excluir/{{ $cliente->id }}" -->
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