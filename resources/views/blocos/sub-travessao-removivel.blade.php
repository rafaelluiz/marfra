<!-- Inicio Subitem Portão de Garagem - Travessão removível -->
<div class="panel-group" id="{{ $configuracao['id'] }}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#{{ $configuracao['id'] }}" href="#collapse{{ $configuracao['id'] }}">Travessão removível</a>
                <a href="javascript:void(0)" onclick="(new Produto).excluir('{{ $configuracao['id'] }}');">
                    <span class="excluir_subitem">Excluir item<i class="fa fa-trash text-navy"></i></span>
                </a>
            </h4>
        </div>
        <div id="collapse{{ $configuracao['id'] }}" class="panel-collapse collapse p-sm">
            <div class="panel-body">
                <div class="form-group col-lg-12 margin-b-0 padding-0">
                    <div class="form-group col-lg-3">
                        <label class="control-label">Quantidade total</label>
                        <select class="form-control m-b" name="account">
                            <option>Selecione</option>
                            <option>opção 1</option>
                            <option>opção 2</option>
                            <option>opção 3</option>
                            <option>opção 4</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim Subitem Portão de Garagem - Travessão removível -->