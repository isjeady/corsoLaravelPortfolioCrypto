<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ URL::asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ URL::asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ URL::asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
        <!-- Morris chart -->
        <link rel="stylesheet" href="{{ URL::asset('adminlte/bower_components/morris.js/morris.css') }}">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{{ URL::asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{ URL::asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ URL::asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">


    </head>
<body class="hold-transition skin-blue sidebar-mini skin-black-light">

    <div class="wrapper">
            @include('fragments.header')

            @include('fragments.sidebar')

            @yield('content')

            @include('fragments.footer')
    </div>

        <!-- jQuery 3 -->
        <script src="{{ URL::asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ URL::asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ URL::asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        <script src="{{ URL::asset('js/chart.bundle.js') }}"></script>
        -->
        <!-- Sparkline -->
        <script src="{{ URL::asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
        <!-- jvectormap -->
        <script src="{{ URL::asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ URL::asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <!-- jQuery Knob Chart 
        <script src="{{ URL::asset('adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
        -->
        <script src="{{ URL::asset('adminlte/bower_components/chart.bundle.js') }}"></script>
        <!-- daterangepicker -->
        <script src="{{ URL::asset('adminlte/bower_components/moment/min/moment.min.js') }}"></script>
        <script src="{{ URL::asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <!-- datepicker -->
        <script src="{{ URL::asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ URL::asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
        <!-- Slimscroll -->
        <script src="{{ URL::asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ URL::asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ URL::asset('adminlte/dist/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes)
        <script src="{{ URL::asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
        -->

        @yield('script_page')
</body>

</html>
