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
                    <div class="btn-group mr-3" role="group" aria-label="Button group">
                        {{ Form::Open(['route' => ['events.parameterless.update'], 'method' => 'put']) }}
                        {{ Form::hidden('selected', 1) }}
                        {{ Form::select('id_event', $events, $id_event, ['class' => 'form-control form-control-sm', 'id' => 'select_event_change']) }}
                        {{ Form::Close() }}
                    </div>
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
    {{ Html::script('modules/portal/coreui/node_modules/jquery/dist/jquery.min.js') }}
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
