<!-- INICIO PAINEL CORRIMÃO -->
<div class="ibox-content" id="{{ $configuracao['id'] }}">
    
    <!-- Inicio dos campos de configuração -->
    <input type="hidden" name="produto_token[]" id="produto_token_{{ $configuracao['id'] }}" value="{{ $configuracao['id'] }}" />
    <input type="hidden" name="produto[{{ $configuracao['id'] }}][id]" id="produto_{{ $configuracao['id'] }}_id" value="{{ (isset($produto_id)) ? $produto_id : '' }}" />
    <input type="hidden" name="produto[{{ $configuracao['id'] }}][orcamento_produto]" id="produto_{{ $configuracao['id'] }}_orcamento_produto" value="{{ (isset($orcamento_produto)) ? $orcamento_produto : '' }}" />
    <!-- Fim dos campos de configuração -->
    
    <div class="panel-group" id="accordion{{ $configuracao['id'] }}">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="collapsed" data-id="{{ $configuracao['id'] }}" data-toggle="collapse" data-parent="#accordion{{ $configuracao['id'] }}" href="#collapse{{ $configuracao['id'] }}" onclick="(new Utilidade).toggleButton(this);">
                        Corrimão&nbsp;&nbsp;<i class="fa fa-chevron-down" data-id="{{ $configuracao['id'] }}"></i><i class="fa fa-chevron-up" data-id="{{ $configuracao['id'] }}" style="display: none;"></i>
                    </a>
                    <a href="javascript:void(0)" onclick="(new Produto).excluir('{{ $configuracao['id'] }}');">
                        <span class="excluir_subitem excluir_produto">Excluir produto <i class="fa fa-trash text-navy"></i></span>
                    </a>
                </h4>
            </div>
            <div id="collapse{{ $configuracao['id'] }}" class="panel-collapse collapse">
                <div class="panel-body">
                    <!-- Inicio Opções Corrimão -->
                    <div class="form-group info-padrao-produto col-lg-12 padding-0 m-t-md m-b-none">
                        <div class="form-group col-lg-2">
                            <label class="control-label">Modelo</label>
                            <select name="produto[{{ $configuracao['id'] }}][modelo]" id="produto_{{ $configuracao['id'] }}_modelo" class="form-control m-b">
                                <option value="">Selecione</option>
                                @foreach($modelos as $modelo)
                                    <option value="{{ $modelo->id }}">{{ $modelo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-2">
                            <label class="control-label">Cor</label>
                            <select name="produto[{{ $configuracao['id'] }}][cor]" id="produto_{{ $configuracao['id'] }}_cor" class="form-control m-b">
                                <option value="">Selecione</option>
                                @foreach($cores as $cor)
                                    <option value="{{ $cor->id }}">{{ $cor->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-2">
                            <label class="control-label">Comprimento</label>
                            <input type="text" name="produto[{{ $configuracao['id'] }}][comprimento]" id="produto_{{ $configuracao['id'] }}_comprimento" class="form-control" placeholder="Qtd." />
                        </div>
                        <div class="form-group col-lg-2">
                            <label class="control-label">Altura</label>
                            <input type="text" name="produto[{{ $configuracao['id'] }}][altura]" id="produto_{{ $configuracao['id'] }}_altura" class="form-control">
                        </div>
                        <div class="form-group col-lg-3">
                            <label class="control-label">Sistema de instalação</label>
                            <div class="clear_both"></div>
                            <div class="checkbox i-checks col-sm-6">
                                <label class="primeiro_produto">
                                    <input type="checkbox" value="" /><i></i> Chão
                                </label>
                            </div>
                            <div class="checkbox i-checks col-sm-6">
                                <label>
                                    <input type="checkbox" value="" /><i></i> Parede
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Fim Opções Corrimão -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- INICIO PAINEL CORRIMÃO -->