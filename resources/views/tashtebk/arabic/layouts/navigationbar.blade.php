<!--<div id="header">-->
    <header  class="navbar-fixed-top box-shadow">
       <div class="top-head">
           <div class="container">
               <div class="row">
                   <div class="col-md-4 col-sm-3  mg_bt10 col" style=" flex-direction: column;">
                       <a class="logo " href="{{route('ar.home.index')}}">
                           <img src="{{asset('') . $setting->getLogo()->link}}" alt="" style="width: 133px;">
                       </a>
                       <div class="mobile hidden-sm hidden-md  hidden-lg">
                               <div class="header">
                                   <div class="menu-toggle">
                                       <div class="line"></div>
                                       <div class="line"></div>
                                       <div class="line"></div>
                                   </div>
                               </div>
                               <div class="mobile-nav d-none">
                                       <ul>
                                           <li class="active" ><a href="{{route('ar.home.index')}}">الرئيسية</a></li>
                                           @if(Auth::check())
                                           <li ><a href="{{ route('ar.scale.index') }}">المقايسات</a></li>
                                           @else
                                           <li><a type="button" data-toggle="modal" data-target="#Login-Modal">المقايسات</a></li>
                                           @endif
                                           <li><a href="{{ route('ar.category.show_all') }}">التصنيفات</a></li>
                                           <li class="dropdown"><a href="#"  class="dropdown-toggle " data-toggle="dropdown">موردي الخدمات <i class="fa fa-chevron-down"></i></a>
                                           <ul class="dropdown-menu dropdown-services">
                                               @foreach($user_types as $user_type)
                                                    <li><a href="{{route('ar.category.show_all', ['provider' => $user_type->type])}}">{{$user_type->type}}</a></li>
                                               @endforeach
                                           </ul>
                                           </li>
                                       </ul>
                               </div>
                           </div>
                   </div>

                   <div class="col-md-4 col-sm-4 mg_bt10 col">
                       <form class="search">
                           <label>
                               <i class="fa fa-search"></i>
                               <span class="sr-only">ابحث</span>
                           </label>
                           <input type="text" name="main_search_value" class="form-control parent" placeholder="ابحث">
                           <button type="submit" class="disnone"></button>
                       </form>
                        <div class="search-div">
                        </div>
                   </div>
                   <div class=" col-md-4 col-sm-5 text-center headerRight col">
                       @if((Auth::check()) && (Auth::user()->getUserType() != 'admin'))
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               @csrf
                           </form>

                           <div class="top-nav notification-row">
                            <!-- notificatoin dropdown start-->
                            <ul class="nav pull-right top-menu">
                                 <!-- user login dropdown start-->
                           <!-- alert notification end-->
                            <li class="lang-bottom"><a href="{{route('change-lang', ['lang' => 'en'])}}" class="lang">EN</a></li>

                              <!-- user login dropdown end -->
                              <!-- inbox notificatoin end -->
                              <!-- alert notification start-->

                              @if((Auth::check()) && (Auth::user()->getUserType() != 'admin'))
                              <li id="alert_notificatoin_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle notification-count">
                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                    @if(Auth::user()->notificationsCount())<span class="badge bg-important notification-span">{{Auth::user()->notificationsCount()}}</span>@endif
                                </a>
                                <ul class="dropdown-menu notifications-menu">
                                    <li>
                                        <a style="text-align:center" class="notification-tag">لديك {{Auth::user()->notificationsCount()}} تنبيهات جديدة</a>
                                    </li>
                                @foreach(Auth::user()->notifications as $notification)
                                    <li>
                                        <a href="
                                        @if(Auth::user()->getUserType() == 'customer')
                                        {{route('en.checkout.index', [Auth::user()->username_tag])}}
                                        @else
                                        {{route('en.offer.index', [Auth::user()->username_tag])}}
                                        @endif
                                        ">
                                            <i class="icon_profile"></i>
                                            {{$notification->message_en}}
                                                            <!--<span class="small italic pull-right">5 mins</span>-->
                                        </a>
                                    </li>
                                @endforeach
                                  <!--<li>-->
                                  <!--  <a href="#">See all notifications</a>-->
                                  <!--</li>-->
                                </ul>
                              </li>
                              @endif
                                <li>
                                   <ul class="drop">
                                       <li class="dropdown">
                                           <a href="#" class="dropdown-toggle drop-profile" data-toggle="dropdown"><img src="{{asset('').Auth::user()->avatar}}">  <span>{{Auth::user()->username}}</span> </a>
                                           <ul class="dropdown-menu">
                                               <li><a href="{{ route('ar.profile.index', ['username'=>Auth::user()->username_tag]) }}" type="button">الصفحة الشخصية</a></li>
                                               <li><a href="{{ route('ar.chat.index') }}" type="button"  >الرسائل</a></li>
                                               @if(Auth::user()->getUserType() == 'customer')
                                               <li><a href="{{ route('ar.checkout.index', [Auth::user()->username_tag]) }}" type="button">الطلبات</a></li>
                                               @else
                                               <li><a href="{{ route('ar.offer.index', [Auth::user()->username_tag]) }}" type="button">العروض</a></li>
                                               @endif
                                               <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">تسجيل خروج</a></li>
                                           </ul>
                                       </li>

                                   </ul>
                              </li>

                            </ul>
                            <!-- notificatoin dropdown end-->
                             </div>
                           <!--<a href="{{ route('ar.profile.index', ['username'=>Auth::user()->username_tag]) }}" type="button"  class="btn-sign">Profile</a>-->
                           <!--<a href="{{ route('logout') }}" class="btn-sign" onclick="event.preventDefault();-->
                           <!--document.getElementById('logout-form').submit();">Logout</a>-->
                       @elseif(Auth::check() && Auth::user()->getUserType() == 'admin')
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               @csrf
                           </form>
                            <ul class="drop">
                               <li class="dropdown">
                                   <a href="#" class="dropdown-toggle drop-profile" data-toggle="dropdown"><img src="{{asset('').Auth::user()->avatar}}">  <span>{{Auth::user()->username}}</span> </a>
                                   <ul class="dropdown-menu">
                                       <li><a href="{{ route('admin.home.index') }}" type="button"  >Control Panel</a></li>
                                       <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">تسجيل خروج</a></li>
                                   </ul>
                                   <a href="{{route('change-lang', ['lang' => 'en'])}}" style="font-size: 18px !important;" class="lang">EN</a>

                               </li>
                           <!--</ul>-->
                           <!--<a href="{{ route('admin.home.index') }}" type="button"  class="btn-sign">Control Panel</a>-->
                           <!--<a href="{{ route('logout') }}" class="btn-sign" onclick="event.preventDefault();-->
                           <!--document.getElementById('logout-form').submit();">Logout</a>-->
                       @else
                           <a type="button" data-toggle="modal" data-target="#Login-Modal" class="btn-sign">تسجيل دخول</a>
                           <a type="button" data-toggle="modal" data-target="#myModal2" class="btn-sign">انشىء حساب</a>
                            <a href="{{route('change-lang', ['lang' => 'en'])}}" class="lang">EN</a>
                       @endif

                   </div>

               </div>
           </div>

       </div>

       <div class="nav-head  hidden-xs">
           <div class="container">
               <nav>
                   <ul class="drop drop1">
                       <li class="active" ><a href="{{route('ar.home.index')}}">الرئيسية</a></li>
                       @if(Auth::check())
                       <li ><a href="{{ route('ar.scale.index') }}">المقايسات</a></li>
                       @else
                       <li><a type="button" data-toggle="modal" data-target="#Login-Modal">المقايسات</a></li>
                       @endif
                       <li><a href="{{ route('ar.category.show_all') }}">التصنيفات</a></li>
                       <li class="dropdown"><a href="#"  class="dropdown-toggle " data-toggle="dropdown">موردي الخدمات <i class="fa fa-chevron-down"></i></a>
                       <ul class="dropdown-menu dropdown-services">
                           @foreach($user_types as $user_type)
                                <li><a href="{{route('ar.category.show_all', ['provider' => $user_type->type])}}">{{$user_type->type}}</a></li>
                           @endforeach
                       </ul>
                       </li>
                       <!--<li><a href="{{route('ar.about.index')}}">About us</a></li>-->
                       <!--<li ><a href="#">Help</a></li>-->
                   </ul>
               </nav>
           </div>
       </div>
    </header>
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible errors-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> لديك بعض الأخطاء</h4>
            @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
        </div>
        <style>
            .errors-alert
            {
                z-index: 10000;
                position: fixed;
                margin: 0px auto;
                right: 0;
                left: 0;
                width: 25%;
            }
        </style>
    @endif
    @include('tashtebk.arabic.layouts.modal')
<!--</div>-->
