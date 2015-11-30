<div class="col-lg-12 padding-0 m-b-xs">
    <label class="control-label">Selecione a lista de produtos</label>
</div>
<div class="col-lg-12 padding-0 m-b lista_produtos @if ($errors->has('produto')) has-error @endif">
    <div class="checkbox i-checks col-sm-1">
        <label class="primeiro_produto">
            <input type="checkbox" name="produto[]" id="produto_1" value="1" @if($orcamento->confirmado) disabled @endif @foreach($orcamento_produtos as $produto) @if($produto->produto == 1) checked @endif @endforeach /><i></i> Grade
        </label>
    </div>
    <div class="checkbox i-checks col-sm-2">
        <label>
            <input type="checkbox" name="produto[]" id="produto_2" value="2" class="js-switch" @if($orcamento->confirmado) disabled @endif @foreach($orcamento_produtos as $produto) @if($produto->produto == 2) checked @endif @endforeach /><i></i> Fechamento de vão
        </label>
    </div>
    <div class="checkbox i-checks col-sm-2" class="js-switch2">
        <label>
            <input type="checkbox" name="produto[]" id="produto_3" value="3" @if($orcamento->confirmado) disabled @endif @foreach($orcamento_produtos as $produto) @if($produto->produto == 3) checked @endif @endforeach /><i></i> Portão de garagem
        </label>
    </div>
    <div class="checkbox i-checks col-sm-2">
        <label>
            <input type="checkbox" name="produto[]" id="produto_4" value="4" @if($orcamento->confirmado) disabled @endif class="js-switch3" @foreach($orcamento_produtos as $produto) @if($produto->produto == 4) checked @endif @endforeach /><i></i> Porta de pedestre
        </label>
    </div>
    <div class="checkbox i-checks col-sm-2">
        <label>
            <input type="checkbox" name="produto[]" id="produto_5" value="5" @if($orcamento->confirmado) disabled @endif @foreach($orcamento_produtos as $produto) @if($produto->produto == 5) checked @endif @endforeach /><i></i> Guarda corpo
        </label>
    </div>
    <div class="checkbox i-checks col-sm-1">
        <label>
            <input type="checkbox" name="produto[]" id="produto_6" value="6" @if($orcamento->confirmado) disabled @endif @foreach($orcamento_produtos as $produto) @if($produto->produto == 6) checked @endif @endforeach /><i></i> Corrimão
        </label>
    </div>
    <div class="col-sm-2">
        <button class="btn btn-primary btn-salvar" type="submit" value="confirmar" @if($orcamento->confirmado) disabled @endif><i class="fa fa-check"></i>&nbsp;&nbsp;Confirmar lista de produtos</button>
    </div>
</div>

@if ($errors->has('produto'))
<div class="clear alert alert-danger">
    @foreach ($errors->get('produto') as $error)
        {!! $error !!}
    @endforeach
</div>
@endif