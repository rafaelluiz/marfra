<!-- Inicio Subitem Portão de Garagem - Porta de pedestre embutida -->
<div class="panel-group" id="{{ $configuracao['id'] }}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#{{ $configuracao['id'] }}" href="#collapse{{ $configuracao['id'] }}">Porta de pedestre embutida</a>
                <a href="javascript:void(0)" onclick="(new Produto).excluir('{{ $configuracao['id'] }}');">
                    <span class="excluir_subitem">Excluir item<i class="fa fa-trash text-navy"></i></span>
                </a>
            </h4>
        </div>
        <div id="collapse{{ $configuracao['id'] }}" class="panel-collapse collapse p-sm p-top-30">
            <div class="panel-body">
                <div class="col-lg-12">
                   <div class="form-group col-lg-3 padding-0">
                        <label class="control-label">Processo</label>
                        <div class="clear_both"></div>
                        <div class="checkbox i-checks col-sm-6">
                            <label class="primeiro_produto">
                                <div class="icheckbox_square-blueMarfra checked"><input type="checkbox" value="" checked=""></div><i></i> Mecanizado
                            </label>
                        </div>
                        <div class="checkbox i-checks col-sm-6">
                            <label>
                                <div class="icheckbox_square-blueMarfra"><input type="checkbox" value=""></div><i></i> Automatizado
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim Subitem Portão de Garagem - Porta de pedestre embutida -->