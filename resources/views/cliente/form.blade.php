@extends('template')

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Atenção!</strong> Existem campos com observações. Por favor, acerte e envie novamente.
    </div>
    <div class="row">&nbsp;</div>
@endif

<form action="{{ route('cliente/novo') }}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<input type="hidden" name="id" value="@if (isset($cliente)){{ $cliente->id }}@endif" />
<input type="hidden" name="envio" id="envio" value="" />

<div class="row m-b-lg">
    <div class="col-lg-2">
        <select name="cliente_tipo" id="cliente_tipo" class="form-control m-b">
            <option value="-1">Escolha o tipo de cliente</option>
            @foreach($tiposCliente as $tipo)
                <option value="{{ $tipo->id }}" @if (old('cliente_tipo') == $tipo->id) selected @else @if($cliente->tipo == $tipo->id) selected @endif @endif >
                    {{ $tipo->nome }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- INICIO DO BLOCO DE PESSOA FÍSICA -->
<div id="box-pessoa-fisica" class="row" style="display: none;">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Pessoa Física</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group col-lg-12 padding-0 margin-b-0">
                    <div class="form-group col-lg-4 m-t-md @if ($errors->has('nome_pf')) has-error @endif">
                        <label class="control-label">Nome Completo *</label>
                        <input type="text" name="nome_pf" id="nome_pf" class="form-control" value="{{ (old('nome_pf')) ? old('nome_pf') : $cliente->nome }}" />
                        @if ($errors->has('nome_pf'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('nome_pf') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-lg-12 margin-b-0 padding-0">
                    <div class="form-group col-lg-2">
                        <label class="control-label">Data de Nascimento</label>
                        <input type="text" name="data_nascimento" id="data_nascimento" class="form-control" data-mask="99/99/9999" value="{{ (old('data_nascimento')) ? old('data_nascimento') : $cliente->data_nascimento }}" />
                    </div>
                    <div class="form-group col-lg-3 @if ($errors->has('cpf_pf')) has-error @endif">
                        <label class="control-label">CPF</label>
                        <input type="text" name="cpf_pf" id="cpf_pf" class="form-control" data-mask="999.999.999-99" value="{{ (old('cpf_pf')) ? old('cpf_pf') : $cliente->cpf }}" />
                        @if ($errors->has('cpf_pf'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('cpf_pf') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-3">
                        <label class="control-label">RG</label>
                        <input type="text" name="rg" id="rg" class="form-control" value="{{ (old('rg')) ? old('rg') : $cliente->rg }}" />
                    </div>
                </div>
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-4">
                        <label class="control-label">E-mail *</label>
                        <input type="email" name="email_pf" id="email_pf" class="form-control" value="{{ (old('email_pf')) ? old('email_pf') : $cliente->email }}" />
                    </div>
                    <div class="form-group col-lg-2 @if ($errors->has('telefone_pf')) has-error @endif">
                        <label class="control-label">Telefone Fixo *</label>
                        <input type="text" name="telefone_pf" id="telefone_pf" class="form-control" data-mask="(99) 9999-9999" value="{{ (old('telefone_pf')) ? old('telefone_pf') : $cliente->telefone }}" />
                        @if ($errors->has('telefone_pf'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('telefone_pf') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-2">
                        <label class="control-label">Celular *</label>
                        <input type="text" name="celular_pf" id="celular_pf" class="form-control" data-mask="(99) 99999-9999" value="{{ (old('celular_pf')) ? old('celular_pf') : $cliente->celular }}" />
                    </div>
                </div>
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-4">
                        <label class="control-label">Confirme o E-mail *</label>
                        <input type="email" name="conf_email_pf" id="conf_email_pf" class="form-control" value="{{ (old('conf_email_pf')) ? old('conf_email_pf') : $cliente->email }}" />
                    </div>
                </div>
                
                <div class="hr-line-dashed clear_both"></div>
                
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-4">
                        <label class="control-label">Como conheceu a Marfra? *</label>
                        <select name="forma_conhecimento_pf" id="forma_conhecimento_pf" class="form-control">
                            <option value="">----</option>
                            @foreach($formasConhecimento as $forma)
                                <option value="{{ $forma->id }}" @if (old('forma_conhecimento_pf') == $forma->id) selected @else @if($cliente->forma_conhecimento == $forma->id) selected @endif @endif >
                                    {{ $forma->nome }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('forma_conhecimento_pf'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('forma_conhecimento_pf') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed clear_both visibility_none"></div>
            </div>
        </div>
    </div>
</div>
<!-- FIM DO BLOCO DE PESSOA FÍSICA -->

<!-- INICIO DO BLOCO DE PESSOA JURÍDICA -->
<div id="box-pessoa-juridica" class="row" style="display: none;">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Pessoa Jurídica (Condomínio, Empresa, Governo)</h5>
            </div>
            <div class="ibox-content">
                <!-- INICIO BLOCO DADOS INFORMAÇÃO -->
                <div class="form-group col-lg-12 m-t-md padding-0">
                    <div class="form-group col-lg-5 @if ($errors->has('nome_pj')) has-error @endif">
                        <label class="control-label">Razão Social *</label>
                        <input type="text" name="nome_pj" id="nome_pj" class="form-control" value="{{ (old('nome_pj')) ? old('nome_pj') : $cliente->nome }}" />
                        @if ($errors->has('nome_pj'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('nome_pj') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-3 @if ($errors->has('cnpj')) has-error @endif">
                        <label class="control-label">CNPJ</label>
                        <input type="text" name="cnpj" id="cnpj" class="form-control" data-mask="99.999.999/9999-99" value="{{ (old('cnpj')) ? old('cnpj') : $cliente->cnpj }}" />
                        @if ($errors->has('cnpj'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('cnpj') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-lg-12 col-md-6 col-sm-12 padding-0 m-b-lg"> 
                    <div class="col-lg-12">
                        <label class="col-sm-12 padding-0 m-b-sm">Isento de Inscrição Estadual?</label>
                        <label class="checkbox-inline i-checks col-sm-12">
                            <input type="checkbox" name="isento_inscricao" id="isento_inscricao" value="1" @if (old('isento_inscricao')) checked @else @if ($cliente->isento_inscricao_estadual) checked @endif @endif /> Sim, é isento.
                        </label>
                    </div>
                </div>
                <div class="form-group col-lg-12 padding-0"> 
                    <div class="form-group col-lg-2 col-md-12 col-sm-12">
                        <label class="control-label">Inscrição Estadual</label>
                        <input type="text" name="inscricao_estadual" id="inscricao_estadual" class="form-control" value="{{ (old('inscricao_estadual')) ? old('inscricao_estadual') : $cliente->inscricao_estadual }}" />
                    </div>
                    <div class="form-group col-lg-2 col-md-12 col-sm-12">
                        <label class="control-label">Inscrição Municipal</label>
                        <input type="text" name="inscricao_municipal" id="inscricao_municipal" class="form-control" value="{{ (old('inscricao_municipal')) ? old('inscricao_municipal') : $cliente->inscricao_municipal }}" />
                    </div>
                </div>
                
                <div class="hr-line-dashed clear_both"></div>
                <div class="form-group col-lg-12 padding-0"> 
                    <div class="form-group col-lg-4">
                        <label class="control-label">E-mail</label>
                        <input type="email" name="email_pj" id="email_pj" class="form-control" value="{{ (old('email_pj')) ? old('email_pj') : $cliente->email }}" />
                    </div>
                </div>
                <div class="hr-line-dashed clear_both"></div>
                <!-- FIM BLOCO DADOS INFORMAÇÃO -->
                
                <!-- INICIO BLOCO DADOS RESPONSÁVEIS -->
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-3 @if ($errors->has('responsavel')) has-error @endif">
                        <label class="control-label">Responsável *</label>
                        <input type="text" name="responsavel" id="responsavel" class="form-control" value="{{ (old('responsavel')) ? old('responsavel') : $cliente->responsavel }}" />
                        @if ($errors->has('responsavel'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('responsavel') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-3">
                        <label class="control-label">Cargo *</label>
                        <input type="text" name="cargo" id="cargo" class="form-control" value="{{ (old('cargo')) ? old('cargo') : $cliente->cargo }}" />
                    </div>
                    <div class="form-group col-lg-2">
                        <label class="control-label">Telefone *</label>
                        <input type="text" name="cargo" id="cargo" class="form-control" value="{{ (old('cargo')) ? old('cargo') : $cliente->cargo }}" />
                    </div>
                </div>
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-3 @if ($errors->has('responsavel')) has-error @endif">
                        <label class="control-label">Responsável *</label>
                        <input type="text" name="responsavel" id="responsavel" class="form-control" value="{{ (old('responsavel')) ? old('responsavel') : $cliente->responsavel }}" />
                        @if ($errors->has('responsavel'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('responsavel') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-3">
                        <label class="control-label">Cargo *</label>
                        <input type="text" name="cargo" id="cargo" class="form-control" value="{{ (old('cargo')) ? old('cargo') : $cliente->cargo }}" />
                    </div>
                    <div class="form-group col-lg-2">
                        <label class="control-label">Telefone *</label>
                        <input type="text" name="cargo" id="cargo" class="form-control" value="{{ (old('cargo')) ? old('cargo') : $cliente->cargo }}" />
                    </div>
                </div>
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-3 @if ($errors->has('responsavel')) has-error @endif">
                        <label class="control-label">Responsável *</label>
                        <input type="text" name="responsavel" id="responsavel" class="form-control" value="{{ (old('responsavel')) ? old('responsavel') : $cliente->responsavel }}" />
                        @if ($errors->has('responsavel'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('responsavel') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-3">
                        <label class="control-label">Cargo *</label>
                        <input type="text" name="cargo" id="cargo" class="form-control" value="{{ (old('cargo')) ? old('cargo') : $cliente->cargo }}" />
                    </div>
                    <div class="form-group col-lg-2">
                        <label class="control-label">Telefone *</label>
                        <input type="text" name="cargo" id="cargo" class="form-control" value="{{ (old('cargo')) ? old('cargo') : $cliente->cargo }}" />
                    </div>
                </div>
                <div class="form-group col-lg-12 padding-0" style="display: none;">
                    <div class="form-group col-lg-2 @if ($errors->has('cpf_pj')) has-error @endif">
                        <label class="control-label">CPF</label>
                        <input type="text" name="cpf_pj" id="cpf_pj" class="form-control" data-mask="999.999.999-99" value="{{ (old('cpf_pj')) ? old('cpf_pj') : $cliente->cpf }}" />
                        @if ($errors->has('cpf_pj'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('cpf_pj') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-2 @if ($errors->has('telefone_pj')) has-error @endif">
                        <label class="control-label">Telefone Fixo *</label>
                        <input type="text" name="telefone_pj" id="telefone_pj" class="form-control" data-mask="(99) 9999-9999" value="{{ (old('telefone_pj')) ? old('telefone_pj') : $cliente->telefone }}" />
                        @if ($errors->has('telefone_pj'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('telefone_pj') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-2">
                        <label class="control-label">Celular</label>
                        <input type="text" name="celular_pj" id="celular_pj" class="form-control" data-mask="(99) 99999-9999" value="{{ (old('celular_pj')) ? old('celular_pj') : $cliente->celular }}" />
                    </div>
                </div>
                <!-- FIM BLOCO DADOS RESPONSÁVEIS -->
                
                <div class="hr-line-dashed clear_both"></div>
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-4">
                        <label class="control-label">Como conheceu a Marfra? *</label>
                        <select name="forma_conhecimento_pj" id="forma_conhecimento_pj" class="form-control">
                            <option value="">----</option>
                            @foreach($formasConhecimento as $forma)
                                <option value="{{ $forma->id }}" @if (old('forma_conhecimento_pj') == $forma->id) selected @else @if($cliente->forma_conhecimento == $forma->id) selected @endif @endif >{{ $forma->nome }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('forma_conhecimento_pj'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('forma_conhecimento_pj') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed clear_both visibility_none"></div>
            </div>
        </div>
    </div>
</div>
<!-- FIM DO BLOCO DE PESSOA JURÍDICA -->
                        
<!--segundo módulo-->
<div id="box-endereco" class="row" style="display: none;">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Endereço</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-2 @if ($errors->has('cep')) has-error @endif">
                        <label class="control-label">CEP *</label>
                        <input type="text" name="cep" id="cep" class="form-control" data-mask="99999-999" value="{{ (old('cep')) ? old('cep') : $cliente->cep }}" />
                        @if ($errors->has('cep'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('cep') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <!--endereco-->
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-5 @if ($errors->has('endereco')) has-error @endif">
                        <label class="control-label">Rua *</label>
                        <input type="text" name="endereco" id="endereco" class="form-control" value="{{ (old('endereco')) ? old('endereco') : $cliente->endereco }}" />
                        @if ($errors->has('endereco'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('endereco') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-2 @if ($errors->has('numero')) has-error @endif">
                        <label class="control-label">Nº *</label>
                        <input type="text" name="numero" id="numero" class="form-control" value="{{ (old('numero')) ? old('numero') : $cliente->numero }}" />
                        @if ($errors->has('numero'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('numero') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-2">
                        <label class="control-label">Complemento</label>
                        <input type="text" name="complemento" id="complemento" class="form-control" value="{{ (old('complemento')) ? old('complemento') : $cliente->complemento }}" />
                    </div>
                </div>
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-3 @if ($errors->has('bairro')) has-error @endif">
                        <label class="control-label">Bairro *</label>
                        <input type="text" name="bairro" id="bairro" class="form-control" value="{{ (old('bairro')) ? old('bairro') : $cliente->bairro }}" />
                        @if ($errors->has('bairro'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('bairro') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-3 @if ($errors->has('estado')) has-error @endif">
                        <label class="control-label">Estado *</label>
                        <select name="estado" id="estado" class="form-control m-b" style="width: 100%">
                            <option value="-1">Selecione um Estado</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado->id }}" data-sigla="{{ $estado->uf }}" @if (old('estado') == $estado->id) selected @else @if($cliente->estado == $estado->id) selected @endif @endif>
                                    {{ $estado->nome }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('estado'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('estado') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-3 @if ($errors->has('cidade')) has-error @endif">
                        <label class="control-label">Cidade *</label>
                        <select name="cidade" id="cidade" class="form-control m-b" style="width: 100%">
                            <option value="-1">----</option>
                        </select>
                        @if ($errors->has('cidade'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('cidade') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed clear_both"></div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <a href="{{ route('clientes') }}" class="btn btn-white btn_cancel"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</a>
                        <button class="btn btn-primary btn_yell col-lg-offset-5 col-md-offset-2 btn-salvar" type="submit" value="salvarEFechar"><i class="fa fa-warning"></i>&nbsp;&nbsp;Salvar e fechar</button>
                        <button class="btn btn-primary btn-salvar" type="submit" value="salvar"><i class="fa fa-check"></i>&nbsp;&nbsp;Salvar</button>
                        <button class="btn btn-primary btn_blue btn-salvar" type="submit" value="salvarAbrirPedido"><i class="fa fa-plus"></i>&nbsp;&nbsp;Salvar e abrir pedido</button>
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
var mudarCaixas = function(tipo)
{
    if (tipo === '4') {
        $('#box-pessoa-juridica').hide();
        $('#box-pessoa-fisica').show();
        $('#box-endereco').show();
    } else if (tipo === '-1') {
        $('#box-pessoa-fisica').hide();
        $('#box-pessoa-juridica').hide();
        $('#box-endereco').hide();
    } else {
        $('#box-pessoa-fisica').hide();
        $('#box-pessoa-juridica').show();
        $('#box-endereco').show();
    }
};

var verificarInscricaoEstadual = function(marcado)
{
    if (marcado === 1) {
        $('#inscricao_estadual').attr('disabled', true);
    } else {
        $('#inscricao_estadual').removeAttr('disabled');
    }
};

var setarEnvio = function(valor)
{
    $('#envio').val(valor);
};

$(document).ready(function(){
    
    // instanciando a classe js de utilidades
    var util = new Utilidade;
    
    // aplicando a função para exibição dos blocos de acordo com o tipo
    $('#cliente_tipo').change(function(){
        mudarCaixas($(this).val());
    });
    
    // aplicando a função para bloqueio do campo inscrição estadual
    $('#isento_inscricao').on('ifChecked', function(){
        verificarInscricaoEstadual(1);
    }).on('ifUnchecked', function(){
        verificarInscricaoEstadual(0);
    });
    
    // aplicando a função ajax para buscar o endereço pelo CEP
    $('#cep').keyup(function(){
        util.pesquisaCEP(this.value, 'endereco', 'bairro', 'estado');
    });
    
    // aplicando a função ajax para buscar as cidades do estado
    $('#estado').change(function(){
        util.getCidades(this.value, 'cidade');
    });
    
    // aplicando o select 2 nos estados e cidades
    $('#estado').select2({language: 'pt-BR'});
    $('#cidade').select2({language: 'pt-BR'});
    
    // setando o método do botão de envio
    $('.btn-salvar').click(function() {
        setarEnvio($(this).val());
    });
    
    // previnindo F5
    mudarCaixas($('#cliente_tipo').val());
    
    // previnindo F5
    util.getCidades($('#estado').val(), 'cidade', '{{ old('cidade') ? old('cidade') : $cliente->cidade }}');
    
    // previnindo F5
    verificarInscricaoEstadual(($('#isento_inscricao').is(':checked')) ? 1 : 0);
});
</script>
@endsection