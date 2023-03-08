@extends('includes.master')

@section('css_links')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  


@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<a style="float: right;" href="{{route('show_Invoice')}}" class="btn btn-primary mb-3">Create Invoice</a>
				
			</div>
		</div>
		<div class="row">
			<div class="col">
				
				@if (Session::has('Store_Invoice'))
				<div class="alert alert-success">{{ Session::get('Store_Invoice') }}</div>
				@endif

				<table class="table" id="myTable">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Project</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $total=0;
                  $hidden=0;
                  $i = 0 
                  ?>
                  @foreach($clients as $p)
                  {{$hidden=$p->totalamount == $p->amount}}
                  <?php $i++ ?>
                  <tr>
                    <th>{{$i}}</th>
                    <td>{{$p->user}}</td>
                    <td>{{$p->p_title}}</td>
                    <td>
                      Total:{{$p->totalamount}}
                      <br>
                      <p><span class="text-success">Paid:</span>{{$p->amount}}
                      <br>
                      <span class="text-danger">Remaining:</span>{{$total=$p->totalamount - $p->amount}}</p>
                    </td>
                      @if($p->status==0)
                      
                        <td class="text-center text-danger">Unpaid</td>
                      
                      @else
                        <td class="text-center text-success">Paid</td>
                      
                      @endif
                    <td>
                      <div class="dropdown">
                          <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                          <i data-feather="more-vertical"></i>
                  
                          </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="{{route('Add_invoice',$p->invoice_id)}}">Show Invoice</a>
                          
                          @if($hidden)
                          @else
                          <a class="dropdown-item" href="{{route('payment',$p->invoice_id)}}">Add Payment</a>
                          @endif
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a>
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