<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') | The Banyan Project</title>

    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/morris.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/jqvmap.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/components.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/layout.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/default.min.css')}}" rel="stylesheet" type="text/css"  />
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
    <script src="{{ asset('js/moment-with-locales.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'D/MM/YYYY'
            });
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker2').datetimepicker({
                format: 'MM/YYYY'
            });
        });
    </script>
    

</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">

	    @yield('body')
   
        
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
        
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('js/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/daterangepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.waypoints.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.counterup.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/amcharts.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/serial.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/pie.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/radar.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/light.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/patterns.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/chalk.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/ammap.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/worldLow.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/amstock.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/fullcalendar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/horizontal-timeline.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.flot.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.vmap.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.vmap.russia.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.vmap.world.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.vmap.europe.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.vmap.germany.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.vmap.usa.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('js/datatable.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{asset('js/app.min.js')}}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <script src="{{asset('js/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('js/dashboard.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{asset('js/layout.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/demo.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/quick-sidebar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/quick-nav.min.js')}}" type="text/javascript"></script>
     <script>
        $('#flash-overlay-modal').modal();
    </script>
</body>
</html>