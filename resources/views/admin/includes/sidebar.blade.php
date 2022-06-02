<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image" style="margin-top: 20px">
          <img src="/dist/img/proimg.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info" style="margin-top: 20px">
          <p></p>
          <!-- Status -->
          <a  href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!-- <form action="" method="get" class="sidebar-form">
          
        <div class="input-group">
          <input type="text" name="q" id="q" class="form-control" placeholder="Search Quiz|Categoroy">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>    -->
        
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" style="border-left-color: #222D32;margin-top: 10px ">
       <!-- <li class="header" style="color: white; font-size: 20px;text-align: center;">DashBoard</li>-->
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{route('employees')}}"><i class="fa fa-users"></i><span>Employees</span></a></li>
        <li class="active"><a href="{{route('latecommers')}}"><i class="fa fa-user"></i><span>Late Arrivals</span></a></li>
        <li class="active"><a href="{{route('earlygoers')}}"><i class="fa fa-clock-o"></i><span>Time Defaulters</span></a></li>
         <li class="active"><a href="{{route('location')}}"><i class="fa fa-map-marker"></i><span>Location</span></a></li>
        
        <!-- <li class="active"><a href="{{route('earlygoers')}}"><i class="fa fa-check-circle-o"></i>
          <span>Check</span></li>
         -->
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>