@extends('includes.master')

@section('css_links')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">


@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
			<div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h2>Balance Sheet</h2>
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">


                                <div class="btn-group" role="group" aria-label="Third group">

                                    <form action="{{route('Balance_Sheet',[$bank_id])}}" method="get" class="form-inline" >
                                        @csrf
                                        <div class="form-group mb-2">
                                          <label for="staticEmail2" >From</label>
                                          <input type="date" name="fdate" class="form-control" required>
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                          <label for="inputPassword2" >To</label>
                                          <input type="date" name="tdate" class="form-control" required>
                                        </div>
                                        <button name="search" class="btn btn-success mb-2">Search</button>
                                    </form>
                                </div>

                            </div>
                        </div>
            </div>
                    @if(isset($showtranfilter))
                    <table id="myTable" class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th> Date</th>
                                <th> Description</th>
                                <th> credit</th>
                                <th> Debit</th>
                                <th> balance</th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php $tbalance=0;?>
                            @foreach($showtranfilter as $filtertran)

                            <tr>
                                <td>{{$filtertran->trans_date}}</td>
                                <td>{{$filtertran->trans_description}}</td>
                                @if($filtertran->trans_operator=='+')
                                <td>{{$filtertran->amount}}</td>
                                @else
                                <td>-</td>
                                @endif
                                @if($filtertran->trans_operator=='-')
                                <td>{{$filtertran->amount}}</td>
                                @else
                                <td>-</td>
                                @endif
                                <td>
                                    <?php
                $credit = '0';
                $debit = '0';

                if($filtertran->trans_operator=='+')
                {
                    $credit = $filtertran->amount;

                }
                 elseif($filtertran->trans_operator=='-')
                {
                       $debit= $filtertran->amount;

                }
                     $chkbala=$credit-$debit;
                    // echo $debit;
                     


                     echo $tbalance += $chkbala;
                     
                     ?>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>
                        <tr>
                            <td>

                            </td>
                            <td>
                                <strong> Total Credit:</strong> {{$totalcreditfilter}} Rs/-
                            </td>
                            <td>
                                <strong> Total Debit:</strong> {{$totaldebitfilter}} Rs/-
                            </td>
                            <td>

                            </td>
                            <td>
                                 <strong> Total Balance:</strong> {{$totalbalfilter}} Rs/-
                            </td>
                        </tr>
                    </table>

                    @else

                    <table id="myTable" class="table table-bordered table-hover">

                        <thead>
                            <tr>


                                <th> Date</th>
                                <th> Description</th>
                                <th> credit</th>
                                <th> Debit</th>
                                <th> balance</th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php $tbalance=0; ?>
                            @foreach($showtran as $tran)

                            <tr>
                                <td>{{$tran->trans_date}}</td>
                                <td>{{$tran->trans_description}}</td>
                                @if($tran->trans_operator=='+')
                                <td>{{$tran->amount}}</td>
                                @else
                                <td>-</td>
                                @endif
                                @if($tran->trans_operator=='-')
                                <td>{{$tran->amount}}</td>
                                @else
                                <td>-</td>
                                @endif
                                <td>
                                    <?php
                $credit = '0';
                $debit = '0';
                if($tran->trans_operator=='+')
                {
                    $credit = $tran->amount;

                }
                 elseif($tran->trans_operator=='-')
                {
                       $debit= $tran->amount;

                }
                     $chkbala=$credit-$debit;
                    // echo $debit;


                     echo $tbalance += $chkbala;
                     ?>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>
                        <tr>
                            <td>

                            </td>
                            <td>
                                <strong> Total Credit:</strong> {{$totalcredit}} Rs/-
                            </td>
                            <td>
                                <strong> Total Debit:</strong> {{$totaldebit}} Rs/-
                            </td>
                            <td>

                            </td>
                            <td>
                                <strong> Total Balance:</strong> {{$totalbal}} Rs/-
                            </td>
                        </tr>
                    </table>

@endif
			</div>
		</div>
	</div>

































@stop

@section('js_link')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


@stop