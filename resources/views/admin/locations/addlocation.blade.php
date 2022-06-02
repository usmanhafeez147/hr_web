@extends('admin.includes.app')

<link rel="ICON" href="{{asset('/dist/img/hicon.png')}}" type="image/ico" />

@section('content')
  <h2 style="color: black; text-align: center;font-family: sans-serif;"><strong>Location Record</strong></h2>

  <div class="alert alert-success" style="display: none;">
  	<strong>Success!</strong>Location has been saved
  </div>

  <div class="alert alert-danger" style="display: none;">
  	<strong>Error!</strong>There was some problem in the system
  </div>

  <div style="width: 15%; margin-bottom: 10px">
  	<button type="button" id="newcategory" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal" style="margin-bottom: 20px">Add Location</button>
  </div>

   <table id="example" class="table table-basic table-bordered datatable" cellspacing="0" width="100%" style="margin-top: 40px; background-color: #FFFFFF;text-align: center;">
   	<thead>
   		<tr>
   			<th>Location ID</th>
   			<th>Company ID</th>
   			<th>Longitude</th>
   			<th>Latitude</th>
   			<th>Diameter</th>
   			<th>Options</th>
   		</tr>
   	</thead>
   	  <tbody>

   	  	@foreach($locations as $loc)
   	  	<tr>
   	  		<td>{{$loc->location_id}}</td>
   	  		<td>{{$loc->company_id}}</td>
   	  		<td>{{$loc->longitude}}</td>
   	  		<td>{{$loc->latitude}}</td>
   	  		<td>{{$loc->diameter}}</td>
   	  		<td>
   	  		<button class="btn btn-primary" title="Edit"> 	<a style="color: white" class="edit_button" href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-square-o"></i></a></button>
   	  			<button class="btn btn-danger" title="Delete"><a style="color: white" href="{{route('delete_location',$loc->location_id)}}"><i class="fa fa-trash"></i></a>
   	  		</td></button>
   	  	</tr>
   	  	@endforeach
   	  </tbody>
   </table>

   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Add Location</h4>
          </div>
          <div class="modal-body">
            <form id="editcategory">
              {{ csrf_field() }}
              <input type="hidden" class="form-control" id="id" name="id">

              <div class="form-group">
                <label for="longitude" class="control-label">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude">
              </div>
               <div class="form-group">
                <label  for="image" class="control-label">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude">
              </div>
              <div class="form-group">
                <label  for="diameter" class="control-label">Diameter</label>
                <input type="text" class="form-control" id="diameter" name="diameter">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save" data-dismiss="modal">Add Location</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('after_scripts')
   <script type="text/javascript">
    $(document).ready(function() {
        var table = $('.datatable').DataTable();

        
          
          $.ajax({
              url: url,
              type: 'POST',
              data: $('#editcategory').serialize(),
              success: function(result) {
                  // ... Process the result ...
                  if(result.status == 'success')
                  {
                    console.log('success');
                    $('.alert-success').show();

                    // window.setTimeout(function () {
                    //     $('.alert-success').hide();
                    // }, 1000);

                    window.location.reload();
                  } 
                  else {
                    $('.alert-danger').show();
                    window.setTimeout(function () {
                        $('.alert-danger').hide();
                    }, 1000);
                  }
                  console.log(result);
              }
          });
            
        })

    });
    </script>

@endpush()