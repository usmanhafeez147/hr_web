@extends('guest.layouts.app')
@section('content')

<!-- navbar ends -->

<!-- video starts here -->
<!-- <div id="home" class="container">
  <iframe width="100%" height="345" src="https://www.youtube.com/embed/ANS9sSJA9Yc">
</iframe>
</div> -->


<form method="post" action="{{route('requirements')}}">
  {{csrf_field()}}
  <input type="hidden" name="company_id" value="{{$company->id}}">
  <div class="container" >
    <div class="row">
      <div class="col-sm-3 form-group">

        <label>Company's Starting Time</label>
        <select name="start_time" class="form-control">
          <option>06:00am</option>
          <option>07:00am</option>
          <option>08:00am</option>
          <option>09:00am</option>
          <option>10:00am</option>
          <option>11:00am</option>
          <option>12:00pm</option>
          <option>01:00pm</option>
          <option>02:00pm</option>
          <option>03:00pm</option>
          <option>04:00pm</option>
          <option>05:00pm</option>
          <option>06:00pm</option>
          <option>07:00pm</option>
          <option>08:00pm</option>
          <option>09:00pm</option>
        </select>
      </div>
      <br>
      <div class="col-sm-3 form-group">

        <label>Required Working Hours</label>
        <select name="hours" class="form-control">
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
        </select>
      </div>

    </div>

    
    <br>
    <div class="container">
      <div class="row">
        <div class="col-sm-3">

          <button style="width:200px;" class="btn btn-primary">Send Information <span  class="fa fa-arrow-right" aria-hidden="true"></span></button>
        </div>

        <div >

        </div>
      </div>
    </div>
  </div>

</form>

@endsection()


