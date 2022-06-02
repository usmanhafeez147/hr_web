@extends('admin.includes.app')

<link rel="ICON" href="{{asset('/dist/img/hicon.png')}}" type="image/ico" />

@section('content')
<h2 style="color: black;font-family: sans-serif;text-align: center;"><strong>Time Defaulters Record</strong></h2>
  <div class="alert alert-success" style="display:none">
      <strong>Success!</strong> Your category has been saved
    </div>
    <div class="alert alert-danger" style="display:none">
      <strong>Error!</strong> There was some problem in the system.
    </div>
    <table id="example" class="table table-basic table-bordered datatable" cellspacing="0" width="100%" style="margin-top: 40px; background-color: #FFFFFF;text-align: center;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th> 
                <th>Date</th> 
            </tr>
        </thead>
        <tbody>
    @foreach($datearr as $d)
  
       @foreach($d[1] as $u)
        <tr>
            <td>{{$u->id}}</td>
            <td>{{$u->name}}</td>
            <td>{{$u->email}}</td>
            <th>{{$d[0]}}</th>
        </tr>
      @endforeach()
        
    @endforeach()
    </tbody>
  </table>
@endsection
@push('after_scripts')
   <script type="text/javascript">
    $(document).ready(function() {
        var table = $('.datatable').DataTable();

        $('#newcategory').click(function() {
            
            $('#id').val('');
            $('#longitude').val('');
            $('#latitude').val('');
            $('#diameter').val('');
            $('#exampleModalLabel').val('New Category');
        });
        
        $('.datatable tbody').on( 'click', 'a.edit_button', function () {
            var category = table.row( $(this).parents('tr') ).data();
            console.log( category );

            //$('.dropdown-toggle').dropdown()
            $('#id').val(category[0]);
            $('#longitude').val(category[2]);
            $('#latitude').val(category[3]);  
            $('#diameter').val(category[4]);
        });

        $('#save').click(function(){
          // Use Ajax to submit form data
            
          var editOrNew = $('#exampleModalLabel').val();
          var url = '/admin/location/update';
          if(editOrNew === 'New Category') {
              url = '/admin/location/store';
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