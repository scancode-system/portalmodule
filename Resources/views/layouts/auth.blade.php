<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Scancode - Portal cliente</title>
    <!-- Icons-->
    {{ Html::style('modules/portal/coreui/node_modules/@coreui/icons/css/coreui-icons.min.css') }} 
    {{ Html::style('modules/portal/coreui/node_modules/flag-icon-css/css/flag-icon.min.css') }} 
    {{ Html::style('modules/portal/coreui/node_modules/font-awesome/css/font-awesome.min.css') }} 
    {{ Html::style('modules/portal/coreui/node_modules/simple-line-icons/css/simple-line-icons.css') }} 
    <!-- Main styles for this application-->
    {{ Html::style('modules/portal/coreui/css/style.css') }} 
    {{ Html::style('modules/portal/coreui/vendors/pace-progress/css/pace.min.css') }}
</head>
<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">

            <!-- -->

            @yield('content')
            
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    {{ Html::script('modules/portal/coreui/node_modules/jquery/dist/jquery.min.js') }}
    {{ Html::script('modules/portal/coreui/node_modules/popper.js/dist/umd/popper.min.js') }}
    {{ Html::script('modules/portal/coreui/node_modules/bootstrap/dist/js/bootstrap.min.js') }}
    {{ Html::script('modules/portal/coreui/node_modules/pace-progress/pace.min.js') }}
    {{ Html::script('modules/portal/coreui/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}
    {{ Html::script('modules/portal/coreui/node_modules/@coreui/coreui/dist/js/coreui.min.js') }}
</body>
</html>
