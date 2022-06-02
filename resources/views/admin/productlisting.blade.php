@extends('admin.includes.app')
@section('content')
  <div class="alert alert-success" style="display:none">
      <strong>Success!</strong> Your category has been saved
    </div>
    <div class="alert alert-danger" style="display:none">
      <strong>Error!</strong> There was some problem in the system.
    </div>
    <div style="width: 15%; margin-bottom: 10px">
        <button type="button" id="newcategory" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal">New Product</button>
    </div>
    <table id="example" class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
        <thead>
            <tr>
                 <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Category_id</th>
                <th>Brand_id</th>
                <!-- <th>Added On</th> -->
                
                
                <th>Options</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Category_id</th>
                <th>Brand_id</th>
                <!-- <th>Added On</th> -->
                <th>Options</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($products as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->description }}</td>
                <td>{{ $c->unit_price }}</td>
                <td>{{ $c->quantity }}</td>
                <td>{{ $c->image }}</td>
                <td>{{ $c->category_id }}</td>
                <td>{{ $c->brand_id }}</td>
                <td><a class="edit_button" href="#" data-toggle="modal" data-target="#exampleModal">Edit</a> | 
                    <a href="" >Quizzes</a>|
        <a href="{{route('delete_product',$c->id)}}" >Delete</a>
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
            <h4 class="modal-title" id="exampleModalLabel">Product</h4>
          </div>
          <div class="modal-body">
            <form id="editcategory">
              {{ csrf_field() }}
              <input type="hidden" id="id" name="id">
              <div class="form-group">
                <label for="name" class="control-label">Product Name:</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
              <div class="form-group">
                <label for="name" class="control-label">Quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity">
              </div>
               <div class="form-group">
                <label  for="image" class="control-label">Image:</label>
                <input type="text" class="form-control" id="image" name="image">
              </div>
              <div class="form-group">
                <label for="name" class="control-label">Price:</label>
                <input type="text" class="form-control" id="price" name="price">
              </div>
              <div class="form-group">
                <label for="status" class="control-label">Category:</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="">Select a Category</option>
                  @foreach ($categories->where('parent_id','!=','') as $category)
                    <option value="{{ $category->id }}">{{ $category->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="status" class="control-label">Brand:</label>
                <select class="form-control" id="brand_id" name="brand_id">
                    <option value="">Select a Brand</option>
                  @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="description" class="control-label">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
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
            $('#price').val('');
            $('#quantity').val('');
            $('#category_id').val('');
            $('#image').val('');
            $('#brand_id').val('');
        $('#exampleModalLabel').val('New Category');
    });
    
    $('.datatable tbody').on( 'click', 'a.edit_button', function () {
        var category = table.row( $(this).parents('tr') ).data();
        console.log( category );

        //$('.dropdown-toggle').dropdown()
        $('#id').val(category[0]);
        $('#name').val(category[1]);
        $('#description').val(category[2]);
        $('#price').val(category[3]);
        $('#quantity').val(category[4]);
        $('#image').val(category[5]);
        $('#category_id').val(category[6]);
        $('#brand_id').val(category[7]);    


        
    });

    $('#save').click(function(){
      // Use Ajax to submit form data
        
      var editOrNew = $('#exampleModalLabel').val();
      var url = '/edit/product';
      if(editOrNew === 'New Category') {
          url = '/create/product';
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