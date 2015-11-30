<!-- Inicio Subitem Fechamento de Vão - Porta de pedestre -->
<div class="panel-group" id="{{ $configuracao['id'] }}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#{{ $configuracao['id'] }}" href="#collapse{{ $configuracao['id'] }}">Porta de pedestre</a>
                <a href="javascript:void(0)" onclick="(new Produto).excluir('{{ $configuracao['id'] }}');">
                    <span class="excluir_subitem">Excluir item<i class="fa fa-trash text-navy"></i></span>
                </a>
            </h4>
        </div>
        <div id="collapse{{ $configuracao['id'] }}" class="panel-collapse collapse p-sm p-top-30">
            <div class="panel-body">
                <div class="form-group col-lg-12 margin-b-0 padding-0">
                    <div class="form-group col-lg-3">
                        <label class="control-label">Sistema de abertura</label>
                        <select class="form-control m-b" name="account">
                            <option>opção 1</option>
                            <option>opção 2</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                        <label class="control-label">Quantidade total</label>
                        <select class="form-control m-b" name="account">
                            <option>Selecione</option>
                            <option>opção 1</option>
                            <option>opção 2</option>
                            <option>opção 3</option>
                            <option>opção 4</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label class="control-label">Processo</label>
                        <div class="clear_both"></div>
                        <div class="checkbox i-checks col-sm-4">
                            <label class="primeiro_produto">
                              <input type="checkbox" value="" checked=""><i></i> Mecanizado
                            </label>
                        </div>
                        <div class="checkbox i-checks col-sm-6">
                            <label>
                                <input type="checkbox" value=""><i></i> Automatizado
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim Subitem Fechamento de Vão - Porta de pedestre -->