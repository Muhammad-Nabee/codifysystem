@extends('includes.master')

@section('css_links')
<style type="text/css">
    .info_codify{
        color: #000000;
    }
    input[type=checkbox]{
            width: 100px;
            height: 25px;
            margin-top: 0px;
        }
        .invoice-mail {
        color: #5E5873;
        margin-top: -4px;
        font-size: 20px;
    }
    .Details{
        color: #000000;
    }
    .select2-container--classic.select2-container--open, .select2-container--default.select2-container--open{
    color: #000000;
    box-shadow: 0 5px 25px rgb(34 41 47 / 10%);

  }
  .vertical-layout.vertical-menu-modern.menu-collapsed .app-content, .vertical-layout.vertical-menu-modern.menu-collapsed .footer {
    margin-top: -55px;
}
.col-xl-9 {
    margin-left: -108px;
}
</style>

@section('content')


     <div class="app-content content" style="margin-left: 26px margin-top: 20px">
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
                                            <div class="logo-wrapper">
                                                
                                                <img style="margin-bottom: 15px!important;"  src="https://system.codify.pk/public/app-assets/images/logo/logo.jpg" alt="tag" width="95" !important>
                                            </div>
                                            <p class="card-text mb-25 info_codify">Codify (Pvt) Limited</p>
                                            <p class="card-text mb-25 info_codify">Codify Strt #7A Hostel City, Chak Shahzad </p>
                                            <p class="card-text mb-0 info_codify">Islamabad,Pakistan,4400</p>
                                            <p class="card-text mb-0 info_codify">+92 3348989029</p>
                                            <p class="card-text mb-0 info_codify">info@codify.pk</p>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- Header ends -->

                                <hr class="invoice-spacing" />

                                <!-- Address and Contact starts -->
                                <form action="{{route('Store_Invoice')}}" method="POST" enctype="multipart/form-data">
                                <div class="card-body invoice-padding pt-0">
                                    
                                    <div class="row row-bill-to invoice-spacing">

                                        <div class="col-xl-6 mb-lg-1 col-bill-to pl-0">
                                            <h6 class="invoice-to-title">Projects:</h6>
                                            <div class="invoice-customer">
                                                <select required="" class="invoiceto form-control" name="project_id"id="project_id">
                                                    @foreach($Get_AllProject as $pro)
                                                    <option></option>
                                                    <option value="{{$pro->p_id}}"> 
                                                    {{$pro->p_title}} 
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 mb-lg-1 col-bill-to pl-0">
                                            <h6 class="invoice-to-title">Clients:</h6>
                                            <div class="invoice-customer">
                                                <select required="" class="invoiceto form-control"name="client_id"id="clients" >
                                                    @foreach($clients as $client)
                                                        <option></option>
                                                        <option value="{{$client->id}}"> 
                                                        {{$client->user_name}} 
                                                        </option>
                                                        @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row row-bill-to invoice-spacing">

                                        <div class="col-xl-12 mb-lg-1 col-bill-to pl-0">
                                            <h6 class="invoice-to-title">Projects:</h6>
                                            <textarea required="" class="form-control" cols="4" rows="4" name="invoice_desc"></textarea>
                                            
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <!-- Address and Contact ends -->

                                <!-- Product Details starts -->
                                <table class="table table-hover table-bordered mt-2">
                             @csrf
                            <tr>
                                
                                <td>
                                    <input type="text" name="item[]" placeholder="item" class="form-control " >
                                </td>
                                
                                 <td>
                                    <input type="text" name="quantity[]"  placeholder="Quantity" class="form-control qyt " required="">
                                </td>
                                
                                <td>
                                    <input type="number" id="price"  name="price[]" placeholder="Price" class="form-control txt" required="">
                                </td>

                                <td><button type="button" class="btn btn-primary" id="add_btn"><i class="fas fa-plus-circle"></i></button></td>
                            </tr>
                      
                        </table>
                                <!-- Product Details ends -->

                                <!-- Invoice Total starts -->
                                <div class="card-body invoice-padding">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-4 order-md-1 order-2 mt-md-0 mt-3">
                                            <div class="d-flex align-items-center mb-1">
                                                <label for="salesperson" class="form-label invoice-mail">Invoice Via Mail:</label>
                                                <div class="form-group form-check">
                                                    <!-- <input type="checkbox" name="check" value="check" class="form-check-input" id="exampleCheck1"> -->

                                                    <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="check" value="check" id="paymentStub" />
                                            <label class="custom-control-label" for="paymentStub"></label>
                                        </div>
                                
                                                </div>
                                            </div>
                                        </div><!-- end here -->
                                        <div class="col-md-8 d-flex justify-content-center order-md-2 order-1">
                                         <div class="invoice-total-wrapper">
                                                
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title Details pr-3">Discount:</p>
                                                    <input type="text" name="discount"  class="form-control  discount" style="width: 120px;">
                                                </div>

                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title Details pr-3">Subtotal:</p>
                                                    <input type="text" id="total" name="totalamount"  class="form-control mt-1" readonly="" style="width: 120px">
                                                </div>
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title Details">Total:</p>
                                                    
                                                    <div style="margin-left: 65px;">
                                             <button style="width: 120px;" type="button" onclick="total_ammount_price()" class="btn btn-secondary mt-2">Total</button></div>
                                                </div>
                                                <hr class="my-50" />
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice Total ends -->

                                <hr class="invoice-spacing mt-0" />

                                
                            </div>
                        </div>
                        <!-- Invoice Add Left ends -->

                        <!-- Invoice Add Right starts -->
                        <div class="col-xl-3 col-md-4 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary btn-block mb-75" >Save Invoice</button>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                        <!-- Invoice Add Right ends -->
                    </div>

                   
                </section>

            </div>
        </div>
    </div>s
   
@stop
@section('js_link')



<script type="text/javascript">
    $(document).on('click','#add_btn',function(){
        //alert(); //by clicking button check button
        var html='';  //declear variable
        //console.log(html);
          html+='<tr>';
          html+='<td><input type="text" name="item[]" placeholder="item" class="form-control"></td>';
          html+='<td><input type="text" name="quantity[]" placeholder="Quantity" class="form-control qyt"></td>';
          html+='<td><input type="number" id="price" name="price[]"  class="form-control txt"></td>';
          html+='<td><button type="button" class="txt btn btn-danger" id="remove"><i class="fal fa-comment-alt-times"></i></button></td>';
          html+='</tr>';
          $('tbody').append(html);
          

    });

    $(document).on('click','#remove',function(){
      //alert();
      $(this).closest('tr').remove();
      total_ammount_price();

    });

  function total_ammount_price() {

    var sum = 0;
    var price=[]
    var qty=[]

    //iterate through each textboxes and add the values
    
    //push quqntity array
    $(".qyt").each(function(){
        var q=$(this).val()
        qty.push(q);
        // console.log(qty)
        });
    //push price array
    $(".txt").each(function() {

        var p = $(this).val();
         price.push(p);
         // console.log(price)


    });
    
//remove null value 1,2,3,"",5,""7 item is field value
price = price.filter((item) => item);

/*console.log(price);*/

    var discount=$('.discount').val();
    for(var i in qty){
        sum+=parseInt(price[i])*parseInt(qty[i])
        /*console.log(sum)*/
    }
    if(discount==null)
    {
        subtotal=sum;
    }else
    {
    var final=discount/100*sum;
    
    var subtotal=sum-final;
}
    $('#total').val(subtotal);
  }

  </script>
  <script type="text/javascript">
      $(document).ready(function(){
        $("#project_id").select2({
            placeholder:'-select projects-'
        });
        $("#clients").select2({
            placeholder :'-select clients-'
        });
      });
  </script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>



@stop