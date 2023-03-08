@extends('includes.master')

@section('css_links')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  


@section('content')

<!-- Modal -->

<div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="card">

                <div class="card-header">

                    <h4 class="card-title">Add Project</h4>

                </div>

                <div class="card-body">

                    <form class="form form-horizontal" action = "{{route('projects')}}" method = "POST">

                        @csrf

                        <input type="hidden" name = "role" value = "3">

                        <div class="row">

                            <div class="col-12">

                                <div class="form-group row">

                                    <div class="col-sm-3 col-form-label">

                                        <label for="fname-icon">Title</label>

                                    </div>

                                    <div class="col-sm-9">

                                        <div class="input-group input-group-merge">
                                            <input type="text" id="fname-icon" class="form-control" name="p_title" placeholder="project Title" />

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-12">

                                <div class="form-group row">

                                    <div class="col-sm-3 col-form-label">

                                        <label for="email-icon">Deadline</label>

                                    </div>

                                    <div class="col-sm-9">

                                        <div class="input-group input-group-merge">
                                            <input type="date" id="email-icon" class="form-control" name="p_deadline" />

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-12">

                                <div class="form-group row">

                                    <div class="col-sm-3 col-form-label">

                                        <label for="contact-icon">Budget</label>

                                    </div>

                                    <div class="col-sm-9">

                                        <div class="input-group input-group-merge">
                                            <input type="number" id="contact-icon" class="form-control" name="p_budget" />

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-12">

                                <div class="form-group row">

                                    <div class="col-sm-3 col-form-label">

                                        <label for="pass-icon">Description</label>

                                    </div>

                                    <div class="col-sm-9">

                                        <div class="input-group input-group-merge">
                                            <textarea class="form-control ckeditor" name="p_description" id="exampleFormControlTextarea1" rows="3"></textarea>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            

                            <div class="col-sm-9 offset-sm-3">

                                <button type="submit" class="btn btn-primary mr-1">Add Project</button>

                                <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Edit Modal -->

<div class="modal fade text-left" id="edit_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="card">

                <div class="card-header">

                    <h4 class="card-title">Edit Client</h4>

                </div>

                <div class="card-body">

                    <form class="form form-horizontal" action = "edit_user_form" method = "POST">

                        @csrf

                        <input type="hidden" value = "123" id = "id" name = 'id'>

                        <div class="row">

                            <div class="col-12">

                                <div class="form-group row">

                                    <div class="col-sm-3 col-form-label">

                                        <label for="fname-icon">First Name</label>

                                    </div>

                                    <div class="col-sm-9">

                                        <div class="input-group input-group-merge">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i data-feather="user"></i></span>

                                            </div>

                                            <input type="text" id="edit_username" class="form-control" name="edit_username" placeholder="User Name" />

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-12">

                                <div class="form-group row">

                                    <div class="col-sm-3 col-form-label">

                                        <label for="email-icon">Email</label>

                                    </div>

                                    <div class="col-sm-9">

                                        <div class="input-group input-group-merge">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i data-feather="mail"></i></span>

                                            </div>

                                            <input type="email" id="edit_email" class="form-control" name="edit_email" placeholder="Email" />

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-12">

                                <div class="form-group row">

                                    <div class="col-sm-3 col-form-label">

                                        <label for="contact-icon">Mobile</label>

                                    </div>

                                    <div class="col-sm-9">

                                        <div class="input-group input-group-merge">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i data-feather="smartphone"></i></span>

                                            </div>

                                            <input type="number" id="edit_contact" class="form-control" name="edit_contact" placeholder="Mobile" />

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-12">

                                <div class="form-group row">

                                    <div class="col-sm-3 col-form-label">

                                        <label for="contact-icon">Password</label>

                                    </div>

                                    <div class="col-sm-9">

                                        <div class="input-group input-group-merge">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i data-feather="smartphone"></i></span>

                                            </div>

                                            <input type="text" id="edit_password" class="form-control" name="edit_password" placeholder="Mobile" />

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-12">

                                <div class="form-group row">

                                    <div class="col-sm-3 col-form-label">

                                        <label for="contact-icon">Role</label>

                                    </div>

                                    <div class="col-sm-9">

                                        <div class="input-group input-group-merge">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i data-feather="smartphone"></i></span>

                                            </div>

                                            <select name="edit_role" id="edit_role" class = "form-control">

                                                <option value="1">Admin</option>

                                                <option value="2">Employee</option>

                                                <option value="3">Client</option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-9 offset-sm-3">

                                <button type="submit" class="btn btn-primary mr-1">Edit Client</button>

                                <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>                        

<section id="responsive-datatable">

    <div class="row">

        <div class="col-12">

            <div class="card">

                <div class="card-header border-bottom">

                    <h4 class="card-title">Users</h4>

                </div>

                <div class="card-header border-bottom">

                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#inlineForm">
                    Add Projects
                    </button>
                </div>
                
                </div>

                <div class="card-datatable">
                	@if(session('statuss'))
                	<h6 class="alert alert-success">{{session('statuss')}}</h6>

                	@endif
                    @if(session('statusdelete'))
                    <h6 class="alert alert-warning">{{session('statusdelete')}}</h6>

                    @endif
                    @if(session('statusupdate'))
                    <h6 class="alert alert-primary">{{session('statusupdate')}}</h6>

                    @endif

                    <table class="dt-responsive table" id = "myTable" >

                        <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Assign To</th>
                                <th>Desc</th>
                                <th>Deadline</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                           @foreach($projects as $project)

                            <tr>
                                <td>{{$project->p_title}}</td>
                                 <!-- <td><button type="button" id="show{{$project->p_id}}" data-toggle="modal" data-target="#exampleModal{{$project->p_id}}"> <i class="fas fa-plus-square text-success"></i></button>
                                    <a id="" href="{{route('assigprojectnempolyee',$project->p_id)}}"><i class="fas fa-plus-square text-success"></a>
                                 </td> --> 
                                 <td><a id="" href="{{route('assigprojectnempolyee',$project->p_id)}}"><i class="fas fa-plus-square fa-lg text-success"></a></td>
                                   
                                <td><a href="#" class="show" data_des="{{$project->p_description}}" data-toggle="modal">show</a></td>
                                <td>{{$project->p_deadline}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                  
                                        </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item " href="edit/{{$project->p_id}}">Edit</a>
                                            <a class="dropdown-item " href="destroy_projects/{{$project->p_id}}">Delete</a>
                                            <a class="dropdown-item" href="{{route('TaskTitle',$project->p_id)}}">Show Title</a>
                                         </div>
                                    </div>
                                </td>

                            </tr>
                             <!-- modal project -->
                    <div class="modal fade text-left" id="exampleModal{{$project->p_id}}"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">


                            <div class="modal-dialog modal-dialog-centered" role="document">

                                <div class="modal-content">


                                    <div class="card">

                                        <div class="card-header">

                                            <h4 class="card-title">Project Assign To Employee </h4>

                                        </div>

                                        <div class="card-body">
                                            <form action="{{route('emp_store')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                            <input type="" value="{{$project->p_id}}" name="project_id" hidden="">
                                                  <div class="row">
                                                        <div class="col">
                                                            <label>Empolyee Name</label>
                                                            <select style="width: 215px;height: 35px;border-radius: 5px;" name="emp_name"id="">
                                                                @foreach ( $emp as $row)

                                                                 <option value="{{ $row->id }}"> 
                                                                {{ $row->user_name }} 
                                                                </option>
                                                                @endforeach 
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <label>Empolyee Deadline</label>
                                                            <input type="date" name="emp_deadline" class="form-control" >
                                                        </div>
                                                        
                                                        

                                                  </div>
                                                  <!-- row ended here -->
                                                  <div class="row">
                                                      <div class="col">
                                                          @foreach($emp_show as $row)
                                                          <li>
                                                           
                                                          {{$row->emp_name}}
                                                          </li>
                                                          

                                                          @endforeach
                                                         
                                                      </div>
                                                  </div>

                                                  <div class="row mt-5 ">
                                                    <div class="col">
                                                        <button style="float: right;" type="submit" class="btn btn-primary">Assign</button>
                                                        
                                                    </div>
                                                      
                                                  </div>
                                                  
                                                      
                                                    
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                    </div>
                   
                        <!--end-->
                            @endforeach

                           

                        </tbody>

                    </table>
                   

                  

                    <!-- modal start here -->
                     <div id="myModal" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
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
                    <!-- modal ended here -->

                </div>

            </div>

        </div>

    </div> 

</section>

@stop

@section('js_link')

<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script> -->

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



@stop

