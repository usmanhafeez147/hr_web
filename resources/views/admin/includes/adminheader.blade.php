<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="#" class="logo" style="background-color: #222D32">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini" style="background-color: #222D32"><b>A-A-P</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg" style="background-color: #222D32; text-align: center; margin-right: 30px;margin-top: 10px"><i style="margin-right: 10px" class="fa fa-paw"> </i><b>DashBoard</b></span>
  </a>
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation" style="background-color: #b58b09">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
       <li class="dropdown notifications-menu">
        <!-- Menu toggle button -->
       <!-- <a href="{{route('myhome')}}" >
          <i class="fa fa-user"> Main Site</i>
        </a>-->
      </li>
      <li class="dropdown notifications-menu">
        <!-- Menu toggle button -->
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <b style="font-size:20px;font-family: sans-serif; ">Logout</b> <i style="font-size: 20px" class="fa fa-sign-out"></i>
      </a>
    </li>
    <!-- Messages: style can be found in dropdown.less-->
    
    <!-- Control Sidebar Toggle Button -->
  </ul>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
  </form>
</div>
</nav>
</header>