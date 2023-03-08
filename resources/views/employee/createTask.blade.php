@extends('includes.master1')

@section('css_link')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<style type="text/css">
	.dropdown:hover>.dropdown-menu{
		display: block;
	}
</style>
@section('content')

<section id="dashboard-ecommerce">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Create Task</button>
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
	@if(session()->has('taskupdate'))
	<div class="alert alert-success">
		{{ session()->get('taskupdate') }}
	</div>
	@endif
	@if(session()->has('Admin Approval'))
	<div class="alert alert-success">
		{{session()->get('Admin Approval')}}
	</div>
	@endif             
	
	<table class="table table-striped table-bordered" id="myTable">
		<thead>
			<tr>
				<th>Task Title</th>
				<th>Start_Date</th>
				<th>End_Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		    @if(isset($data))
			@foreach($data as $task)
			<tr>
			<td><a href="#" class="show" data_des="{{$task->title}}" data-toggle="modal">show</a></td>
				<td>{{$task->start_date}}</td>
				<td>{{$task->end_date}}</td>
				@if($task->task_status==1)
				<td class="bg-success text-center text-white">
					Complete
				</td>
				@elseif($task->task_status==-1)
				<td class="bg-info text-center text-white">
					Progress
				</td>
				@elseif($task->task_status==3)
				<td class="bg-danger text-center text-white">
					Rejected
				</td>
				@elseif($task->task_status==0)
				<td class="bg-primary text-center text-white">
					panding			
				</td>
				@elseif($task->task_status==4)
				<td class="bg-secondary text-center text-white">
					Admin Approval
				</td>
				@elseif($task->task_status==5)
				<td class="bg-warning text-center text-white">
					Pause
				</td>
				@endif
				<td>
					@if($task->task_status !=3)
					<div class="dropdown">
						<button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
							<i data-feather="more-vertical"></i>
							
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item " href="show_tasks/{{$task->task_id}}">
							<i data-feather="edit-2" class="mr-50"></i>
							<span>Edit</span>
						</a>
						
						<a class="dropdown-item" href="{{route('change_status_progres',$task->task_id)}}">
							<i class="fas fa-spinner" class="mr-50"></i>
							<span>Progress</span>
						</a>
						
						<a class="dropdown-item" href="{{route('change_status_pause',$task->task_id)}}">
							<i class="fa fa-pause" class="mr-50"></i>
							<span>Pause</span>
						</a>
					
						<a class="dropdown-item" href="{{route('change_status_approval',$task->task_id)}}">
							<i class="fas fa-vote-nay" class="mr-50"></i>
							<span>Admin Approval</span>
						</a>
					</div>
				</div>
				@elseif($task->task_status ==3)
						<button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
						<i data-feather="more-vertical"></i>
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item " href="show_tasks/{{$task->task_id}}">
							<i data-feather="edit-2" class="mr-50"></i>
							<span>Edit</span>
							</a>
						</div>
							
				@endif
			</td>
		</tr>
		@endforeach
		@endif
	</tbody>
</table>


<!-- modal start here -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="{{route('employeeTask')}}" method="post">
					@csrf
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label>Projects</label>
								
								<select class="form-control" name="p_id">
								    <option>--Select Task--</option>
									@foreach($p_array as $item) 
									<option value="{{$item['p_id']}}">
										{{$item['title']}}
									</option>
									
									@endforeach
								</select>
								
							</div>
							
						</div>
						
						<div class="col-6">
							
							<div class="form-group">
								<label for="TaskName">Task Name</label>
								<input type="text" name="task_name" class="form-control"  id="TaskName">
							</div>
						</div>	
					</div>
					
					<div class="row">
						<div class="col-6">
							
							<div class="form-group">
								<label for="task_start_date">Start Date</label>
								<input type="date" name="task_start_date" class="form-control" id="task_start_date">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="task_end_date">End Date</label>
								<input type="date" name="task_end_date" class="form-control" id="task_end_date">
							</div>
						</div>
					</div>
					<div class="row">
						<input type="" name="empolyee_id" hidden="">
						<div class="col-md-8 offset-md-2">
							
							</div>
						</div>
						
						<button style="float: right;" type="submit" class="btn btn-primary">Create Task</button>
					</form>
					
				</div>
			</div>
		</div>
	</div>
	<!-- modal ended here -->
	
	
</section>

<div id="myModal" class="modal fade" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header bg-light" style="background:lightblue !important;">
                              <h4 class="modal-title"><b>Title</b></h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body description">
                              empty function uses
                            
                              </div>
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
<script>
	$(document).ready( function () {
		$(document).on('click','#show',function(){
			var des=$(this).attr('data_des');
			
		});
	});
</script>

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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<script src="{{asset('public/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>

<script src="{{asset('public/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>



@stop
