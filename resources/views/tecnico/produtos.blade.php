<div class="hr-line-dashed clear_both"></div>
<div class="col-lg-12 padding-0">
    <div class="col-lg-2 padding-0">
        <button type="button" class="add_subitem btn-addProduto btn btn-w-m"><i class="fa fa-plus"></i>&nbsp;&nbsp;Adicionar produto</button>
    </div>
    <div class="col-lg-2 padding-0 info-padrao-produto">
        <select name="bloco_produto" id="bloco_produto" class="form-control m-b">
            <option value="">Selecione</option>
            @foreach($produtos as $produto)
                @foreach ($orcamento_produtos as $op)
                    @if ($op->produto == $produto->id)
                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                    @endif
                @endforeach
            @endforeach
        </select>
    </div>
    <div class="col-lg-2 alert alert-danger alert-produto" style="display: none;">
        Esse campo é <a class="alert-link" href="#">obrigatório.</a>
    </div>
</div>

<div class="panel">
    <div class="panel-body">
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div id="bloco-produtos" class="ibox-content">
              
                </div>
            </div>
        </div>
    </div>
</div>