@extends('layouts.adminlisting')

@section('page_title', 'Manage Users')

@section('page_description', 'Quiz Categories in the system')

@section('content')



    <div class="alert alert-success" style="display:none">
      <strong>Success!</strong> Your category has been saved
    </div>
    <div class="alert alert-danger" style="display:none">
      <strong>Error!</strong> There was some problem in the system.
    </div>

   <!--New user using old registrationform <div style="width: 15%; margin-bottom: 10px">
		<form  action="{{ route('register') }}" method="get">
	<input class="btn btn-block btn-success"  type="submit" value="New User">
</form>
    </div>-->
    <div style="width: 15%; margin-bottom: 10px">
        <button type="button" id="newquiz" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal">New User</button>
    </div>
     <table id="example" class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th width="30%">Email</th>
			    <th>Password</th>
                <th>User Type</th>
                <th>Added On</th>
                <th>Options</th>
            </tr>
        </thead>
       
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->password }}</td>
                <td>{{ $user->usertype }}</td>
                <td>{{ $user->created_at }}</td>
                <td><a class="edit_button" href="#" data-toggle="modal" data-target="#exampleModal">Edit</a> |
					<a href="{{route('delete.user',['id' =>$user->id])}}">Delete</a>
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
            <h4 class="modal-title" id="exampleModalLabel">Edit User</h4>
          </div>
          <div class="modal-body">
            <form id="editcategory">
              {{ csrf_field() }}
              <input type="hidden" id="id" name="id">
              <div class="form-group">
                <label for="name" class="control-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
              <div class="form-group">
                <label for="email" class="control-label">Email:</label>
                <input type="text" class="form-control" id="email" name="email">
              </div>
				 <div class="form-group">
                <label for="password" class="control-label">Password:</label>
                <input type="text" class="form-control" id="password" name="password">
              </div>
              <div class="form-group">
                <label for="status" class="control-label">User Type:</label>
                <select class="form-control" id="usertype" name="usertype">
                  <option value="admin">admin</option>
                  <option value="user">User</option>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save" data-dismiss="modal">Save User</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('page-js-script')
<script type="text/javascript">
$(document).ready(function() {
    var table = $('.datatable').DataTable();

    $('#newquiz').click(function() {
        $('#id').val('');
        $('#name').val('');
        $('#email').val('');
        $('#password').val('');
        $('#usertype').val('');
        $('#exampleModalLabel').val('New Category');
    });
    
    $('.datatable tbody').on( 'click', 'a.edit_button', function () {
        var category = table.row( $(this).parents('tr') ).data();
        console.log( category );

        //$('.dropdown-toggle').dropdown()
        $('#id').val(category[0]);
        $('#name').val(category[1]);
        $('#email').val(category[2]);
        $('#password').val(category[3]);
        $('#usertype').val(category[4]);
    });

    $('#save').click(function(){
      // Use Ajax to submit form data
        
      var editOrNew = $('#exampleModalLabel').val();
      var url = '/admin/users/save';
      if(editOrNew === 'New Category') {
          url = '/admin/users/new';
      }
      $.ajax({
          url: url,
          type: 'POST',
          data: $('#editcategory').serialize(),
          success: function(result) {
              // ... Process the result ...
              if(result.status == 'success')
              {
                $('.alert-success').show();
                window.setTimeout(function () {
                    $('.alert-success').hide();
                }, 1000);

              } else {
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
@endsection