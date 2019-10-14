<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Scancode - Portal cliente">
    <meta name="author" content="Leonardo B. A. Vasconcelos">
    <meta name="keyword" content="Scancode">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scancode - Portal cliente</title>
    <!-- Icons-->
    {{ Html::style('modules/portal/coreui/node_modules/@coreui/icons/css/coreui-icons.min.css') }} 
    {{ Html::style('modules/portal/coreui/node_modules/flag-icon-css/css/flag-icon.min.css') }} 
    {{ Html::style('modules/portal/coreui/node_modules/font-awesome/css/font-awesome.min.css') }} 
    {{ Html::style('modules/portal/coreui/node_modules/simple-line-icons/css/simple-line-icons.css') }} 
    <!-- Main styles for this application-->
    {{ Html::style('modules/portal/coreui/css/style.css') }} 
    {{ Html::style('modules/portal/coreui/vendors/pace-progress/css/pace.min.css') }}

    @stack('styles')

    {{ Html::script('modules/portal/coreui/node_modules/jquery/dist/jquery.min.js') }}
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('portal::layouts.subviews.header')
    <div class="app-body">
        @include('portal::layouts.subviews.sidebar')
        <main class="main">
            <!-- Breadcrumb-->
            <ol class="breadcrumb">
                @yield('breadcrumb')
                <li class="breadcrumb-menu d-md-down-none">
                    


                    @include('portal::layouts.subviews.events')
                    <li class="nav-item dropdown d-md-down-none">
                        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-list"></i>
                            <span class="badge badge-pill badge-danger" style="    position: absolute;
                            top: 50%;
                            left: 50%;
                            margin-top: -16px;
                            margin-left: 0;">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                            <div class="dropdown-header text-center">
                                <strong>2 Tarefas Pendentes</strong>
                            </div>
                            <a class="dropdown-item" href="#">
                                <div class="small mb-1">Importação Cliente
                                    <span class="float-right">
                                        <strong>100%</strong>
                                    </span>
                                </div>
                                <span class="progress progress-xs">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </span>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="small mb-1">Importação Pagamento
                                    <span class="float-right">
                                        <strong>0%</strong>
                                    </span>
                                </div>
                                <span class="progress progress-xs">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </span>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="small mb-1">Importação Produtos
                                    <span class="float-right">
                                        <strong>50%</strong>
                                    </span>
                                </div>
                                <span class="progress progress-xs">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </span>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="small mb-1">Importação Representante
                                    <span class="float-right">
                                        <strong>100%</strong>
                                    </span>
                                </div>
                                <span class="progress progress-xs">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </span>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="small mb-1">Importação Transportadora
                                    <span class="float-right">
                                        <strong>0%</strong>
                                    </span>
                                </div>
                                <span class="progress progress-xs">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </span>
                            </a>
                            <a class="dropdown-item text-center" href="#">
                                <strong>Importações</strong>
                            </a>
                        </div>
                    </li>
                </li>
            </ol>
            <div class="container-fluid">
                <div class="animated fadeIn">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    @include('portal::layouts.subviews.footer')
    <!-- CoreUI and necessary plugins-->
    {{ Html::script('modules/portal/coreui/node_modules/popper.js/dist/umd/popper.min.js') }}
    {{ Html::script('modules/portal/coreui/node_modules/bootstrap/dist/js/bootstrap.min.js') }}
    {{ Html::script('modules/portal/coreui/node_modules/pace-progress/pace.min.js') }}
    {{ Html::script('modules/portal/coreui/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}
    {{ Html::script('modules/portal/coreui/node_modules/@coreui/coreui/dist/js/coreui.min.js') }}
    {{ Html::script('modules/portal/js/app.js') }}
    <script>
        var BASE_URL = '{{ url("/") }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
    </script>
    @stack('scripts')
</body>
</html>
