<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Brickker | Control Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('/adminlte/plugins/iCheck/all.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('/adminlte/bower_components/select2/dist/css/select2.min.css')}}">
  <!-- image-picker-master -->
  <link rel="stylesheet" href="{{asset('/image-picker-master/image-picker/image-picker.css')}}">
  <!-- bootstrap slider -->
  <link rel="stylesheet" href="{{asset('/adminlte/plugins/bootstrap-slider/slider.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{asset('/adminlte/dist/css/skins/skin-black.min.css')}}">
  <link rel="stylesheet" href="{{asset('/adminlte/dist/css/skins/skin-blue.min.css')}}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  {{-- <style>.cke{visibility:hidden;}</style>
  <script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/ckeditor/config.js?t=I639"></script>
  <link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/AdminLTE/bower_components/ckeditor/skins/moono-lisa/editor.css?t=I639">
  <script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/ckeditor/lang/en.js?t=I639"></script>
  <script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/ckeditor/styles.js?t=I639"></script>
  <link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/AdminLTE/bower_components/ckeditor/plugins/scayt/skins/moono-lisa/scayt.css">
  <link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/AdminLTE/bower_components/ckeditor/plugins/scayt/dialogs/dialog.css">
  <link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/AdminLTE/bower_components/ckeditor/plugins/tableselection/styles/tableselection.css">
  <link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/AdminLTE/bower_components/ckeditor/plugins/wsc/skins/moono-lisa/wsc.css"> --}}
  <link rel="stylesheet" href="{{asset('/adminlte/dist/css/AdminLTE.min.css')}}">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-black sidebar-mini">
  <div class="wrapper">
    <!-- Header -->
    @include('admin.layouts.navigationbar')
    <!--/ Header -->

    <!-- SideMenu -->
    @include('admin.layouts.sidemenu')
    <!--/ SideMenu -->

    <!-- Content -->
    @yield('content')
    <!--/ Content -->

    <!-- Footer -->
    @include('admin.layouts.footer')
    <!--/ Footer -->

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')
    <!--/ Sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->
  <script src="{{asset('/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- Select2 -->
  <script src="{{asset('/adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <!-- DataTables -->
  <script src="{{asset('/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset('/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('/adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('/adminlte/dist/js/adminlte.min.js')}}"></script>
  <!-- Image-Picker -->
  <script src="{{asset('/image-picker-master/image-picker/image-picker.js')}}"></script>
  <script src="{{asset('/image-picker-master/image-picker/image-picker.min.js')}}"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{asset('/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
  <!-- CK Editor -->
  <script src="{{asset('/adminlte/bower_components/ckeditor/ckeditor.js')}}"></script>
  {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
  <script src="{{asset('/jQuery-File-Upload/js/vendor/jquery.ui.widget.js')}}"></script>
  <script src="{{asset('/jQuery-File-Upload/js/jquery.iframe-transport.js')}}"></script>
  <script src="{{asset('/jQuery-File-Upload/js/jquery.fileupload.js')}}"></script>
  {{-- <script src="{{asset('/jQuery-File-Upload/js/jquery.fileupload-ui.js')}}"></script> --}}
  <!-- Bootstrap slider -->
  <script src="{{asset('/adminlte/plugins/bootstrap-slider/bootstrap-slider.js')}}"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    /** add active class and stay opened when selected */
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
      return this.href == url;
    }).parent().addClass('active');

    // for treeview
    $('ul.treeview-menu a').filter(function() {
      return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

  </script>

  <script>
    $(function () {
      // $('#example').DataTable({
        // 'paging'      : true,
        // 'lengthChange': false,
        // 'searching'   : false,
        // 'ordering'    : true,
        // 'info'        : true,
        // 'autoWidth'   : false
      // })
    })
    function trimString(string)
    {
    	string = string.replace(/&nbsp;/g, ' ');
    	string = string.replace(/&amp;/g, '&');
    	string = string.replace(/&lt;/g, '<');
    	string = string.replace(/&gt;/g, '>');
    	string = string.replace(/&quot;/g, '"');
    	string = string.replace(/&#x27;/g, "'");
    	string = string.replace(/&#x2F;/g, "/");
    	string = string.replace(/&#39;/g, "`");
    	string = string.replace(/&/g, "%26");

    	return string;
    }
  </script>

    <!-- custom JS -->
    @yield('js')
    <!--/ Custom JS -->

  {{-- <script src="{{asset('/js/ckfinder/ckfinder.js')}}"></script>
  <script>
      CKFinder.widget( 'ckfinder1', {
          height: 600
      } );
  </script> --}}
  {{-- <script src="{{asset('/js/ckfinder/ckfinder.js')}}"></script>
  <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script> --}}

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. -->
</body>
</html>



