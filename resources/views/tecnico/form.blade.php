@extends('template')

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Atenção!</strong> Existem campos com observações. Por favor, acerte e envie novamente.
    </div>
    <div class="row">&nbsp;</div>
@endif

<form action="{{ route('tecnico/orcamento/update') }}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<input type="hidden" name="id" value="@if (isset($orcamento)){{ $orcamento->id }}@endif" />
<input type="hidden" name="envio" id="envio" value="" />

<div class="row">
    
    @include('blocos/gerais')
        
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Lista de produtos</h5>
            </div>
            <div class="ibox-content">
                
                @include('tecnico/confirmacao')
                
                @if($orcamento->confirmado)
                    @include('tecnico/produtos')
                    @include('tecnico/adicionais')
                @endif
   
                <div class="hr-line-dashed clear_both visibility_none"></div>
            </div>
        </div>
    </div>
</div>

</form>
@endsection

@section('js')
<script src="{{ asset('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('js/tecnico.form.js') }}"></script>
<script type="text/javascript">

var setarEnvio = function(valor)
{
    $('#envio').val(valor);
};

$(document).ready(function(){
    
    // por padrao, esconde os campos adicionais relacionados a pergunte de pedra
    $('.pedra-adicional').hide();
    
    var produto = new Produto;
    
    $('.btn-addProduto').click(function(){
        produto.adicionar($('#bloco_produto').val());
    });
    
    // instanciando a classe js de utilidades
    //var util = new Utilidade;
    
    // aplicando o ajax no tipo de cliente
    //$('#cliente_tipo').change(function(){
    //    util.getClientes(this.value, 'cliente', '');
    //});
    
    // aplicando o select2 nos campos
    //$('#cliente').select2({placeholder: 'Selecione', language: 'pt-BR'});
    //$('#produto').select2({placeholder: 'Selecione', language: 'pt-BR'});
    
    // aplicando a função para exibição dos campos adicionais da pedra
    $('#possui_pedra').on('ifChecked', function(){
        $('.pedra-adicional').show();
    }).on('ifUnchecked', function(){
        $('.pedra-adicional').hide();
    });
    
    // setando o método do botão de envio
    $('.btn-salvar').click(function() {
        setarEnvio($(this).val());
    });
    
    // previnindo F5
    (($('#possui_pedra').is(':checked')) ? $('.pedra-adicional').show() : $('.pedra-adicional').hide());
    
    // previnindo F5
    //util.getClientes($('#cliente_tipo').val(), 'cliente', '{{ $orcamento->cliente }}');
});
</script>
@endsection