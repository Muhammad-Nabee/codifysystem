<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<style type="text/css">
  .logo-wrapper img{
    width: 140px;
  }
  .invoice-date-wrapper{
    color: #000000;
  }
  .invoice-date-wrapper {
    margin-top: -35px;
}
.clirnt_info{
  color: #000000;
}
.invoice-total-wrapper{
  color: #000000;
}
  
</style>
  

</head>
<body>
 <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="invoice-preview-wrapper">
                    <div class="row invoice-preview">
                        <!-- Invoice -->
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card invoice-preview-card">
                                <div class="card-body invoice-padding pb-0">
                                    <!-- Header starts -->
                                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                            <div class="logo-wrapper">
                                                <img class="img-fluid" src="{{asset('public/app-assets/images/logo/logo.jpg')}}">
                                            </div>
                                            <section style="color: black;">Codify (Pvt) Limited</section>
                                            <section style="color: black;">Codify, Strt #7A, Hostel City, Chak Shahzad</section>
                                            <section style="color: black;">Islamabad,Pakistan,44000</section>
                                            <section style="color: black;">+92 334 8989029</section>
                                            <section style="color: black;">info@codify.pk</section>
                                        </div>
                                        <div class="mt-md-0 mt-2">
                                            <h4 class="invoice-title">
                                                Salary ID
                                                <span class="invoice-number">#{{$pay->pay_id}}</span>
                                            </h4>
                                            <div class="invoice-date-wrapper" style= margin-top:25px;>
                                                <p class="invoice-date-title" >Date Issued:</p>
                                                <p style="color: black;" class="invoice-date">{{date('Y-m-d',strtotime($pay->date))}}</p>
                                            </div>
                                
                                        </div>
                                    </div>
                                    <!-- Header ends -->
                                </div>

                                <hr class="invoice-spacing" />

                                <!-- Address and Contact starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row invoice-spacing">       
                                        <div class="col-xl-8 p-0 clirnt_info">
                                            <h6 class="mb-2">Salary To:</h6>
                                            <p class="mb-25">{{$user->user_name}}</p>
                                            <p class="card-text mb-0">{{$user->email}}</p>
                                            <p class="mb-25">Total Time: {{$pay->total_time }}</p>
                                            <p class="mb-25">Total Tasks: {{$t_task}}</p>
                                            <p class="mb-25">Rejected Tasks: {{$r_task}}</p>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- Address and Contact ends -->

                                <!-- Invoice Description starts -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="py-1">Product</th>
                                                <th class="py-1">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          $total =0;
                                          $Sub=0;
                                          ?>
                                          @foreach($sal as $salary)
                                            <tr>
                                                <td class="py-1">
                                                    {{$salary->product}}
                                                </td>
                                                <td class="py-1">
                                                    {{$salary->price}}
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-body invoice-padding pb-0">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                            
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                            <div id="invoice-total-wrapper" class="invoice-total-wrapper">
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Salary:</p>
                                                    <p style="color: black;" class="invoice-total-amount">{{$user->salary}}</p>
                                                </div>
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Total Deduction:</p>
                                                    <p style="color: black;" class="invoice-total-amount">{{$pay->deduct}}</p>
                                                </div>
                                                <hr class="my-50" />        
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Total Salary:</p>
                                                    <p style="color: black;" class="invoice-total-amount">{{$pay->salary}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice Description ends -->

                                <hr class="invoice-spacing" />

                            </div>
                        </div>
                        <!-- /Invoice -->
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript">
	$(function () {
  'use strict';

  window.print();
});
</script>

<script type="text/javascript">
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
  
	

</body>
</html>
