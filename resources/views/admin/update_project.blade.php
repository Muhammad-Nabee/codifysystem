@extends('includes.master')

@section('css_links')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  


@section('content')


<div class="container">
	<div class="row">
		<div class="col">
			<h3 class="text-center bg-success col-md-6">Update Empolyee Projects</h3>
			<form action="{{route('update')}}" method="POST">
				@csrf
				
				<input type="hidden" name="p_id" value="{{$users['p_id']}}">
				
				  	<div class="form-group col-md-6">
				    	<label >Project Title</label>
				    	<input type="text" name="up_title" class="form-control" value="{{$users['p_title']}}">
				  	</div>

				    <div class="form-group col-md-6">
				    	<label >Projects Description</label>
				    	<input type="text" name="up_description" class="form-control" value="{{$users['p_description']}}">
				    </div>

				    <div class="form-group col-md-6">
				    	<label >Total Budget</label>
				    	<input type="text" name="up_budget" class="form-control" value="{{$users['p_budget']}}">
				    </div>

				    <div class="form-group col-md-6">
				    	<label >Empolyee Deadline</label>
				    	<input type="text" class="form-control" name="up_deadline" value="{{$users['p_deadline']}}">
				    </div>
				  <button type="submit" class="btn btn-primary">Update Project</button>
			</form>
		</div>
	</div>
</div>



@stop

@section('js_link')





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>



@stop
