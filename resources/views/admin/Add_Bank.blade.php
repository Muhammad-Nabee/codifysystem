  @extends('includes.master')

@section('css_links')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  


@section('content')





<div class="container">
	<div class="row">
		<div class="col">
			<!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
        Add Bank
        </button>
        @if(session('Added_Bank'))
                  <h6 class="alert alert-success">{{session('Added_Bank')}}</h6>

        @endif
        @if(session('Add_Transiction'))
        <h6 class="alert alert-success">{{session('Add_Transiction')}}</h6>
        @endif

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('Add_bank')}}" method="POST" enctype="multipart/form-data">
        	@csrf
        	<div class="form-group">
        		<label>Title</label>
        		<input type="text" name="bank_name" placeholder="Add Bank" class="form-control">
        	</div>
        	<button type="submit" class="btn btn-primary float-right">Submit</button>
        	
        </form>
      </div>
    </div>
  </div>
</div>
<!-- modal ended here -->
            <table class="table" id = "myTable">
              <thead>
                <tr>
                  <th>Bank Name</th>
                  <th>Balace</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $Bank)
                <tr>
                  <td>{{$Bank['bank_name']}}</td>
                  <td>{{$Bank['balance']}}</td>
                  <td>
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                          <i data-feather="more-vertical"></i>
                  
                          </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button" id="show{{$Bank['id']}}" data-toggle="modal" data-target="#bank_transiction{{$Bank['id']}}">Transiction</button>
                        <a class="dropdown-item" href="{{route('Balance_Sheet',$Bank['id'])}}">Balance Sheet</a>
                      </div>
                    </div>

                  </td>
                </tr>
                <div class="modal fade text-left" id="bank_transiction{{$Bank['id']}}"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">


                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

                                <div class="modal-content">


                                    <div class="card">

                                        <div class="card-header">

                                            <h4 class="card-title">Transiction </h4>

                                        </div>

                                        <div class="card-body" style="background: white !important;">
                                            <form action="{{route('Add_Transiction')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                            <input type="" value="{{$Bank['id']}}" name="bank_id" hidden=""  >
                                                  <div class="row">
                                                        <div class="col">
                                                            <label>Date</label>
                                                            <input type="date"  name="trans_date" class="form-control" >
                                                        </div>
                                                        <div class="col">
                                                            <label>Operation</label>
                                                            <select name="trans_operator"id="" class="form-control">
                                                                 <option value="+">Cridit</option>
                                                                <option value="-">Debit</option>
                                                                 
                                                            </select>
                                                        </div>
                                                  </div>
                                                  <div class="row">
                                                      <div class="col">
                                                          <label>Amount</label>
                                                          <input type="number" name="amount" class="form-control">
                                                        </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col">
                                                      <label for="exampleFormControlTextarea1">Description</label>
                                                      <textarea name="trans_description" class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                                                      </div>
                                                  </div>

                                                  <!-- row ended here -->
                                                  <div class="row mt-5 ">
                                                    <div class="col">
                                                        <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
                                                        
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