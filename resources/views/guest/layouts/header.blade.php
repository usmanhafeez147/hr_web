<!-- Header -->
<!--<img src="/dist/img/hlogo.png" class="img-circle" alt="User Image" style="height: 100px; margin-left: 50px;">-->
<nav style="" class="navbar fixed-top navbar navbar-expand-md bg-dark navbar-dark " >
    <a class="navbar-brand" href="{{route('home')}}">Auto Attendence System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div  class="collapse navbar-collapse" id="collapsibleNavbar" style="">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a  class="nav-link" href="#page-top">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a  class="nav-link" href="#about">About <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a  class="nav-link" href="#services">Services <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item">
        <a  class="nav-link" class="nav-link" href="{{route('myhome')}}">Login <span class="sr-only">(current)</span></a>
      </li>     
    </ul>
  </div>  
</nav>
  <br><br>
<!--Header-->
<header class="masthead d-flex" style="height: 600px">
  <div class="container text-center my-auto">
    <h1 style="font-family: serif; font-weight: 600;font-size: 60px" class="mb-1" >Auto Attendence System</h1>
    <h3 class="mb-5">
      <em style="font-weight: 600">Powerd by Beaconites.</em>
      <br>
      @if(session('success'))

      <h5>{{session('success')}}</h5>

      @endif()
      @if(session('msg'))

      <h5>{{session('msg')}}</h5>

      @endif()
    </h3>
    <!-- <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a> -->
  </div>
  <div class="overlay"></div>
</header>