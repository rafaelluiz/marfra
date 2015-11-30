@extends('template')

@section('content')
<div class="row m-b-lg">
    <div class="col-lg-4">
        <a href="{{ route('usuario.novo') }}"><button type="button" class="btn btn-primary">Cadastrar novo</button></a>
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
                            <th>Departamento</th>
                            <th>Cargo</th>
                            <th>Nome de usuário</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr class="gradeX">
                            <td>{{ $registro->id }}</td>
                            <td>{{ $registro->nome }}</td>
                            <td>{{ $registro->grupo }}</td>
                            <td>{{ $registro->cargo }}</td>
                            <td>{{ $registro->login }}</td>
                            <td>@if($registro->ativo) <label class="label label-primary">Ativo</label> @else <label class="label label-danger">Inativo</label> @endif</td>
                            <td>
                                <a href="usuario/{{ $registro->id }}/editar" title="editar"><i class="fa fa-edit text-navy"></i></a>
                                <!--
                                <a href="#" class="btn-excluir" title="excluir" data-toggle="modal" data-target="#modal-confirm" data-id="{{ $registro->id }}" data-nome="{{ $registro->nome }}" data-href="cliente/excluir/{{ $registro->id }}">
                                    <i class="fa fa-trash text-navy"></i></a> -->
                                <!--href="cliente/excluir/{{ $registro->id }}" -->
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
        /*
        var utilidade = new Utilidade();
        
        $('.btn-excluir').each(function(){
            $(this).click(function(){
                utilidade.modalExclusao($(this));
            });
        });
        */
    });
</script>
@endsection