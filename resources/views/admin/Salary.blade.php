@extends('includes.master')
@section('css_links')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@section('content')
@if(session()->has('sal_generate'))
	<div class="alert alert-success">
		{{ session()->get('sal_generate') }}
	</div>
@elseif(session()->has('already_generate'))
	<div class="alert alert-danger">
		{{ session()->get('already_generate') }}
	</div>
@endif
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-test-tab" data-toggle="tab" href="#nav-test"
            role="tab" aria-controls="nav-test" aria-selected="false">Hourly</a>
            <a class="nav-link" id="nav-inprogress-tab" data-toggle="tab"
            href="#nav-inprogress" role="tab" aria-controls="nav-inprogress"
            aria-selected="false">Fix</a>
          </div>
        </nav>

      <div class="tab-content" id="nav-tabContent">        
        <div class="tab-pane fade" id="nav-test" role="tabpanel" aria-labelledby="nav-test-tab">
          <div class="row">-->
            <div class="col">      
              <table class="table" id="Table">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Total_time</th>
                    <th>Action</th>                  
                  </tr>
                </thead>
                <tbody>
                  <?php $t=0;
                  $a=0;
                  $b=0;
                  $c=0;?>
                @foreach($total_time as $time) 
                @if($time['sal_status']==0)          
                <tr>
                  <td>{{$t}}</td>
                  <td>{{$time['user_name']}}</td>
                  <td>{{$time['total']}}</td>
                  <td>
                    <a href="{{route('gen_sal',$time['id'])}}"><button  class="btn btn-secondary">Genrate Salary</button></a>
                    </td>
                  </tr>
                  @endif
                  @endforeach   
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <div class="tab-pane fade" id="nav-inprogress" role="tabpanel"aria-labelledby="nav-inprogress-tab">
        <div class="row">-->
            <div class="col">      
              <table class="table" id="myTable">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Total_time</th>
                    <th>Action</th>                  
                  </tr>
                </thead>
                <tbody>
                  <?php $t=0;
                  $a=0;
                  $b=0;
                  $c=0;?>
                @foreach($total_time as $time) 
                @if($time['sal_status']==1)          
                <tr>
                  <td>{{$t}}</td>
                  <td>{{$time['user_name']}}</td>
                  <td>{{$time['total']}}</td>
                  <td>
                    <a href="{{route('gen_sal',$time['id'])}}"><button  class="btn btn-secondary">Genrate Salary</button></a>
                    </td>
                  </tr>
                  @endif
                  @endforeach   
                  
                </tbody>
              </table>
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
<script type="text/javascript">
	$(document).ready( function () {
		$('#Table').DataTable();
	} );
</script>

                
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

@stop
