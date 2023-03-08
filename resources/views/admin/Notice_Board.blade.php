@extends('includes.master')

@section('css_links')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@section('content')
<style type="text/css">
  
</style>
  <div class="container">
    <div class="row">
      <div class="col">
        <h3><a  href="{{route('Notice_Board')}}" class="btn btn-primary float-right"  data-toggle="modal" data-target="#add_notice"><i class="fal fa-plus"> Add New Notice</i> </a>
        </h3>
        
      </div>
    </div><!-- row ended here -->
    <div class="row">
      <div class="col">
        
        @if(session()->has('add_notice'))
            <div class="alert alert-success mt-2 float-right">
            {{ session()->get('add_notice') }}
            </div>
        @endif
        @if(session()->has('dele_notice'))
            <div class="alert alert-danger mt-2">
            {{ session()->get('dele_notice') }}
            </div>
        @endif
        @if(session()->has('Up_Notice'))
            <div class="badge badge-warning mt-2">
            {{ session()->get('Up_Notice') }}
            </div>
        @endif
        


              <div class="modal fade" id="add_notice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Notice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{route('add_new_notice')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                          <label for="" class="col-sm-2 col-form-label">Title</label>
                                          <div class="col-sm-10">
                                            <input type="text" name="notice" class="form-control" placeholder="Title">
                                          </div>
                                        </div>

                                        <div class="form-group  row">
                                          <label for="" class="col-sm-2 col-form-label">Designation</label>

                                          <div class="col-sm-10">
                                                <input type="radio" class="btn-check" name="desiniation" value="Empolyee" id="male" >
                                                <label style="margin-left: 10px;"  for="male">Empolyee</label>

                                                <input style="margin-left: 10px;" type="radio" class="btn-check" name="desiniation" id="female" value="Client" >
                                                <label style="margin-left: 10px;"  for="female">Client</label>
                                          </div>

                                        </div>

                                        <div class="form-group row">
                                          <label for="" class="col-sm-2 col-form-label">Description</label>
                                          <div class="col-sm-10">
                                            <textarea  id="editor" class="tinymce-editor" name="description"></textarea>
                                          </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>

                                      </form>
                                    </div>
                              <div class="modal-footer">
                                
                              </div>
                    </div>
                </div>
            </div>

                <div class="card-datatable">

                    <table class="dt-responsive table" id = "show_notification" >

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>To</th>
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>
                          @foreach($Notice_show as $noti )
                            <tr>
                              <td>{{$noti->notifi_id}}</td>
                              <td>{{$noti->notice}}</td>
                               <td>{{date('Y-m-d',strtotime($noti->created_at))}}</td>
                               <td><a href="#" class="show" data_des="{{$noti->description}}" data-toggle="modal">show</a></td>
                                <td>{{$noti->desiniation}}</td>

                                <td>
                                  <div class="dropdown">
                                      <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                      </button>

                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{route('edit_notice',$noti->notifi_id)}}">Edit</a>
                                        <a class="dropdown-item" href="{{route('delete_notice',$noti->notifi_id)}}">Delete</a>
                                      </div>
                                  </div>
                              </td>

                            </tr>
                            @endforeach()

                            

                        </tbody>

                    </table>

                </div>
                <!--notice description modal start here -->
                     <div id="myModal" class="modal fade" tabindex="-1">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header bg-light" style="background:#ffa500;">
                              <h5 class="modal-title">Description</h5>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body description">
                              empty function uses
                            
                              </div>
                            </div>
                          </div>
                      </div> 
                    <!--notice description modal ended here -->
        
      </div>
      
    </div>
    
  </div>


@stop

@section('js_link')
<script src="https://cdn.ckeditor.com/4.16.2/basic/ckeditor.js"></script>
<script>
  $(document).ready( function () {

    $('#show_notification').DataTable();

} );
</script>
<script>
    CKEDITOR.replace('editor', {
      height: 150,
      removeButtons: 'PasteFromWord'
    });
  </script>
<!-- code for ckeditor -->
<!-- <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script> -->
<!-- code for show modal of description -->
<script>
    $(document).ready(function(){
        $(".show").click(function(){
      var desc=$(this).attr('data_des');   
      $('.description').empty();
      $('.description').append(`<table class="table">
              <td>`+desc+`</td>
              </table>`);
            $("#myModal").modal('show');
        });
    });
</script>

<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
code for summernote editor
<script type="text/javascript">
    $('#editor').summernote({
        height: 200
    });
</script>
 -->


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

@stop