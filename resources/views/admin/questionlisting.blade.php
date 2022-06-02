@extends('layouts.adminlisting')

@section('page_title')
{{ $quiz->name }} Questions
@endsection

@section('page_description', '')

@section('content')
    <div class="alert alert-success fade" style="display:none">
      <strong>Success!</strong> Your question has been saved
    </div>
    <div class="alert alert-danger fade" style="display:none">
      <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
    </div>
    <div style="width:15%;float:left;margin-bottom: 10px">
        <button type="button" id="newquestion" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal">New Question</button>
    </div>
<div style="width: 15%;float:left; margin-bottom: 10px;margin-left:5px">
        <button type="button" id="importquestions" class="btn btn-block btn-success" data-toggle="modal" data-target="#importmodal">Import Questions</button>
    <br/>
    <p style="color:red">{{$errors->first('file')}}</p>
    </div>
<br/><br/><br/><br/>
    
    <table id="example" class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th width="20%">Question</th>
                <th>Option 1</th>
                <th>Option 2</th>
                <th>Option 3</th>
                <th>Option 4</th>
                <th>Answer</th>
                <th>Status</th>
                <th>Added On</th>
                <th>Options</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Option 1</th>
                <th>Option 2</th>
                <th>Option 3</th>
                <th>Option 4</th>
                <th>Answer</th>
                <th>Status</th>
                <th>Added On</th>
                <th>Options</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ $question->title }}</a></td>
                <td>{{ $question->option1 }}</td>
                <td>{{ $question->option2 }}</td>
                <td>{{ $question->option3 }}</td>
                <td>{{ $question->option4 }}</td>
                <td>{{ $question->correct_answer }}</td>
                <td>{{ $question->status }}</td>
                <td>{{ date('Y-m-d', strtotime($question->created_at)) }}</td>
                <td><a class="edit_button" href="#" data-toggle="modal" data-target="#exampleModal">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>



















    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Edit Question</h4>
          </div>
          <div class="modal-body">
            <form id="editquestion">
              {{ csrf_field() }}
              <input type="hidden" id="id" name="id">
              <input type="hidden" id="quiz_id" name="quiz_id" value="{{ $quiz->id }}">
              <div class="form-group">
                <label for="title" class="control-label">Question:</label>
                <textarea class="form-control" id="title" name="title"></textarea>
              </div>
              <div class="form-group">
                <label for="option1" class="control-label">Option 1:</label>
                <input type="text" class="form-control" id="option1" name="option1">
              </div>
              <div class="form-group">
                <label for="option2" class="control-label">Option 2:</label>
                <input type="text" class="form-control" id="option2" name="option2">
              </div>
              <div class="form-group">
                <label for="option3" class="control-label">Option 3:</label>
                <input type="text" class="form-control" id="option3" name="option3">
              </div>
              <div class="form-group">
                <label for="option4" class="control-label">Option 4:</label>
                <input type="text" class="form-control" id="option4" name="option4">
              </div>
              <div class="form-group">
                <label for="correct_answer" class="control-label">Correct Option:</label>
                <select class="form-control" id="correct_answer" name="correct_answer">
                  <option value="">Select an Option</option>
                  <option value="1">Option 1</option>
                  <option value="2">Option 2</option>
                  <option value="3">Option 3</option>
                  <option value="4">Option 4</option>
                </select>
              </div>
              <div class="form-group">
                <label for="status" class="control-label">Status:</label>
                <select class="form-control" id="status" name="status">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>
            </form>
          </div>
            <div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save" data-dismiss="modal">Save Question</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('cvs-form')
<div class="modal fade" id="importmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title" >Upload Qusetions File</h4>
          </div>
          <div class="modal-body">
              <form id="uploadfile_form" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  
                  <input type="hidden" id="id" name="id"/>  
              <input type="hidden" id="quiz_id" name="quiz_id" value="{{ $quiz->id }}"> 
              <div class="form-group">
                <label for="title" class="control-label">Upload CSV File</label>
**csv max 1000 rows
                                  
              </div>
                <div>
                <input type="file" name="file" value="Choose file" id="file"/>
                </div>
                   <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <input type="button" class="btn btn-success" id="savefile" name="upload" value="Upload"/>
          </div>
              </form>
            
          </div>
         
        </div>
      </div>
    </div>


@endsection

@section('page-js-script')
<script type="text/javascript">
$(document).ready(function() {
    var table = $('.datatable').DataTable();

    $('#newquestion').click(function() {
        $('#id').val('');
        $('#title').val('');
        $('#option1').val('');
        $('#option2').val('');
        $('#option3').val('');
        $('#option4').val('');
        $('#correct_answer').val('');
        $('#status').val('');
        $('#exampleModalLabel').val('New Question');
    });
    
    $('.datatable tbody').on( 'click', 'a.edit_button', function () {
        var question = table.row( $(this).parents('tr') ).data();
        console.log( question );

        //$('.dropdown-toggle').dropdown()
        $('#id').val(question[0]);
        $('#title').val(question[1]);
        $('#option1').val(question[2]);
        $('#option2').val(question[3]);
        $('#option3').val(question[4]);
        $('#option4').val(question[5]);
        $('#correct_answer').val(question[6]);
        $('#status').val(question[7]);
    });

    $('#save').click(function(){
      // Use Ajax to submit form data
        
      var editOrNew = $('#exampleModalLabel').val();
      var url = '/admin/question/savefile';
      if(editOrNew === 'New Question') {
          url = '/admin/question/new';
      }
      $.ajax({
          url: url,
          type: 'POST',
          data: $('#editquestion').serialize(),
          
          success: function(result) {
              // ... Process the result ...
              if(result.status == 'success')
              {
                $('.alert-success').show();
                $('.alert-success').addClass("in");
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
    // uploading file using Ajax
    $('#savefile').click(function(){
      
      var url = '/admin/csvquestion/new';
      //var formData = new FormData($('#uploadfile_form')[0]);

        data = {
            "_token": "{{ csrf_token() }}",
            "file": new FormData($('uploadfile_form')[0])
        };
      
       $.ajax({
        // Your server script to process the upload
        url: url,
        type: 'POST',

        // Form data
        data: {
            "_token": "{{ csrf_token() }}",
            "file": new FormData($('uploadfile_form')[0])
        },

        // Tell jQuery not to process data or worry about content-type
        // You *must* include these options!
        cache: false,
        contentType: false,
        processData: false,

        // Custom XMLHttpRequest
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) {
                // For handling the progress of the upload
                myXhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        $('progress').attr({
                            value: e.loaded,
                            max: e.total,
                        });
                    }
                } , false);
            }
            return myXhr;
        },
    }); 
        
      /*$.ajax({
          url: url,
          type: 'POST',
          data: $('#uploadfile_form').serialize(),
          success: function(data) {
              // ... Process the result ...
              if(FormData.status == 'success')
              {
                $('.alert-success').show();
                $('.alert-success').addClass("in");
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
        */
    })
    

});
</script>
@endsection