@extends('includes.master')

@section('css_links')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">




@section('content')

<a href="{{route('sal_gen',$id)}}"><button  class="btn btn-secondary">Genrate Salary</button></a>
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <table  class="table table-bordered" id="myTable">
              <thead class="bg-dark">
                <tr class="text-center">
                  <th>Task Name</th>
                  <th>Total Task Time</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i=0;
                ?>
                @foreach($reject as $rejects)
                <tr>
                  <td>{{$rejects['title']}}</td>
                  <td>{{$rejects['total']}}</td>
                  @if($rejects['task_status']==3)
                  <td class="bg-danger text-center text-white">
                    Rejected
                  </td>
                  @endif                 
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@stop
