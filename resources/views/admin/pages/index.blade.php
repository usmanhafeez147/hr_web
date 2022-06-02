@extends('admin.includes.app')

<link rel="ICON" href="{{asset('/dist/img/hicon.png')}}" type="image/ico" />

@section('content')
<h2 style="text-align: center;"><strong>Employees Record</strong></h2>
  <div class="alert alert-success" style="display:none">
    <strong>Success!</strong> Employee has been invited
  </div>
  <div class="alert alert-danger" style="display:none">
    <strong>Error!</strong> There was some problem in the system.
  </div>
  <div style="width: 15%; margin-bottom: 10px">
      <button type="button" id="newcategory" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal" style="margin-bottom: 20px">Invite Employee</button>
  </div>

  <table id="example" class="table table-basic table-bordered datatable" cellspacing="0" width="100%" style="margin-top: 40px; background-color: #FFFFFF;text-align: center;">

      <thead >
          <tr style="text-align: center;">
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Status</th>
              <th>Company</th>
              <th>Options</th>
          </tr>
      </thead>
      <tbody>
        @foreach($users as $u)
          <tr>
              <td>{{$u->id}}</td>
              <td>{{$u->name}}</td>
              <td>{{$u->email}}</td>
              
                @if($u->status==1)
                <td>
                  Active
                </td>
                
                @else
                
                  <td>
                  In-active
                </td>
                
                @endif
              
              <td>{{$u->company->company_name}}</td>
              <td>
              <button class="btn btn-primary" title="Edit">  <a style="color: white" class="edit_button" href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-square-o"></i></a> </button>
                <button class="btn btn-danger" title="Delete"> <a style="color: white" href="{{route('delete_employee',$u->id)}}"><i class="fa fa-trash"></i></a></button> 
               <button class="btn btn-primary" title="Attendance"> <a style="color: white" href="{{route('checks',$u->id)}}"><i class="fa fa-clock-o" tooltip="Attendance"></i></a></button>
               <button class="btn btn-success" title="Re-Invite"> <a style="color: white" class="reinvite_button" href="" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-user-plus"></i></a></button>
              </td>
          </tr>
        @endforeach
          
      </tbody>
  </table>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Invite Employee</h4>
          </div>
          <div class="modal-body">
            <form id="editcategory">
              {{ csrf_field() }}
              <input type="hidden" class="form-control" id="id" name="id">

              <div class="form-group">
                <label for="name" class="control-label">Employee's Name:</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
               <div class="form-group">
                <label  for="image" class="control-label">Email:</label>
                <input type="text" class="form-control" id="email" name="email">
              </div>
              <!-- <div class="form-group">
                <label for="status" class="control-label">Status:</label>
                <select class="form-control" id="status" name="status">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div> -->
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save" data-dismiss="modal">Invite </button>
          </div>
        </div>
      </div>
    </div>
@endsection
@push('after_scripts')

 <script type="text/javascript">
$(document).ready(function() {
    var table = $('.datatable').DataTable();

    $('#newcategory').click(function() {
        
        $('#name').val('');
        
        $('#email').val('');
        $('#exampleModalLabel').val('New Category');
         $('#save').html('Invite Employee');
    });
    
    $('.datatable tbody').on( 'click', 'a.edit_button', function () {
        var category = table.row( $(this).parents('tr') ).data();
        console.log( category );

        //$('.dropdown-toggle').dropdown()
        $('#id').val(category[0]);
        $('#name').val(category[1]);
        $('#email').val(category[2]);
        $('#save').html('Update Employee');
    });

    $('.datatable tbody').on( 'click', 'a.reinvite_button', function () {
        var category = table.row( $(this).parents('tr') ).data();
        console.log( category );

        //$('.dropdown-toggle').dropdown()
        $('#id').val(category[0]);
        $('#name').val(category[1]);
        $('#email').val(category[2]);
        $('#exampleModalLabel').val('reinvite');
         $('#save').html('Re-Invite Employee');
    });

    $('#save').click(function(){
      // Use Ajax to submit form data
        
      var editOrNew = $('#exampleModalLabel').val();
      var url = '/admin/employee/update';
      if(editOrNew === 'New Category') {
          url = '/admin/employee/store';
      }
      else if(editOrNew === 'reinvite')
      {
        url='/admin/employee/reinvite';
      }
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