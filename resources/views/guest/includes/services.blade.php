<!-- Services -->
<section  class="content-section bg-primary text-white text-center" id="services">
  <div class="container">
    <div class="content-section-heading">
      <h3 class="text-secondary mb-0">Services</h3>
      <h2 class="mb-5">What We Offer</h2>
    </div>
    <div class="row-centered">
      @foreach($packages as $package)
      <div class="col-lg-3 col-md-6 mb-5 mb-lg-0 col-centered" style="background-color:#E9B41A;margin-right: 20px;color: white;height: 400px;border-radius: 10px;width: 300px" >
        <a style="text-decoration:none; background-color: black;" href="{{route('subscribe',[str_slug($package->name),$package->id_package])}}"> 
          <span class="service-icon rounded-circle mx-auto mb-3" style="width: 150px; height: 130px;text-align: center;margin-top: 30px">
           <!-- <i  class="icon-screen">{{$package->name}}</i>-->
           <i class="icon-screen">{{$package->price}}<sup>USD</sup></i>
          </span>
        </a>
        
        <h4 style="margin-top: 40px">
         <strong>{{$package->name}}</strong>
        </h4>
        <h5>
          <strong>users:{{$package->no_of_users}}</strong>
        </h5>
     <button style="border-radius: 8px;margin-top: 70px;background-color: white;border-color: white;border-left-:160px;color:white"><a style="text-decoration: none;font-family: sans-serif;display: block; height: 40px" href="{{route('subscribe',[str_slug($package->name),$package->id_package])}}" class="btn btn-block">Join Now</a>
      </button>

      </div>
      @endforeach()
    </div>
    <!-- <a class="btn btn-primary btn-xl js-scroll-trigger" href="#portfolio">See Our Portfollio</a> -->
  </div>
</section>