<!-- Inicio Subitem Fechamento de Vão - Painel Fixo Lateral -->
<div class="panel-group" id="{{ $configuracao['id'] }}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#{{ $configuracao['id'] }}" href="#collapse{{ $configuracao['id'] }}">Painel Fixo Lateral</a>
                <a href="javascript:void(0)" onclick="(new Produto).excluir('{{ $configuracao['id'] }}');">
                    <span class="excluir_subitem">Excluir item<i class="fa fa-trash text-navy"></i></span>
                </a>
            </h4>
        </div>
        <div id="collapse{{ $configuracao['id'] }}" class="panel-collapse collapse p-sm">
            <div class="panel-body">
                <div class="form-group col-lg-12 margin-b-0 padding-0">
                    <div class="form-group col-lg-2">
                        <label class="control-label">Metragem</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim Subitem Fechamento de Vão - Painel Fixo Lateral -->