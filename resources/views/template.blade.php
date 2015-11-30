<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MARFRA | {{ $paginaTitulo }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    
    <!-- Select2 -->
    <link href="{{ asset('js/plugins/select2/css/select2.css') }}" rel="stylesheet">
    
    <!-- iCheck -->
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    
    <!-- Toastr style -->
    <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    
    <!-- Gritter -->
    <link href="{{ asset('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body class="skin-1">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <a href="index.html"><img alt="image" class="img-circle" width="170px" src="{{ asset('img/MARFRA-BRASIL.png') }}"/></a>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-md"> <strong class="font-bold">{{ $usuario->nome }}</strong>
                             </span> <span class="text-muted text-xs block">{{ $usuario->cargo }}<b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="perfil.html">Perfil</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('logout') }}">Sair</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <img src="img/logo_top.png" alt="logotipo" width="50">
                    </div>
                </li>
                
                @foreach($menus as $m)
                    @if(in_array($m->id, $permissao))
                    <li @if($menu == $m->url)class="active"@endif>
                        <a href="/marfra/public/{{ $m->url }}"><i class="fa {{ $m->icone }}"></i> <span class="nav-label">{{ $m->nome }}</span> </a>
                    </li>
                    @endif
                @endforeach
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
            <span>Retrair / Expandir menu</span>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Bem vindo ao SGi+ da MAFRA BRASIL</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-user fa-fw"></i> Novo cliente cadastrado
                                    <span class="pull-right text-muted small">4 minutos atrás</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                    </ul>
                </li>


                <li>
                    <a href="{{ route('logout') }}">
                        <i class="fa fa-sign-out"></i> Sair
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>{{ $paginaTitulo }}</h2>
                    <ol class="breadcrumb">
                        @foreach($paginaBreadcrumb as $breadcrumb)
                        <li>
                            @if ($breadcrumb['ultimo'])
                            <strong>{{ $breadcrumb['nome'] }}</strong>
                            @else
                            {{ $breadcrumb['nome'] }}
                            @endif
                        </li>
                        @endforeach
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                
                @if(Session::has('flash_message'))
                    <div class="alert @if(Session::has('flash_type')) alert-{{ Session::get('flash_type') }} @else alert-success @endif">
                        {{ Session::get('flash_message') }}
                    </div>
                    <div class="row">&nbsp;</div>
                @endif
                
                @yield('content')
                
                <div class="modal inmodal" id="modal-confirm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">Exclusão</h4>
                                <small class="font-bold"></small>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Não</button>
                                <a href="#" class="btn btn-primary btn-modal-confirm">Sim</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <div class="footer">
            <div class="text-center">
                <strong>Dúvidas?</strong> 2014-2015
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jeditable/jquery.jeditable.js') }}"></script>


    <!-- Flot -->
    <script src="{{ asset('js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.pie.js') }}"></script>
    
    <!-- Peity -->
    <script src="{{ asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/demo/peity-demo.js') }}"></script>

    <!-- Data Tables -->
    <script src="{{ asset('js/plugins/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>
    
    <!-- Select 2 -->
    <script src="{{ asset('js/plugins/select2/select2.full.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/i18n/pt-BR.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
    
    <!-- Input Mask-->
    <script src="{{ asset('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

    <!-- iCheck -->
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- GITTER -->
    <script src="{{ asset('js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ asset('js/demo/sparkline-demo.js') }}"></script>

    <!-- ChartJS-->
    <script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>
    
    <!-- Conjunto de funções de utilidades do sistema -->
    <script src="{{ asset('js/utilidades.js') }}"></script>
    
    <script>
        $(document).ready(function() {

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
//            setTimeout(function() {
//                toastr.options = {
//                    closeButton: true,
//                    progressBar: true,
//                    showMethod: 'slideDown',
//                    timeOut: 4000
//                };
//                toastr.success('Sistema Interno', 'Bem vindo a MAFRA BRASIL');
//
//            }, 1300);

        });
    </script>
    
    @yield('js')
    
</body>
</html>