<!-- INICIO PAINEL PORTA DE PEDESTRE -->
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
                        Porta de pedestre&nbsp;&nbsp;<i class="fa fa-chevron-down" data-id="{{ $configuracao['id'] }}"></i><i class="fa fa-chevron-up" data-id="{{ $configuracao['id'] }}" style="display: none;"></i>
                    </a>
                    <a href="javascript:void(0)" onclick="(new Produto).excluir('{{ $configuracao['id'] }}');">
                        <span class="excluir_subitem excluir_produto">Excluir produto <i class="fa fa-trash text-navy"></i></span>
                    </a>
                </h4>
            </div>
            <div id="collapse{{ $configuracao['id'] }}" class="panel-collapse collapse">
                <div class="panel-body">
                    <!-- Inicio Opções Porta de Pedestre -->
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
                            <label class="control-label">Largura</label>
                            <input type="text" name="produto[{{ $configuracao['id'] }}][comprimento]" id="produto_{{ $configuracao['id'] }}_comprimento" class="form-control" />
                        </div>
                        <div class="form-group col-lg-2">
                            <label class="control-label">Altura</label>
                            <input type="text" name="produto[{{ $configuracao['id'] }}][altura]" id="produto_{{ $configuracao['id'] }}_altura" class="form-control" />
                        </div>
                        <div class="form-group col-lg-2">
                            <label class="control-label">Sistema de abertura</label>
                            <select class="form-control m-b" name="account">
                                <option>opção 1</option>
                                <option>opção 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group col-lg-3">
                            <label class="control-label">Processo</label>
                            <div class="clear_both"></div>
                            <div class="checkbox i-checks col-sm-6">
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
                        <div class="form-group col-lg-3">
                            <label class="control-label">Se Deslizante</label>
                            <div class="clear_both"></div>
                            <div class="checkbox i-checks col-sm-6">
                                <label class="primeiro_produto">
                                    <input type="checkbox" value="" checked=""><i></i> Comum
                                </label>
                            </div>
                            <div class="checkbox i-checks col-sm-6">
                                <label>
                                    <input type="checkbox" value=""><i></i> Industrial
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Fim Opções Porta de Pedestre -->
                    
                    @if($opicionais)
                    <!-- Inicia bloco de opicionais / itens -->
                    <div class="col-lg-12 padding-0">
                        <div class="col-lg-2">
                            <button type="button" id="btn-subproduto-{{ $configuracao['id'] }}" class="add_subitem btn btn-w-m btn-default" onclick="(new Produto).adicionaOpicional($('#bloco_produto_{{ $configuracao['id'] }}').val(), '{{ $configuracao['id'] }}');"><i class="fa fa-plus"></i>&nbsp;&nbsp;Adicionar item</button>
                        </div>

                        <div class="col-lg-2 padding-0 info-padrao-produto" id="info-produto-{{ $configuracao['id'] }}">
                            <select name="bloco_produto_{{ $configuracao['id'] }}" id="bloco_produto_{{ $configuracao['id'] }}" class="form-control m-b">
                                <option value="">Selecione</option>
                                @foreach($opicionais as $opicional)
                                    <option value="{{ $opicional->id }}">{{ $opicional->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-lg-2 alert alert-danger alert-produto" id="alert-subproduto-{{ $configuracao['id'] }}" style="display: none;">
                            Esse campo é <a class="alert-link" href="#">obrigatório.</a>
                        </div>
                    </div>
                    <!-- Fim bloco de opicionais / itens -->
                    @endif
                    
                    <!-- Inicio Bloco Subitens Porta de Pedestre -->
                    <div class="col-lg-12">
                        <div class="ibox-content" id="bloco-subproduto-{{ $configuracao['id'] }}">
                            
                        </div>
                    </div>
                    <!-- Fim Bloco Subitens Porta de Pedestre -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIM PAINEL PORTA DE PEDESTRE -->