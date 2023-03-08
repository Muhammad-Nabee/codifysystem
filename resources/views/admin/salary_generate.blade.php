@extends('includes.master')

@section('css_links')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

@section('content')

<?php
$t_hour=0;  $t_mint=0;  
$t_sece=0; 
$t_h=0;    $t_m=0;
$t_s=0;
$r_h=0;    $r_m=0;
$r_s=0;
?>
@foreach( $totalab as $totals)
<?php
$t_h+=$totals['hou'];
$t_m+=$totals['min'];
$t_s+=$totals['sec'];
?> 
@endforeach 

@foreach($reject as $rejects)
<?php
// dd($rejects['sece']);
$r_h+=$rejects['hour'];
$r_m+=$rejects['mint'];
$r_s+=$rejects['sece'];
?> 
@endforeach                 
<?php
// dd($r_h); 
$t_hour=$t_h-$r_h;
$t_mint=$t_m-$r_m;
$t_sece=$t_s-$r_s; 
$t_mint  =$t_mint+floor($t_sece/60);
$t_sece= $t_sece % 60;
//minutes convert into hours
$t_hour  =$t_hour+floor($t_mint/60);
$t_mint = $t_mint % 60; 
$m_total=$t_hour." Hours ".$t_mint." Minutes ".$t_sece." Sec ";
$t_total=$t_hour.":".$t_mint.":".$t_sece;
// dd($t_total);

?>  

<form class="form-horizontal" action="{{route('sal_save',$id)}}" method="post" enctype="multipart/form-data">
<input type="Hidden" name="user_id" value="{{$id}}">
<input type="Hidden" value="{{$t_total}}"  name="total_time"  >
@csrf
    <br>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                @if($user['sal_status']==1) 
                <?php
                
                $total2=$user->salary;
                ?>
                @elseif($user['sal_status']==0)
                <?php
                $total2=$t_hour*$user->salary;
                ?>
                @endif
            </div>
           
        </div>
    </div>
    <div class="row">
            <div class="form-group row">
                <div class="col-sm-1 col-form-label">
                    <h4>Salary:</h4>
                </div>
                <div class="col-sm-2">
                    <input type="text" value="{{$total2}}" id="subtotal"  class="form-control mt-1" readonly="" style="width: 120px">             </div>
                </div>
                <div class="col-sm-1 col-form-label">
                    <h4>Subtotal:</h4>
                </div>
                <div class="col-sm-2">
                    <input type="text" id="sum" name="sumtotal"  class="form-control mt-1" readonly="" style="width: 120px" required="">                 </div>
                </div>
                <div class="col-sm-1 col-form-label">
                    <h4>Total Salary::</h4>
                </div>
                <div class="col-sm-2">
                    <input type="text" id="total" name="totalamount"  class="form-control mt-1" readonly="" style="width: 120px" required="">            </div>
                </div>
            </div>
>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group row">
                <div class="col-sm-2 col-form-label">
                    <h4>Subtotal:</h4>
                </div>
                <div class="col-sm-10">
                    <input type="text" id="sum" name="sumtotal"  class="form-control mt-1" readonly="" style="width: 120px" required="">          </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group row">
                <div class="col-sm-2 col-form-label">
                    <h4>Total Salary:</h4>
                </div>
                <div class="col-sm-10">
                <input type="text" id="total" name="totalamount"  class="form-control mt-1" readonly="" style="width: 120px" required="">       
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <h4>Deduction</h4>
                <table class="table table-hover table-bordered mt-2">
                    <tr>
                        <td>
                            <input type="text" name="product[]" placeholder="item" class="form-control " >
                        </td>
                        <td>
                            <input type="number" id="price"  name="price[]" placeholder="Price" class="form-control txt" >
                        </td>
                        <td><button type="button" class="btn btn-primary" id="add_btn"><i class="fas fa-plus-circle"></i></button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="form-group row">
                <div class="col-sm-2 col-form-label">
                    
                    </div>
                    <div class="col-sm-10">
                        <button style="width: 120px;" type="button" onclick="total_ammount_price()" class="btn btn-primary mt-2">Total</button>      
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        <div class="row">
            <div class="col-12">
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label">
                    
                    </div>
                    <div class="col-sm-10">
                        <button style="width: 120px;" type="submit"  class="btn btn-primary mt-2">Salary Generate</button>      
                    </div>
                </div>
            </div>
        </div>
        
</form> 

@stop

@section('js_link')

<script type="text/javascript">
	$(document).ready( function () {
    $('#myTable').DataTable();
	} );
</script>

<script type="text/javascript">
    $(document).on('click','#add_btn',function(){
        //alert(); //by clicking button check button
        var html='';  //declear variable
        //console.log(html);
          html+='<tr>';
          html+='<td><input type="text" name="product[]" placeholder="item" class="form-control"></td>';
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
    var sub_total=0;
    
    //iterate through each textboxes and add the values
    //push price array
    $(".txt").each(function() {
        var p = $(this).val();
         price.push(p);
        //  console.log(price)
    });
    
//remove null value 1,2,3,"",5,""7 item is field value
price = price.filter((product) => product);

/*console.log(price);*/     

    for(var i in price){
        sum+=parseInt(price[i])
        // console.log(sum)
    }
   var sub= $('#sum').val(sum);
   var total= $('#subtotal').val();
   sub_total=total-parseInt(sum); 
         $('#total').val(sub_total);
    
  }
  </script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@stop

					