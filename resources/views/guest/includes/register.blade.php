<section id="myreg" style="padding-bottom:30px; max-width: 550px;border-style: initial;" class="content-section">
  <div id="registration"  class="container">
    <h1 id="register" class="well" style="margin-left:150px;">Join Us</h1>
    <div class="col-sm-12 well">
      <div class="row">

        <form method="post" action="{{ route('com_register')}}" style="border-style: initial; width: 200%;margin-top: 2%;">
          {{csrf_field()}}
          <input type="hidden" name="package" value="{{$package->id_package}}">
          <div class="col-sm-12">
              <div class=" form-group">
                <input required type="text" placeholder="Enter First Name" class="form-control" name="first_name" style="height: 50px">
              </div>
              <div class="form-group">
                
                <input required type="text" placeholder="Enter Last Name" class="form-control" name="last_name" style="height: 50px">
              </div>
            
              <div class=" form-group">
                
                <input required name="company_name" type="text" placeholder="Enter Company's Name" class="form-control" style="height: 50px">
              </div>
              <!-- <div class=" form-group">
                
                <select name="company_size" class="form-control" style="height: 50px">

                  <option class="active">Company Size</option>
                  <option>0 - 10</option>
                  <option>10 - 50</option>
                  <option>50 - 100</option>
                  <option>100 - 200</option>
                  
                  <option>More than 200</option>
                </select>
              </div>   -->  

          

            <div class="form-group">
              
              <input required type="text" placeholder="Enter Official address" class="form-control" name="address" style="height: 50px">
            </div>  

                     
            <div class="form-group">
              <input required class="form-control" name="phone" type="number" id="phone" placeholder="Enter Phone Number" style="height: 50px">
            </div>  
            <div class="form-group">
              
              @if ($errors->has('email'))
              <span class="help-block">
                <strong style="color:red;">{{ $errors->first('email') }}</strong>
              </span>
              @endif
              <input required name="email" type="text" placeholder="Enter Office Email" class="form-control" style="height: 50px">
            </div> 
            <div class="form-group">
              
              <input required name="password" type="password" class="form-control" placeholder="Enter Password" style="height: 50px">
            </div> 

            @if($package->is_free!=true)
              <hr>
              <div id="dropin-container"></div>
            @endif()
            <button style="background-color: rgb(240, 173, 78); border-color: rgb(240, 173, 78); margin-left: 160px" type="Submit" class="btn btn-lg btn-info">Get Started</button>          
          </div>
        </form> 
      </div>
    </div>
  </div>
</section>