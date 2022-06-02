<!DOCTYPE html>
<html lang="en">

  <head>
    @include('guest.layouts.head')
  </head>

  <body id="page-top" style="background-color: #F5F8FA">
    <!-- Navigation -->
    
    @if(Route::is('home'))
     <!-- <a class="menu-toggle rounded" href="#">
        <i class="fa fa-bars"></i>
      </a>-->
      @include('guest.layouts.nav')

      @include('guest.layouts.header')
    @else
      @include('guest.layouts.nav_brand')
    @endif()

    @yield('content')
    @if(!Route::is('subscribe'))
      @include('guest.layouts.footer')
    @endif()
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    @include('guest.layouts.footer_scripts')
  </body>

</html>
