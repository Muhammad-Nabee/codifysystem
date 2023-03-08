@extends('includes.master')

@section('css_links')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">



@section('content')

<!-- Modal -->
@if(Session::has('add_employees'))
         <div class="alert alert-success">
        {{ Session::get('add_employees')}}
        </div>
    @endif

<div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="card">

                <div class="card-header">

                    <h4 class="card-title">Add Employee </h4>

                </div>
          
            
                


                <div class="card-body">

                    <form class="form form-horizontal" action = "{{route('add_employees')}}" method = "POST">

                        @csrf

                        <input type="hidden" name = "role" value = "2">

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

                                            <input type="text" id="fname-icon" class="form-control" name="username" placeholder="User Name" / required="">
                                            <!-- <span style="color:red;margin-top:10px;margin-top: 20px;position: absolute;margin-left: -125px;">@error('username'){{$message}}@enderror</span> -->

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

                                            <input type="email" id="email-icon" class="form-control" name="email" placeholder="Email" / required="">

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

                                            <input type="number" id="contact-icon" class="form-control" name="contact" placeholder="Mobile" / required="">

                                            
                                        </div>

                                    </div>

                                </div>

                            </div>


                            
                            <div class="col-12">

                                <div class="form-group row">

                                    <div class="col-sm-3 col-form-label">

                                        <label for="contact-icon">Salary</label>

                                    </div>

                                    <div class="col-sm-9">
                                    <label for="">Fix</label>
                                        <input type="radio" onclick="show()" name="fix" value='1' >
                                        &nbsp;&nbsp;&nbsp;
                                        <label for="">Hourly</label>
                                        <input type="radio" onclick="show()"  name="fix" value='0'>
                            
                                        <div class="input-group input-group-merge"  style="visibility: hidden" id='fix'>

                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i data-feather="dollar-sign"></i></span>

                                            </div>

                                            <input type="number" id="contact-icon" class="form-control" name="salary" placeholder="Salary" / required="">

                                            
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-9 offset-sm-3">

                                <button type="submit" class="btn btn-primary mr-1">Add Employee</button>

                                <button type="reset"  onclick="clean()" class="btn btn-outline-secondary">Reset</button>

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

                    <h4 class="card-title">Edit Employee</h4>

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

                                <button type="submit" class="btn btn-primary mr-1">Edit Employee</button>

                                <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>     
            @if(session()->has('check_email'))
                <div class="alert alert-danger">
                {{ session()->get('check_email') }}
                </div>
            @endif                   

<section id="responsive-datatable">

    <div class="row">

        <div class="col-12">

            <div class="card">

                <div class="card-header border-bottom">

                    <h4 class="card-title">Users</h4>

                </div>

                <div class="card-header border-bottom">

                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#inlineForm">

                        Add Employee

                    </button>

                    @if(session('msg'))

                    <div class="alert alert-primary" role="alert">

                        <p> {{session('msg')}} </p>

                    </div>  

                @endif

                </div>

                <div class="card-datatable">

                    <table class="dt-responsive table" id = "show_users" >

                        <thead>

                            <tr>

                                <th></th>
                                <th>Emp_id</th>

                                <th>User Name</th>

                                <th>Email</th>

                                

                                <th>Register Date</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($employees as $emp)

                            <tr>
                           
                                <td></td> 
                                <td><a href="{{route('emp_view',['id'=>$emp->id])}}">{{$emp->gen_id}}</a></td>

                                <td>{{$emp->user_name}}</td>

                                <td>{{$emp->email}}</td>  
                                <?php
                                $created_at = strtotime($emp->created_at);
                                $date=date('d-M-Y', $created_at);
                                ?>
                                <td>{{$date}}</td>
                                <td>

                                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#edit_model" 

                                    onClick = "on_user_edit( 

                                         {{$emp->id}},

                                        '{{$emp->user_name}}',

                                        '{{$emp->email}}',

                                        '{{$emp->phone}}',

                                        '{{$emp->password}}',

                                        '{{$emp->name}}' )">

                                    Edit Empolyee

                                    </button> <a class="btn btn-sm btn-outline-primary" href="delete_user/{{$emp->id}}">Delete</a>
                                    </button> <a class="btn btn-sm btn-outline-primary" href="show_month/{{$emp->id}}">Salary</a></td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>

@stop

@section('js_link')

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<script> 

$(document).ready( function () {

    $('#show_users').DataTable();

} );

function on_user_edit(id,username,email,phone,password,role){

      document.getElementById('id').value = id;

      document.getElementById('edit_username').value = username;

      document.getElementById('edit_email').value = email;

      document.getElementById('edit_contact').value = phone;

      document.getElementById('edit_password').value = password;

      

      if(role == 'Employee')

      {

        document.getElementById('edit_role').selectedIndex = "1";

      }

}

</script>
<script type=text/javascript>
function show(){
document.getElementById('fix').style.visibility='visible';
}

</script>
<script>
    function clean(){
document.getElementById('fix').style.visibility='hidden';

}

</script>




@stop

