@extends('includes.master')

@section('css_links')

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
  

@section('content')
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
                                                Invoice
                                                <span class="invoice-number">#{{$id}}</span>
                                            </h4>
                                            <div class="invoice-date-wrapper">
                                              @foreach($client_info as $inv_date)
                                                <p class="invoice-date-title">Date Issued:</p>
                                                <p style="color: black;" class="invoice-date">{{date('Y-m-d',strtotime($inv_date->created_at))}}</p>
                                                @endforeach
                                            </div>
                                
                                        </div>
                                    </div>
                                    <!-- Header ends -->
                                </div>

                                <hr class="invoice-spacing" />

                                <!-- Address and Contact starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row invoice-spacing">
                                      @foreach($client_info as $detail_client)
                                        <div class="col-xl-8 p-0 clirnt_info">
                                            <h6 class="mb-2">Invoice To:</h6>
                                            <p class="mb-25">{{$detail_client->user_name}}</p>
                                            <p class="card-text mb-25">{{$detail_client->p_title}}</p>
                                            <p class="card-text mb-25">{{$detail_client->phone}}</p>
                                            <p class="card-text mb-0">{{$detail_client->email}}</p>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                                <!-- Address and Contact ends -->

                                <!-- Invoice Description starts -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="py-1">Item</th>
                                                <th class="py-1">Qty</th>
                                                <th class="py-1">Unit Price</th>
                                                <th class="py-1">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          $total =0;
                                          $Subtotal=0;
                                          $final=0;
                                          ?>
                                          @foreach($show_Invoice as $inv)
                                            <tr>
                                                <td class="py-1">
                                                    {{$inv->item}}
                                                </td>
                                                <td class="py-1">
                                                    {{$inv->quantity}}
                                                </td>
                                                <td class="py-1">
                                                    {{$inv->price}}
                                                </td>
                                                <td class="py-1">
                                                    {{$total=$inv->quantity * $inv->price}}
                                                    <?php
                                                    $Subtotal=$Subtotal+$total=$inv->quantity * $inv->price;
                                                    $per=$inv->discount/100*$Subtotal;
                                                    $final =$Subtotal-$per;
                                                    ?>
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
                                                    <p class="invoice-total-title">Total:</p>
                                                    <p style="color: black;" class="invoice-total-amount">{{$Subtotal}}</p>
                                                </div>
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Discount:</p>
                                                    <p style="color: black;" class="invoice-total-amount">{{$inv->discount}}%</p>
                                                </div>
                                                <hr class="my-50" />
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Subtotal:</p>
                                                    <p style="color: black;" class="invoice-total-amount">{{$final}}</p>
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

                        <!-- Invoice Actions -->
                        <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                            <div class="card">
                                <div class="card-body">
                                   
                                    <a class="btn btn-outline-primary btn-block mb-75" href="{{route('invoice_print',$id)}}" target="_self">
                                        Print
                                    </a>
                                    <a href="" class="btn btn-primary btn-block mb-75">Download</a>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice Actions -->
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
	
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  

@stop