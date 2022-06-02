@extends('admin.includes.app')

<link rel="ICON" href="{{asset('/dist/img/hicon.png')}}" type="image/ico" />

@section('content')
<h2 style="color: black;font-family: sans-serif;text-align: center;"><strong>Late Arrivals Record</strong></h2>

  <div class="alert alert-success" style="display:none">
      <strong>Success!</strong> Completed 
    </div>
    <div class="alert alert-danger" style="display:none">
      <strong>Error!</strong> There was some problem in the system.
    </div>
    
    
    <table id="example" class="table table-basic table-bordered datatable" cellspacing="0" width="100%" style="margin-top: 40px; background-color: #FFFFFF;text-align: center;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee</th>                
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
           @foreach($late as $l)
            <tr>
                <td>{{$l->id}}</td>
                <td>{{$l->user->name}}</td>
                <td>{{$l->created_at}}</td>
            </tr>
          @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Edit Category</h4>
          </div>
          <div class="modal-body">
            <form id="editcategory">
              {{ csrf_field() }}
              <input type="hidden" id="id" name="id">
              <div class="form-group">
                <label for="name" class="control-label">Category Name:</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
               <div class="form-group">
                <label  for="image" class="control-label">Image:</label>
                <input type="text" class="form-control" id="image" name="image">
              </div>
              <div class="form-group">
                <label for="description" class="control-label">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save" data-dismiss="modal">Save Category</button>
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
        $('#id').val('');
        $('#name').val('');
        $('#description').val('');
        $('#parent_id').val('');
        $('#exampleModalLabel').val('New Category');
    });
    
    $('.datatable tbody').on( 'click', 'a.edit_button', function () {
        var category = table.row( $(this).parents('tr') ).data();
        console.log( category );

        //$('.dropdown-toggle').dropdown()
        $('#id').val(category[0]);
        $('#name').val(category[1]);
        $('#description').val(category[2]);
        $('#image').val(category[3]);
        $('#parent_id').val(category[4]);

        
    });

    $('#save').click(function(){
      // Use Ajax to submit form data
        
      var editOrNew = $('#exampleModalLabel').val();
      var url = '/edit/category';
      if(editOrNew === 'New Category') {
          url = '/create/category';
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
@endpush()