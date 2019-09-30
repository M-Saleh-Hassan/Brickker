<!--<div id="header">-->
    <header  class="navbar-fixed-top box-shadow">
       <div class="top-head">
           <div class="container">
               <div class="row">
                   <div class="col-md-4 col-sm-6 mg_bt10 col" style=" flex-direction: column;">
                       <a class="logo " href="{{route('en.home.index')}}">
                           <img src="{{asset('') . $setting->getLogo()->link}} " alt="" style="width: 133px">
                       </a>
                       <div class="mobile hidden-sm hidden-md hidden-lg">
                               <div class="header">
                                   <div class="menu-toggle ">
                                       <div class="line"></div>
                                       <div class="line"></div>
                                       <div class="line"></div>
                                   </div>
                               </div>
                               <div class="mobile-nav d-none">
                                       <ul>
                                           <li class="active" ><a href="{{route('en.home.index')}}">Home</a></li>
                                           @if(Auth::check())
                                           <li ><a href="{{ route('en.scale.index') }}">BOQ</a></li>
                                           @else
                                           <li><a type="button" data-toggle="modal" data-target="#Login-Modal">BOQ</a></li>
                                           @endif
                                           <li><a href="{{ route('en.category.show_all') }}">Catalogs</a></li>
                                           <li class="dropdown"><a href="#"  class="dropdown-toggle " data-toggle="dropdown">Service Providers <i class="fa fa-chevron-down"></i></a>
                                           <ul class="dropdown-menu dropdown-services">
                                               @foreach($user_types as $user_type)
                                                    <li><a href="{{route('en.category.show_all', ['provider' => $user_type->type])}}">{{$user_type->type}}</a></li>
                                               @endforeach
                                           </ul>
                                           </li>
                                       </ul>
                               </div>
                           </div>
                   </div>

                   <div class="col-md-4 col-sm-6 mg_bt10 col">
                       <form class="search">
                           <label>
                               <i class="fa fa-search"></i>
                               <span class="sr-only">Search</span>
                           </label>
                           <input type="text" name="main_search_value" class="form-control parent" placeholder="Search">
                           <button type="submit" class="disnone"></button>
                       </form>
                        <div class="search-div">
                        </div>
                   </div>
                   <div class=" col-md-4 col-sm-12 text-center headerRight col">
                       @if((Auth::check()) && (Auth::user()->getUserType() != 'admin'))
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               @csrf
                           </form>

                           <div class="top-nav notification-row">
                            <!-- notificatoin dropdown start-->
                            <ul class="nav pull-right top-menu">
                                 <!-- user login dropdown start-->
                              <li>
                                   <ul class="drop">
                                       <li class="dropdown">
                                           <a href="#" class="dropdown-toggle drop-profile" ><img src="{{asset('').Auth::user()->avatar}}">  <span>{{Auth::user()->username}}</span> </a>
                                           <ul class="dropdown-menu">
                                               <li><a href="{{ route('en.profile.index', ['username'=>Auth::user()->username_tag]) }}" type="button">Profile</a></li>
                                               <li><a href="{{ route('en.chat.index') }}" type="button"  >Messages</a></li>
                                               @if(Auth::user()->getUserType() == 'customer')
                                               <li><a href="{{ route('en.checkout.index', [Auth::user()->username_tag]) }}" type="button">Orders</a></li>
                                               @else
                                               <li><a href="{{ route('en.offer.index', [Auth::user()->username_tag]) }}" type="button">Offers</a></li>
                                               @endif
                                               <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">Logout</a></li>
                                           </ul>
                                       </li>

                                   </ul>
                              </li>
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
                                        <a style="text-align:center" class="notification-tag"> You have {{Auth::user()->notificationsCount()}} new notifications</a>
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
                              <!-- alert notification end-->
                                <li class="lang-bottom"><a href="{{route('change-lang', ['lang' => 'ar'])}}" style="font-size: 18px !important;" class="lang">ع</a></li>
                            </ul>
                            <!-- notificatoin dropdown end-->
                             </div>
                           <!--<a href="{{ route('en.profile.index', ['username'=>Auth::user()->username_tag]) }}" type="button"  class="btn-sign">Profile</a>-->
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
                                       document.getElementById('logout-form').submit();">Logout</a></li>
                                   </ul>
                                <a href="{{route('change-lang', ['lang' => 'ar'])}}" style="font-size: 18px !important;" class="lang">ع</a>
                               </li>
                           <!--</ul>-->
                           <!--<a href="{{ route('admin.home.index') }}" type="button"  class="btn-sign">Control Panel</a>-->
                           <!--<a href="{{ route('logout') }}" class="btn-sign" onclick="event.preventDefault();-->
                           <!--document.getElementById('logout-form').submit();">Logout</a>-->
                       @else
                           <a type="button" data-toggle="modal" data-target="#Login-Modal" class="btn-sign">login</a>
                           <a type="button" data-toggle="modal" data-target="#myModal2" class="btn-sign">register</a>
                            <a href="{{route('change-lang', ['lang' => 'ar'])}}" class="lang">ع</a>
                       @endif

                   </div>

               </div>
           </div>

       </div>

       <div class="nav-head  hidden-xs">
           <div class="container">
               <nav>
                   <ul class="drop drop1">
                       <li class="active" ><a href="{{route('en.home.index')}}">Home</a></li>
                       @if(Auth::check())
                       <li ><a href="{{ route('en.scale.index') }}">BOQ</a></li>
                       @else
                       <li><a type="button" data-toggle="modal" data-target="#Login-Modal">BOQ</a></li>
                       @endif
                       <li><a href="{{ route('en.category.show_all') }}">Catalogs</a></li>
                       <li class="dropdown"><a href="#"  class="dropdown-toggle " data-toggle="dropdown">Service Providers <i class="fa fa-chevron-down"></i></a>
                       <ul class="dropdown-menu dropdown-services">
                           @foreach($user_types as $user_type)
                                <li><a href="{{route('en.category.show_all', ['provider' => $user_type->type])}}">{{$user_type->type}}</a></li>
                           @endforeach
                       </ul>
                       </li>
                       <!--<li><a href="{{route('en.about.index')}}">About us</a></li>-->
                       <!--<li ><a href="#">Help</a></li>-->
                   </ul>
               </nav>
           </div>
       </div>
    </header>
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible errors-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> You get some errors!</h4>
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
    @include('tashtebk.english.layouts.modal')
<!--</div>-->
