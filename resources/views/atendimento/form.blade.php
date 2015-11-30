@extends('template')

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Atenção!</strong> Existem campos com observações. Por favor, acerte e envie novamente.
    </div>
    <div class="row">&nbsp;</div>
@endif

<form action="{{ route('atendimento/orcamento/novo') }}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<input type="hidden" name="id" value="@if (isset($orcamento)){{ $orcamento->id }}@endif" />
<input type="hidden" name="envio" id="envio" value="" />

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Dados gerais</h5>
            </div>
            <div class="ibox-content">
                @if (!empty($orcamento->id))
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-4">
                        <label class="control-label">Código</label>
                        <input type="text" name="codigo" id="codigo" class="form-control" value="#MF{{ $orcamento->label }}" disabled />
                    </div>
                </div>
                
                <div class="hr-line-dashed clear_both"></div>
                @endif
                
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-2 @if ($errors->has('cliente_tipo')) has-error @endif">
                        <label class="control-label">Escolha o tipo de cliente *</label>
                        <select name="cliente_tipo" id="cliente_tipo" class="form-control m-b">
                            <option value="">Tipo de cliente</option>
                            @foreach($tiposCliente as $tipo)
                                <option value="{{ $tipo->id }}" @if (old('cliente_tipo') == $tipo->id) selected @else @if(isset($cliente_tipo)) @if($cliente_tipo == $tipo->id) selected @endif @endif @endif >
                                    {{ $tipo->nome }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('cliente_tipo'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('cliente_tipo') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-4 @if ($errors->has('cliente')) has-error @endif">
                        <label class="control-label">Selecione o cliente *</label>
                        <select name="cliente" id="cliente" class="form-control m-b" tabindex="2" style="min-width: 350px">
                        </select>
                        @if ($errors->has('cliente'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('cliente') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            
                <div class="hr-line-dashed clear_both"></div>
    
                <div class="col-lg-12 padding-0 form-group">
                    <div class="form-group col-lg-2 @if ($errors->has('servico')) has-error @endif">
                        <label class="control-label">Escolha o tipo de serviço *</label>
                        <select name="servico" id="servico" class="form-control m-b" tabindex="3">
                            <option value="">Tipo de serviço</option>
                            @foreach($servicos as $servico)
                                <option value="{{ $servico->id }}" @if (old('servico') == $servico->id) selected @else @if($orcamento->servico == $servico->id) selected @endif @endif >
                                    {{ $servico->nome }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('servico'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('servico') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                    
                    <div class="form-group col-lg-4 @if ($errors->has('produto')) has-error @endif">
                        <label class="control-label">Selecione o produto *</label>
                        <div class="input-group">
                            <select name="produto[]" id="produto" class="form-control m-b" tabindex="4" style="min-width: 350px" multiple>
                                @foreach($produtos as $produto)
                                    <option value="{{ $produto->id }}" @if (old('produto') == $produto->id) selected @else @if(isset($orcamento_produto)) @foreach($orcamento_produto as $o) @if($o->produto == $produto->id) selected @endif @endforeach @endif @endif >
                                        {{ $produto->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('produto'))
                                <div class="alert alert-danger">
                                    @foreach ($errors->get('produto') as $error)
                                        {!! $error !!}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="hr-line-dashed clear_both"></div>
                
                <div class="form-group col-lg-12 padding-0"> 
                    <div class="form-group col-lg-3 @if ($errors->has('responsavel')) has-error @endif">
                        <label class="control-label">Responsável *</label>
                        <input type="text" name="responsavel" id="responsavel" class="form-control" value="{{ (old('responsavel')) ? old('responsavel') : $orcamento->responsavel }}" />
                        @if ($errors->has('responsavel'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('responsavel') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-3 @if ($errors->has('telefone')) has-error @endif">
                        <label class="control-label">Telefone *</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" data-mask="(99) 9999-9999" value="{{ (old('telefone')) ? old('telefone') : $orcamento->telefone }}" />
                        @if ($errors->has('responsavel'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('responsavel') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-12 padding-0 m-b-lg padding-0 m-l"> 
                    <label class="control-label">Caso o Responsável não esteja presente durante a visita, procurar:</label>
                </div>
                
                <div class="form-group col-lg-12 padding-0"> 
                    <div class="form-group col-lg-3 @if ($errors->has('responsavel_alternativo')) has-error @endif">
                        <label class="control-label">Nome *</label>
                        <input type="text" name="responsavel_alternativo" id="responsavel_alternativo" class="form-control" value="{{ (old('responsavel_alternativo')) ? old('responsavel_alternativo') : $orcamento->responsavel_alternativo }}" />
                        @if ($errors->has('responsavel_alternativo'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('responsavel_alternativo') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-3 @if ($errors->has('telefone_alternativo')) has-error @endif">
                        <label class="control-label">Telefone *</label>
                        <input type="text" name="telefone_alternativo" id="telefone_alternativo" class="form-control" data-mask="(99) 9999-9999" value="{{ (old('telefone_alternativo')) ? old('telefone_alternativo') : $orcamento->telefone_alternativo }}" />
                        @if ($errors->has('telefone_alternativo'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('telefone_alternativo') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-6">
                        <label class="control-label">Informações adicionais</label>
                        <textarea name="observacoes" id="observacoes" class="form-control">{{ (old('observacoes')) ? old('observacoes') : $orcamento->observacoes }}</textarea>
                    </div>
                </div>
                
                <div class="hr-line-dashed clear_both"></div>
                
                <div class="form-group col-lg-12 padding-0" id="data_1">
                    <div class="form-group col-lg-3 @if ($errors->has('data_visita')) has-error @endif">
                        <label class="control-label">Data da visita orçamentária *</label>
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="data_visita" id="data_visita" class="form-control" placeholder="dd/mm/yyyy" data-mask="99/99/9999" value="{{ (old('data_visita')) ? old('data_visita') : $orcamento->data_visita }}" />
                        </div>
                        @if ($errors->has('data_visita'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('data_visita') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                       <span class="info">Informe ao cliente a data limite da visita.</span>
                    </div>
                </div>
                
                <div class="hr-line-dashed clear_both"></div>
                
                <div class="form-group">
                    <div class="col-sm-12">
                        <a href="{{ route('atendimento/orcamentos') }}" class="btn btn-white btn_cancel"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</a>
                        <button class="btn btn-primary btn_yell col-lg-offset-5 col-md-offset-2 btn-salvar" type="submit" value="salvarEFechar"><i class="fa fa-warning"></i>&nbsp;&nbsp;Salvar e fechar</button>
                        <button class="btn btn-primary btn-salvar" type="submit" value="salvar"><i class="fa fa-check"></i>&nbsp;&nbsp;Salvar</button>
                    </div>
                </div>
                
                <div class="hr-line-dashed clear_both visibility_none"></div>
            </div>
        </div>
    </div>
</div>

</form>
@endsection

@section('js')
<script src="{{ asset('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript">

var setarEnvio = function(valor)
{
    $('#envio').val(valor);
};

$(document).ready(function(){
    
    // instanciando a classe js de utilidades
    var util = new Utilidade;
    
    // aplicando o ajax no tipo de cliente
    $('#cliente_tipo').change(function(){
        util.getClientes(this.value, 'cliente', '');
    });
    
    // aplicando o select2 nos campos
    $('#cliente').select2({placeholder: 'Selecione', language: 'pt-BR'});
    $('#produto').select2({placeholder: 'Selecione', language: 'pt-BR'});
    
    // setando o método do botão de envio
    $('.btn-salvar').click(function() {
        setarEnvio($(this).val());
    });
    
    // previnindo F5
    util.getClientes($('#cliente_tipo').val(), 'cliente', '{{ $orcamento->cliente }}');
});
</script>
@endsection