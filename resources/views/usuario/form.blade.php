@extends('template')

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Atenção!</strong> Existem campos com observações. Por favor, acerte e envie novamente.
    </div>
    <div class="row">&nbsp;</div>
@endif

<form action="{{ route('usuario.novo') }}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<input type="hidden" name="id" value="@if (isset($registro->id)){{ $registro->id }}@endif" />
<input type="hidden" name="envio" id="envio" value="" />

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Dados Gerais</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-4 @if ($errors->has('nome')) has-error @endif">
                        <label class="control-label">Nome *</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="{{ (old('nome')) ? old('nome') : $registro->nome }}" />
                        @if ($errors->has('nome'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('nome') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-lg-12 padding-0">
                    <div class="form-group col-lg-4 @if ($errors->has('grupo')) has-error @endif"">
                        <label class="control-label">Departamento *</label>
                        <select name="grupo[]" id="grupo" class="form-control" multiple>
                            @foreach($grupos as $grupo)
                                <option value="{{ $grupo->id }}" @if (old('grupo')) @foreach(old('grupo') as $old) @if ($old == $grupo->id) selected @endif @endforeach @else @if($registro->grupos) @foreach($registro->grupos as $o) @if($o->id == $grupo->id) selected @endif @endforeach @endif @endif>
                                    {{ $grupo->nome }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('grupo'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('grupo') as $error)
                                    {!! $error !!}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-4 @if ($errors->has('cargo')) has-error @endif">
                        <label class="control-label">Cargo *</label>
                        <input type="text" name="cargo" id="cargo" class="form-control" value="{{ (old('cargo')) ? old('cargo') : $registro->cargo }}" />
                        @if ($errors->has('cargo'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('cargo') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-lg-12 padding-0 @if ($errors->has('login')) has-error @endif">
                    <div class="form-group col-lg-2">
                        <label class="control-label">Login *</label>
                        <input type="text" name="login" id="login" class="form-control" value="{{ (old('login')) ? old('login') : $registro->login }}" />
                        @if ($errors->has('login'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('login') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-2 @if ($errors->has('password')) has-error @endif">
                        <label class="control-label">Senha {{ ($registro->id) ? '' : '*' }}</label>
                        <input type="password" name="password" id="password" class="form-control" />
                        @if ($errors->has('password'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('password') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-2 @if ($errors->has('password2')) has-error @endif">
                        <label class="control-label">Confirme a senha {{ ($registro->id) ? '' : '*' }}</label>
                        <input type="password" name="password2" id="password2" class="form-control" />
                        @if ($errors->has('password2'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('password2') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-2 @if ($errors->has('ativo')) has-error @endif">
                        <label class="control-label">Status *</label>
                        <select name="ativo" id="ativo" class="form-control">
                            <option value="1" @if (old('ativo') === "1") selected @else @if($registro) @if($registro->ativo === 1) selected @endif @endif @endif>Ativo</option>
                            <option value="0" @if (old('ativo') === "0") selected @else @if($registro) @if($registro->ativo === 0) selected @endif @endif @endif>Inativo</option>
                        </select>
                        @if ($errors->has('ativo'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('ativo') as $error)
                                {!! $error !!}
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed clear_both"></div>
                <div class="hr-line-dashed clear_both visibility_none"></div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <a href="{{ route('usuarios') }}" class="btn btn-white btn_cancel"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</a>
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
    
    // aplicando o select 2 no grupo
    $('#grupo').select2({language: 'pt-BR'});
    
    // setando o método do botão de envio
    $('.btn-salvar').click(function() {
        setarEnvio($(this).val());
    });
});
</script>
@endsection