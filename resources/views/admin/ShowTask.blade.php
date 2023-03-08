@extends('includes.master')

@section('css_links')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<style type="text/css">
	.dropdown:hover>.dropdown-menu{
		display: block;
	}
	.select2-container--classic.select2-container--open, .select2-container--default.select2-container--open{
    color: #000000;
    box-shadow: 0 5px 25px rgb(34 41 47 / 10%);


</style>
@section('content')
<!-- BEGIN: Content-->
    <div class="app-content content todo-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
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
            @if(session()->has('status-rejected'))
            <div class="alert alert-danger">
                {{session()->get('status-rejected')}}
            </div>
            @endif
            <style type="text/css">
            html .navbar-floating.footer-static .app-content .content-area-wrapper, html .navbar-floating.footer-static .app-content .kanban-wrapper {

                    margin-top: -97px;
                    margin-left: -108px;
                 }
            </style>


        <div class="content-area-wrapper">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content todo-sidebar">
                        <div class="todo-app-menu">
                            <div class="add-task">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#new-task-modal">
                                    Add Task
                                </button>
                            </div>
                            <div class="sidebar-menu-list">
                                <div class="list-group list-group-filters">
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action active" onclick="refreshpage()">
                                        
                                        <i data-feather="mail" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle"> My Task</span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" id="completed" data-status="1">
                                        <i data-feather="check" class="font-medium-3 mr-50"></i> <span class="align-middle">Completed</span>
                                    </a>
                                     <a href="javascript:void(0)" class="list-group-item list-group-item-action" id="completedi" data-status="0">
                                        <i data-feather="check" class="font-medium-3 mr-50"></i><span class="align-middle">Pending</span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" id="Progress" data-status=-1>
                                        <i data-feather="check" class="font-medium-3 mr-50"></i> <span class="align-middle">Progress</span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" id="reject" data-status=3>
                                        <i data-feather="check" class="font-medium-3 mr-50"></i> <span class="align-middle">Rejected</span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" id="admin" data-status=4>
                                        <i data-feather="check" class="font-medium-3 mr-50"></i> <span class="align-middle">Adim Approval</span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" id="Pause" data-status=5>
                                        <i data-feather="check" class="font-medium-3 mr-50"></i> <span class="align-middle">Pause</span>
                                    </a>
                                </div>
                                <div class="mt-3 px-2 d-flex justify-content-between">
                                    <h6 class="section-label mb-1">Tags</h6>
                                    <i data-feather="plus" class="cursor-pointer"></i>
                                </div>
                                <div class="list-group list-group-labels">
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex align-items-center">
                                        <span class="bullet bullet-sm bullet-primary mr-1"></span>Team
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex align-items-center">
                                        <span class="bullet bullet-sm bullet-success mr-1"></span>Low
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex align-items-center">
                                        <span class="bullet bullet-sm bullet-warning mr-1"></span>Medium
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex align-items-center">
                                        <span class="bullet bullet-sm bullet-danger mr-1"></span>High
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex align-items-center">
                                        <span class="bullet bullet-sm bullet-info mr-1"></span>Update
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="body-content-overlay"></div>
                        <div class="todo-app-list">
                            <!-- Todo search starts -->
                            <div class="app-fixed-search d-flex align-items-center">
                                <div class="sidebar-toggle d-block d-lg-none ml-1">
                                    <i data-feather="menu" class="font-medium-5"></i>
                                </div>
                                <div class="d-flex align-content-center justify-content-between w-100">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="todo-search" placeholder="Search task" aria-label="Search..." aria-describedby="todo-search" />
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle hide-arrow mr-1" id="todoActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical" class="font-medium-2 text-body"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="todoActions">
                                        <a class="dropdown-item sort-asc" href="javascript:void(0)">Sort A - Z</a>
                                        <a class="dropdown-item sort-desc" href="javascript:void(0)">Sort Z - A</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Sort Assignee</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Sort Due Date</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Sort Today</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Sort 1 Week</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Sort 1 Month</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Todo search ends -->

                            <!-- Todo List starts -->
                            <div class="todo-task-list-wrapper list-group">
                                <ul class="todo-task-list media-list" id="todo-task-list">
                                    <div class="abc"></div>
                                    <div class="def">
                                    @foreach($created_task as $task)
                                    <li class="todo-item" >
                                        <div class="todo-title-wrapper">
                                            <div class="todo-title-area">
                                                <i data-feather="more-vertical" class="drag-icon"></i>
                                                <div class="title-wrapper">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                                        <label class="custom-control-label" for="customCheck1"></label>
                                                    </div>
                                                      <span class="text-dark">
                                                        
                                                        {{$task->user_name}}</span>
                                                </div>
                                            </div>
                                            <div class="todo-title-wrapper">
                                            <div class="todo-title-area">
                                                <i data-feather="more-vertical" class="drag-icon"></i>
                                                <div class="title-wrapper">
                                                    <span class="todo-title text-dark">{{$task->title}}</span>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="todo-item-action">
                                                <div class="badge-wrapper mr-1">
                                                    @if($task->task_status ==1)
                        <div class="badge badge-pill badge-success"> completed </div>

                        @elseif($task->task_status ==-1)
                        <div class="badge badge-pill badge-secondary"> Progress </div>
                             
                        @elseif($task->task_status ==3)
                        <div class="badge badge-pill badge-danger"> Rejected</div>
                              
                        @elseif($task->task_status ==0)
                        <div class="badge badge-pill badge-primary"> Pending</div>
                              
                        @elseif($task->task_status==4)
                        <div class="badge badge-pill badge-info">Admin Approval</div>
    
                        @elseif($task->task_status==5)
                        <div class="badge badge-pill badge-blue">Pause</div>
                        @endif
                                                    
                                                </div>
                                                <small class="text-nowrap text-muted mr-1">{{$task->start_date}} To {{$task->end_date}}</small>
                                                <div class="avatar">
                                                    @if($task->image==null)
                                                    <img src="public/app-assets/images/portrait/small/avatar-s-4.jpg" alt="user-avatar" height="32" width="32" />
                                                    @elseif($task->image!=null)
                                                    <img src="{{asset('public/userprofile/' .$task->image)}}" alt="user-avatar" height="32" width="32" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    @endforeach
                                    </div>
                                </ul>
                                <div class="no-results">
                                    <h5>No Items Found</h5>
                                </div>
                            </div>
                            <!-- Todo List ends -->
                        </div>

                        <!-- Right Sidebar starts -->
                        <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
                            <div class="modal-dialog sidebar-lg">
                                <div class="modal-content p-0">
                                    <form id="form-modal-todo" class="todo-modal needs-validation" action="{{route('CreateTask')}}" method="POST">
                                        @csrf
                                        <div class="modal-header align-items-center mb-1">
                                            <h5 class="modal-title">Add Task</h5>
                                            <div class="todo-item-action d-flex align-items-center justify-content-between ml-auto">
                                                <span class="todo-item-favorite cursor-pointer mr-75"><i data-feather="star" class="font-medium-2"></i></span>
                                                <button type="button" class="close font-large-1 font-weight-normal py-0" data-dismiss="modal" aria-label="Close">
                                                    ×
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                            <div class="action-tags">
                                                <div class="form-group position-relative">
                                                    <label for="task-assigned" class="form-label d-block">Assignee</label>
                                                    <select name="empolyee_id" class="form-control">
                                                        @foreach($empolyees as $emp_name)
                                                        <option value="{{$emp_name->id}}">
                                                            {{$emp_name->user_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group position-relative">
                                                    <label for="task-project" class="form-label d-block">Project</label>
                                                    <select name="project_id" id="show_task_projects">
                                                        @foreach ($projects as $items) 
                                                        <option value="{{$items->p_id}}">
                                                           {{$items->p_title}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="todoTitleAdd" class="form-label">Title</label>
                                                    <input type="text" name="title" id="TaskName" class="new-todo-item-title form-control" placeholder="Title" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="task-due-date" class="form-label">Start Date</label>
                                                    <input type="date" name="start_date" class="form-control task-due-date" id="task-due-date">
                                                </div>
                                                <div class="form-group">
                                                    <label for="task-due-date" class="form-label">End Date</label>
                                                    <input type="date" name="end_date" class="form-control task-end-date" id="task-end-date">
                                                </div>
                                                <button style="float: right;" name="submit" class="btn btn-primary">Create Task</button>
                                                <!-- <button>add</button> -->
                                            </div>
                                            
                                        </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                        <!-- Right Sidebar ends -->

                    </div>
                </div>
            </div>
        </div>
    </div>
     <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    <!-- END: Content-->
    @stop
    @section('js_link')
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
<script>
    function refreshpage()
    {
        window.location.reload();
    }
</script>

<script>
    $(document).ready(function(){

        $("#completed,#completedi,#Progress,#reject,#admin,#Pause").on('click',function(){

             var status=$(this).attr('data-status');
             var token=$('#csrf-token').val();
             
            $.ajax({
                type: "post",
              url: "{{route('taskstatus')}}",
              data: {
               "_token":"{{csrf_token()}}",
              status:status,
              
          },
          success: function(response){
                $('.def').empty();
                for(var i=0; i<response.created_task.length; i++)
                {
                    if(response.created_task[i].image==null)
                    {

                        var image="public/app-assets/images/portrait/small/avatar-s-4.jpg";
                    }
                    else
                    {
                        var image="public/userprofile/"+response.created_task[i].image;
                    }
                    if(response.created_task[i].task_status==1)
                    {
                       var complete="Completed";
                       var completed_color="success";                        
                    }
                    else if(response.created_task[i].task_status==0)
                    {
                        var complete="Pending";
                       var completed_color="primary";
                    }
                    else if(response.created_task[i].task_status==3)
                    {
                        var complete="Rejected";
                        var completed_color="danger";
                    }
                    else if(response.created_task[i].task_status==-1)
                    {
                        var complete="Progress";
                        var completed_color="secondary";
                    }
                    else if(response.created_task[i].task_status==4)
                    {
                        var complete="Admin Approval";
                        var completed_color="info";
                    }
                    else if(response.created_task[i].task_status==5)
                    {
                        var complete="p";
                        var completed_color="blue";
                    }
                  $('.def').append(`<li class="todo-item"><div class="todo-title-wrapper"><div class="todo-title-area">
                                                <i data-feather="more-vertical" class="drag-icon"></i>
                                                <div class="title-wrapper">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1" /><label class="custom-control-label" for="customCheck1"></label>
                                                    </div>
                                                      <span class="text-dark">`
                                                        
                                                        +response.created_task[i].user_name+`</span>
                                                </div>
                                            </div>
                                            <div class="todo-title-wrapper">
                                            <div class="todo-title-area">
                                                <i data-feather="more-vertical" class="drag-icon"></i>
                                                <div class="title-wrapper">
                                                    <span class="todo-title text-dark">`
                                                    +response.created_task[i].title+`</span>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="badge badge-pill badge-`+completed_color+`"> `+complete+` </div>
                                            
                                            <small class="text-nowrap text-muted mr-1">`
                                            +response.created_task[i].start_date+
                                            `To`+ response.created_task[i].end_date+`</small>
                                            <div class="avatar">
                                                    <img src="`+image+`" alt="user-avatar" height="32" width="32" />
                                            </div>
                                            </li>`);
                }
              }
            });
      });
    });
</script>
<script>
    $(document).ready(function(){
        $("#show_task_projects").select2({
        	placeholder:'-Select Projects-'
          
        });
        
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

 <!-- BEGIN: Vendor JS-->
    <script src="{{asset('public/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('public/app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/extensions/dragula.min.js')}}"></script>
    <script src="{{asset('public./app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('public/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('public/app-assets/js/scripts/pages/app-todo.js')}}"></script>
    <!-- END: Page JS-->

@stop

