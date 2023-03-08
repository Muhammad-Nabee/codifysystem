@extends('includes.master')

@section('css_links')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style type="text/css">
  
</style>
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-8 border mx-auto">
				<form action="{{route('update_notice')}}" method="POST">
					<input type="hidden" name="notifi_id" value="{{$Edit_Notice->notifi_id}}">
          			@csrf
					  <div class="form-group">
					    <label class="py-2">Notice</label>
					    <input type="text" class="form-control" value="{{$Edit_Notice->notice}}" name="up_notice">
					  </div>

					    <div class="form-group">
                                          <label for="" class="col-sm-2 col-form-label">Designation</label>
                                          <div class="col-sm-10">
                                     <input type="radio" name="up_desiniation" class="btn-check" value="Empolyee" {{$Edit_Notice->desiniation == 'Empolyee' ? 'checked' : '' }}>
                                                <label style="margin-left: 10px;"  for="male">Empolyee</label>

                                                <input style="margin-left: 10px;" name="up_desiniation" value="Client" type="radio" class="btn-check" {{$Edit_Notice->desiniation == 'Client' ? 'checked' : '' }}>
                                                <label style="margin-left: 10px;"  for="female">Client</label>
                                          </div>

                                          <label class="py-2">Description :</label>
                                          
                                          <div class="row mx-auto">
                                            <textarea  id="editor" name="up_description" value="" >{!!$Edit_Notice->description!!}</textarea>
                                          </div>

                            </div>
                            
                                  <button type="submit" class="btn btn-primary float-right">Update</button>
				</form>
				
			</div>
			
		</div>
		
	</div>
  


@stop

@section('js_link')
 <script src="https://cdn.ckeditor.com/4.16.2/basic/ckeditor.js"></script> 

<script>
    CKEDITOR.replace('editor', {
      height: 150,
      width: 1000,
      removeButtons: 'PasteFromWord'
    });
  </script>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

@stop