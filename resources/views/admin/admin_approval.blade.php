@extends('includes.master')

@section('css_links')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<style type="text/css">
	.dropdown:hover>.dropdown-menu{
        display: block;
	}
    </style>
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            @if(session()->has('taskupdate'))
            <div class="alert alert-success">
				{{ session()->get('taskupdate') }}
			</div>
			@endif
			@if(session()->has('status-rejected'))
			<div class="alert alert-danger">
                {{session()->get('status-rejected')}}
			</div>
			@endif
			<table id="table_id" class="table table-bordered" id="myTable">
                <thead>
                    <tr class="text-center">
                        <th>User Name</th>
                        <th>Title</th>
			            <th>Start Task Date</th>
			            <th>Task Time</th>
			            <th>Status</th>
			            <th>Action</th>
			        </tr> 
			    </thead>
			    <tbody>
					@foreach($user_total as $task)
			    	<tr class="text-center">

                        <td>{{$task['user_name']}}</td>
                        <td><a href="#" class="show" data_des="{{$task['title']}}" data-toggle="modal">show</a></td>
                        <td>{{$task['start_date']}}</td>
                        <td>{{$task['total']}}</td>
			    		
			    		@if($task['task_status']==3)
			    		<td class="bg-danger text-center text-white">
                            Rejected  
			    		</td>
						@elseif($task['task_status']==4)
                        <td class="bg-secondary text-center text-white">
                            Admin Approval
                        </td>
                        @endif
			    		
						<td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                    <i data-feather="more-vertical"></i>
									
								</button>
								<div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('change__status_completed',$task['task_id'])}}">
                                        <i class="fad fa-clipboard-list-check" class="mr-50"></i>
                                        <span>Approved</span>
                                        
                                    </a>
                                    <a class="dropdown-item" href="{{route('change__status_rejected',$task['task_id'])}}">
                                        <i class="fas fa-times-circle" class="mr-50"></i>
                                        <span>Rejected</span>
                                    </a>
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>
        </div>
          </div>
        </div>
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

@stop
