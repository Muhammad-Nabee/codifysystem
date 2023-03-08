@extends('includes.master')

@section('css_links')


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@section('content')
<style>
.container .row .col-4{
    margin-right: 138px;
    padding: 0 60px;
}
    @media(max-width: 1024px){
        .container .row .col-4{
            margin-right: 115px;
            padding: 0 55px;
        }

        @media(max-width: 1440px){
        .container .row .col-4{
            margin-right: 110px;
            padding: 0 55px;
        }
    }
</style>

         <div class="container">
            <div class="row">
                <div class="col">
                    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="invoice-add-wrapper">
                    <div class="row invoice-add">
                        <!-- Invoice Add Left starts -->
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card invoice-preview-card">
                                <!-- Header starts -->
                                <div class="card-body invoice-padding pb-0">
                                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                            <div class="float-right mt-0">
                                                <img class="img-fluid" src="{{asset('public/app-assets/images/logo/logo.jpg')}}" style="width:75px; margin-right: 200px;">
                                            </div>
                                            <p class="card-text mb-25 text-dark">Codify (Pvt) Limited</p>
                                            <p class="card-text mb-25 text-dark">Codify, Strt #7A, Hostel City, Chak Shahzad</p>
                                            <p class="card-text mb-0 text-dark">Islamabad,Pakistan,44000</p>
                                            <p class="card-text mb-0 text-dark">+92 334 8989029</p>
                                            <p class="card-text mb-0 text-dark">info@codify.pk</p>
                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            @foreach($data as $item)
                                            <div class="d-flex align-items-center justify-content-md-end mb-1 text-dark ">
                                                <h4 class="invoice-title">Invoice</h4>&nbsp&nbsp&nbsp&nbsp&nbsp
                                                INV{{$item->invoice_id}}
                                            </div>
                                           <div class="d-flex align-items-center justify-content-md-end mb-1 text-dark">
                                                <h4 class="invoice-title">Date</h4>
                                                <?php
                                                $created_at = strtotime($item->paid_on);
                                                $date=date('d-M-Y', $created_at);
                                                ?>
                                                {{$date}}
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- Header ends -->

                                <hr class="invoice-spacing" />
                                <!-- Address and Contact starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row row-bill-to invoice-spacing">
                                        <div class="col-xl-8 mb-lg-1 col-bill-to pl-0">
                                            <h6 class="invoice-to-title">BILL TO:</h6>
                                            <div class="invoice-customer">
                                                @foreach($data as $info)
                                                <p class="text-dark">{{$info->user_name}}</p>
                                                <p class="text-dark">{{$info->p_title}}</p>
                                                <p class="text-dark">{{$info->phone}}</p>
                                                <p class="text-dark">{{$info->email}}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Address and Contact ends -->

                                <hr class="invoice-spacing mt-0" />

                                <div class="card-body invoice-padding py-0">
                                    <!-- Invoice Note starts -->
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">QTY</th>
                                                    <th scope="col">UNIT PRICE</th>
                                                    <th scope="col">TOTAL</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php
                                                        $total = 0;
                                                        $subtotal=0;
                                                        $final=0;

                                                  ?>
                                                  
                                                  @foreach($show_Invoice as $inv) 
                                                     <tr>
                                                      <td>{{$inv->item}}</td>
                                                      <td>{{$inv->quantity}}</td>
                                                      <td>{{$inv->price}}</td>
                                                      <td>{{$total=$inv->quantity * $inv->price}}</td>
                                                      <?php  
                                                        $subtotal +=$total=$inv->quantity * $inv->price;
                                                        //$subtotal =$subtotal+$total=$inv->quantity * $inv->price;
                                                       $per=$inv->discount/100*$subtotal;
                                                       $final=$subtotal-$per;
                                                      ?>

                                                    </tr>
                                                    @endforeach
                                            
                                                </tbody>
                                            </table>
                                            <br><br>
                                            
                                            <div class="float-right Number">
                                            <div class="font-weight-bold mr-2 result">
                                            <section style="color: black;">{{$subtotal}}</section>
                                            
                                            <section style="color: black;">{{$inv->discount}}%</section>
                                            
                                            <section style="color: black;">{{$final}}</section>
                                            </div>
                                            </div>
                                            <div class="float-right text">
                                              <div class="font-weight-bold ml-5 mb-3 text-right result-text">
                                                  <section style="color: black;">SUBTOTAL</section> 
                                                 <section style="color: black;">DISCOUNT</section>
                                                 <section style="color: black;">SUBTOTAL LESS DISCOUNT</section>
                                           
                                            </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <!-- Invoice Note ends -->
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Add Left ends -->

                        <!-- Invoice Add Right starts -->
                        <div class="col-xl-3 col-md-4 col-12">
                            <div class="mt-2">
                                <h4>Add Payment</h4>
                                <form action="{{route('addpayment')}}" method="post" id="myform">
                                @csrf
                                <input type="hidden" name="invoice_id" value="{{$data1->invoice_id}}">
                                <select class="form-control" name="bank_id">
                                    @foreach($bank as $banks)
                                    <option value="{{$banks->bank_id}}">{{$banks->bank_name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="totalamount" id="totalamount" value="{{$data1->totalamount}}">
                                <input type="text" name="amount" id="amount" value="{{$data1->amount}}" placeholder="Enter Amount" class="form-control mt-2" onkeydown="validation()">
                                <span id="message"></span>
                                <div class="invoice-terms mt-1">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>

                        <!-- Invoice Add Right ends -->
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
                </div>
                </div>

        </div>
            
         


@stop

@section('js_link')

<!-- <script>
    function validation()
    {
        /*$("#amount").val()
        var amount=$(this).val()
        $("#totalamount").val()
        var totalamount=$(this).val()
        if(amount>totalamount)
        {
            message.innerHTML="Invalid Data";
            message.style.color="red";
        }*/
        var myform=document.getElementById('myform');
        var amount=document.getElementById('amount').value;
        var totalamount=document.getElementById('totalamount').value;
        var message=document.getElementById('message');
        if(amount>totalamount){
            /*myform.classList.add("valid");
            myform.classList.remove("invalid");*/
            message.innerHTML="Invalid Data";
            message.style.color="red";
        }
    }
</script> -->

<!-- <script>
    $(function()
    {
        $("#amount").change(function(){
            var amount= parseInt($("#amount").val());
            var totalamount= parseInt($("#totalamount").val());
            if(amount>totalamount){
                error.textContent = "Please enter a valid price"
            error.style.color = "red"
            }
        });
    });
</script> -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>



@stop