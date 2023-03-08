@extends('includes.master1')

@section('css_links')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col">
			
			@if(Session::has('task'))
    			<div class="alert alert-success">
        		{{Session::get('task')}}
    			</div>
			@endif

			@if(session()->has('taskdeleted'))
   				 <div class="alert alert-danger">
        		{{ session()->get('taskdeleted') }}
	    		</div>
			@endif

			<h3 class="text-center bg-success col-md-6">Update Tasks</h3>
			<form action="{{route('UpdateTasks')}}" method="POST">
				@csrf
				
				<input type="hidden" name="task_id" value="{{$edit_task['task_id']}}">
				
				  	<div class="form-group col-md-6">
				    	<label >Task Title</label>
				    	<input type="text" name="up_title" class="form-control" value="{{$edit_task['title']}}">
				  	</div>

				    <div class="form-group col-md-6">
				    	<label >Task Start Date</label>
				    	<input type="text" name="up_start_date" class="form-control" value="{{$edit_task['start_date']}}">
				    </div>

				    <div class="form-group col-md-6">
				    	<label >Task End Date</label>
				    	<input type="text" name="up_end_date" class="form-control" value="{{$edit_task['end_date']}}">
				    </div>

				  <button type="submit" class="btn btn-primary">Update Task</button>
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





