@extends('includes.master')

@section('css_links')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


@section('content')
 <div class="container">
 	<div class="row">
 		<div class="col">
 			<h3 style="background: yellow;" class="text-center p-2">
 				All Task
 			</h3>
 			<table class="table" id="">
 				<thead>
 					<tr>
 						<th>Task Tilte</th>
 					</tr>
 				</thead>
 				<tbody>
 					@foreach($project_task as $task_title)
 					<tr>
 						<td>{{$task_title->title}}</td>
 					</tr>
 					@endforeach
 				</tbody>
 			</table>
 		</div>
 	</div>
 </div>


















@stop

@section('js_link')



<script type="text/javascript">
	$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>



@stop