@extends('includes.master1')
@section('css_links')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">



@section('content')
	<div class="container">
		<div class="row">
            </div>
            <div class="row">
                <div class="col">                 
				<table class="table" id="myTable">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Start Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Time Log</th>
                  </tr>
                </thead>
                <tbody>
                <?php $t=0;?>
                @foreach($time as $times)
                
                <?php $t++;?>
                <tr>
                    <td>{{$t}}</td>
                    <td>{{$times->title}}</td> 
                    <td>{{$times->start_date}}</td>
                    <td>{{$times->start_time}}</td>
                    <td>{{$times->end_time}}</td> 
                    <td> {{$hours[$i]}}
                        <?php
                      $i++;
                      ?></td>
                  </tr>
                  
                  @endforeach
                </tbody>
            </table>
            <h4 style="text-align: center">Total Hours spend on tasks = {{$total}}</h4>
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

