@extends('includes.master')

@section('css_links')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<style type="text/css">
  .select2-container--classic.select2-container--open, .select2-container--default.select2-container--open{
    color: #000000;
    box-shadow: 0 5px 25px rgb(34 41 47 / 10%);

  }
</style>
  


@section('content')



<div class="container">
	<div class="row">
		<div class="col">
			<form action="{{route('project_assign_employee')}}" method="POST" enctype="multipart/form-data">
        

        <h3 style="background: #eaeac2; padding: 15px;text-align: center;border-radius: 5px;">Projects Assign To Empolyee</h3>
                                      @if(Session::has('pro_assign'))
                                        <div class="alert alert-danger">
                                        {{ Session::get('pro_assign')}}
                                        </div>
                                      @endif
                                                @csrf
                                            <input type="" value="{{$id}}" name="project_id" hidden="">
                                            <div class="row">
                                                <div class="col-4">

                                                    <label>Empolyee</label>
                                                      <select class="form-control" style="width: 215px;height: 35px;border-radius: 5px;" name="emp_name"id="user_search">
                                                         @foreach ( $empolyee as $emp)
                                                         <option></option>
                                                          <option  value="{{ $emp->id }}"> 
                                                            {{ $emp->user_name }} 
                                                          </option>
                                                          @endforeach 
                                                       </select>
                                                  </div>

                                                  <div class="col-4">
                                                    <label>Assign Date</label>
                                                    <input type="date" name="assign_date" class="form-control"required >
                                                  </div>
                                                  <div class="col-4">
                                                    <label>Deadline</label>
                                                      <input type="date" name="deadline_date" class="form-control"required >
                                                  </div>
                                            </div>
                                                  
                                                  

                                            <div class="row mt-5">
                                              <div class="col-md-12 text-center">
                                                <button  type="submit" class="btn btn-lg btn-primary">Assign</button>
                                                        
                                              </div>
                                                      
                                            </div>
                                                  
                                                      
                                                    
                                            </form>

			
		</div>
	</div>
  <div class="row">
    <div class="col">
      <table class="table table-hover table-bordered table-striped mt-2">
        @if(Session::has('ass_emp_delete'))
        <div class="alert alert-danger mt-2">
        {{ Session::get('ass_emp_delete')}}
        </div>
        @endif
        <thead>
          <tr>
          <th>Employee Name</th>
          <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($emp_name as $empname)
          <tr>
            <td>{{$empname['name']}}</td>
            <!-- <td><img class="img-fluid rounded" src="{{asset('public/image/'.$empname['image']) }}" width="70" height="70" /></td> -->
            <td><a class="btn btn-primary" href="{{route('assign_empolyee_delete',$empname['assign_id'])}}">Delete</a></td>
          </tr>
          @endforeach
        </tbody>
        
      </table>
      
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $("#user_search").select2({
          placeholder:'-Select Employee-'
        });
        
    });
</script>



@stop
