@extends('app')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name"></h1>
        </div>
        
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Atenção!</strong> Seguem abaixo os erros encontrados.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <h3>Bem Vindo a Marfra Brasil</h3>
        <p>AINDA NÃO POSSUI ACESSO?</p>
        <p><span class="font-bold">21 3559-6800</span> ou pelo fale conosco.</p>
        
        <form class="m-t" role="form" method="post" action="{{ route('login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-group">
                {!! Form::text('login', null, ['class' => 'form-control', 'placeholder' => 'Nome do usuário', 'required' => '']) !!}
            </div>
            <div class="form-group">
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Senha', 'required' => '']) !!} 
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Acesse</button>
        </form>
        
        <p class="m-t"> <small>SGi+ de administração MARFRA BRASIL</small> </p>
    </div>
</div>
@endsection
