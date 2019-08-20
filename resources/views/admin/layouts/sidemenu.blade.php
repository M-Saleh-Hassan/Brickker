<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    {{-- <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('/adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
      </div>
    </form>
    <!-- /.search form --> --}}

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Menu</li>
      <!-- Optionally, you can add icons to the links -->
      <li><a href="{{route('admin.home.index')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>

      <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Users</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="{{route('admin.users')}}"><i class="fa fa-circle-o"></i>Users Data</a></li>
              <li><a href="{{route('admin.users.types')}}"><i class="fa fa-circle-o"></i>Types</a></li>
          </ul>

      </li>

      <li><a href="{{route('admin.products.index')}}"><i class="fa fa-link"></i> <span>Products</span></a></li>

      <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Scales</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="{{route('admin.scale.index')}}"><i class="fa fa-circle-o"></i>Scales</a></li>
              <li><a href="{{route('admin.step.index')}}"><i class="fa fa-circle-o"></i>Steps</a></li>
          </ul>
      </li>

      <li><a href="{{route('admin.media.index')}}"><i class="fa fa-link"></i> <span>Media</span></a></li>

      <li><a href="{{route('admin.categories.index')}}"><i class="fa fa-link"></i> <span>Categories</span></a></li>

      <li><a href="{{route('admin.units.index')}}"><i class="fa fa-link"></i> <span>Units</span></a></li>

          <li><a href="{{route('admin.quantities.index')}}"><i class="fa fa-link"></i> <span>Quantities</span></a></li>

      <li><a href="{{route('admin.slider.index')}}"><i class="fa fa-link"></i> <span>Home Slider</span></a></li>

      <li><a href="{{route('admin.settings.index')}}"><i class="fa fa-link"></i> <span>Settings</span></a></li>

      <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Website Info</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="{{route('admin.about.index')}}"><i class="fa fa-circle-o"></i> <span>About</span></a></li>
              <li><a href="{{route('admin.policy.index')}}"><i class="fa fa-circle-o"></i> <span>Policy</span></a></li>
              <li><a href="{{route('admin.faqs.index')}}"><i class="fa fa-circle-o"></i> <span>FAQ</span></a></li>
              <li><a href="{{route('admin.contact_us.index')}}"><i class="fa fa-circle-o"></i> <span>Contact Us</span></a></li>
              <li><a href="{{route('admin.reports.index')}}"><i class="fa fa-circle-o"></i> <span>Report A Mistake</span></a></li>
              <li><a href="{{route('admin.howtowork.index')}}"><i class="fa fa-circle-o"></i> <span>How To Work</span></a></li>
              <li><a href="{{route('admin.term.index')}}"><i class="fa fa-circle-o"></i> <span>Terms Of Service</span></a></li>
          </ul>
      </li>

      <li><a href="{{route('admin.ads.index')}}"><i class="fa fa-link"></i> <span> Ads </span></a></li>
      <li><a href="{{route('admin.currencies.index')}}"><i class="fa fa-link"></i> <span> Currencies </span></a></li>
      <li><a href="{{route('admin.countries.index')}}"><i class="fa fa-link"></i> <span> Countries </span></a></li>

      {{-- <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Categories</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li class="treeview">
              <a href="#">Link in level 2
                  <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="#">Link in level 3</a></li>
                  <li><a href="#">Link in level 3</a></li>
              </ul>
          </li>
          <li><a href="#">Link in level 2</a></li>
        </ul>
      </li> --}}
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
