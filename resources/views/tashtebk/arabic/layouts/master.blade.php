<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{asset('') . $setting->getFav()->link}}" rel="shortcut icon">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{asset('/tashtebk/css/vendors/bootstrap.min.css')}}">
        
        <!-- Font  -->
        <link rel="stylesheet" href="{{asset('/tashtebk/css/vendors/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('/tashtebk/css/vendors/icofont.min.css')}}">
        <link rel="stylesheet" href="{{asset('/tashtebk/css/vendors/themify-icons.css')}}">
	    <link rel="stylesheet" href="{{asset('/tashtebk/css/vendors/ie7.css')}}">
    
        <!-- Swiper -->
        <link rel="stylesheet" href="{{asset('/tashtebk/css/vendors/swiper.min.css')}}">

        <!-- Owl Carousel -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

       <link rel="stylesheet" type="text/css" href="{{asset('/tashtebk/css/vendors/xzoom.css')}}" media="all" />
       <link rel="stylesheet" type="text/css" href="{{asset('/tashtebk/source/jquery.fancybox.css')}}"  />
      
        <!-- Animate -->
        <link rel="stylesheet" href="{{asset('/tashtebk/css/vendors/animate.css')}}">
        
        <!-- jQuery Steps -->
        <link rel="stylesheet" href="{{asset('/tashtebk/css/vendors/jquery.steps.css')}}">

        <!-- Custom CSS -->
        <!--<link rel="stylesheet" href="{{asset('/tashtebk/css/style.css')}}">-->

        <!--Mostafa Added,Arabic attachments-->
        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('/tashtebk/css/bootstrap-rtl.min.css')}}">
        <link rel="stylesheet" href="{{asset('/tashtebk/css/style-rtl.css')}}">
        <!-- Select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        
        <!-- bootstrap slider -->
        <!--<link rel="stylesheet" href="{{asset('/adminlte/plugins/bootstrap-slider/slider.css')}}">-->
        
        <!-- Jquery UI -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        
        @yield('custom-css')
        <title>Brickker</title>
    </head>
    <body data-spy="scroll" data-target="#header" data-offset="80">
        <!--<section id="container">-->
            @include('tashtebk.arabic.layouts.navigationbar')

                @yield('content')

            @include('tashtebk.arabic.layouts.footer')
        <!--</section>-->
        <script src="{{asset('/tashtebk/js/vendors/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('/tashtebk/js/vendors/bootstrap.js')}}"></script>
        
        <!-- Owl Carousel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <!-- jQuery Steps -->
        <script src="{{asset('/tashtebk/js/vendors/modernizr-2.6.2.min.js')}}"></script>
        <script src="{{asset('/tashtebk/js/vendors/jquery.cookie-1.3.1.js')}}"></script>
        <script src="{{asset('/tashtebk/js/vendors/jquery.steps.js')}}"></script>
        
        <script src="{{asset('/tashtebk/source/jquery.fancybox.pack.js')}}"></script>
        <script src="{{asset('/tashtebk/js/vendors//xzoom.min.js')}}"></script>
        <script src="{{asset('/tashtebk/js/vendors/swiper.min.js')}}"></script>
        <script src="{{asset('/tashtebk/js/vendors/wow.min.js')}}"></script>
        
        
        <script src="{{asset('/tashtebk/js/script.js')}}"></script>

        <!-- Select2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        
        <!-- Bootstrap-Slider -->
        <!--<script src="{{asset('/adminlte/plugins/bootstrap-slider/bootstrap-slider.js')}}"></script>-->
        
        <!-- Jquery UI -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        @if(session('success'))
        <script>alert('{{session('success')}}')</script>
        @endif
        <script>
            @yield('custom-js')
        </script>
        @yield('custom-script')
        <script>
            @if($errors->has('sign_up_password_confirmation') || $errors->has('sign_up_username') || $errors->has('sign_up_email'))
                $(document).ready(function(){
                    $('#myModal2').modal('show');
                });
            @endif

            $( "input[name='main_search_value']" ).on('keyup',function(){
        
                var search_value = $(this).val();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url:"{{ route('ar.home.search') }}",
                    method:"POST",
                    data:{_token: CSRF_TOKEN, search_value:search_value},
                    dataType:'JSON',
                    success: function(data)
                    {
                        $('.search-div').html('');
                        $('.search-div').html(data.result);
                    }
                });
            });
            // $( "input[name='main_search_value']" ).blur(function(){
            //     $('.search-div').html('');
            // });

            $( " .notification-count " ).on('click', function(){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url:"{{ route('ar.notification.clear') }}",
                    method:"POST",
                    data:{_token: CSRF_TOKEN},
                    dataType:'JSON',
                    success: function(data)
                    {
                        $('.notification-span').remove();
                        $('.notification-tag').html('لديك 0 تنبيهات جديدة');
                    }
                });

            });

        </script>
      </body>
</html>