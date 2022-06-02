@extends('guest.layouts.app')

@section('content')
	

<div class="container">
	<h4>Invite employee</h4>
</div>
<!-- navbar ends -->




<form method="post" action="{{route('invite',$token)}}">
	{{csrf_field()}}

	<div class="container">
		<div class="row">
			<div class="col-sm-3 form-group">
				<input type="hidden" value="{{$company_id}}" name="company_id">

				<label>Name</label>
				<input required type="text" placeholder="Enter Name here.." class="form-control" name="name">
			</div>
			<div class="col-sm-4 form-group">
				<label>Email</label>
				<input required type="text" placeholder="Enter Email here.." class="form-control" name="email">
			</div>
		</div>
		
		
		<br>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="btn-group">
						<input type="submit" value=" Invite Employees" class="btn btn-primary">

						<a class="" ></a>
						<a  class="btn btn-danger" style="color:white;">
						<span class="fa fa-times" aria-hidden="true"></span> Skip this step 
					 	</a>
					</div>
					


				</div>
				

			</div>
		</div>
	</div>
</form>



<!-- <div  class="container">

		<h5 class="or">OR</h5>
	
	<div class="row">

		<div class="col-sm-3">
			<form method="post" >
			{{csrf_field()}}
			<input type="hidden" value="{{$company_id}}" name="company_id">

			<button  class="btn btn-block btn-danger">
				<span class="fa fa-times" aria-hidden="true"></span>

			Skip this step 
			 </button>
			</form>
		</div>
	</div>
</div> -->


@endsection()
