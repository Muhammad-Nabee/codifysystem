@extends('includes.master1')

@section('css_link')

<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/charts/apexcharts.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/charts/chart-apex.css')}}">


@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<section id="dashboard-ecommerce">
  <!-- <h1>We are in employee</h1> -->
  
  @if(session()->has('message'))
  <div class="alert alert-success">
    {{session()->get('message')}}
  </div>
  @endif
  @if($firstdata!=null)
  <a href="{{route('/completetask',$firstdata->id)}}"><button  type="button" class="btn btn-primary float-right click" id="click">
    Stop
  </button></a> 
  @else
  <button  type="button" onclick="reset();" id="startStop" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
    Start Task
  </button>
  @endif
  
  <div class="showstopbutton">
    
    
    </div>
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Start Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form >
              <tr>
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <p>Project Name</p>
                <select class="form-control name p_id" name="title" id="p_id" >
                    <option>--Select Project--</option>
                  @foreach($p_array as $item) 
                  <option value="{{$item['p_id']}}">
                    {{$item['title']}}
                  </option>
                  
                  @endforeach
                </select>
                <br>
                <p>Task Title</p>
                <select id="data" name="t_id" class="form-control">
                  
                  </select>
                  <input class="btn btn-primary float-right" id="add-writer-btn" type="button" value="Submit">
                </form>
                
                
              </div>
            </div>
          </div>
        </div>
        
        <div id="display" style="margin-left: 580px; margin-top: 15px;">
          <!-- 00:00:00 -->
        </div>
   
        <!-- <div class="button">
          <button id="startStop" onclick="reset()">Start</button>
          <button id="reset" onclick="reset()">Reset</button>
        </div> -->
        
        
      </section>

      <div class="id"></div>
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
        // dd($m_total);
      
      ?>
      <h6 style="text-align: center">current month total time={{$m_total}} </h6>
      
      
      
      
      <input type="hidden" class="hou" value="{{$ho}}">
      <input type="hidden" class="min" value="{{$mi}}">
      <input type="hidden" class="sec" value="{{$se}}">
      <script>
        $(document).ready( function () {
          $('.name').change( function(){
            
            var id =$('.name').val();
            var token=$('#csrf-token').val();
            
            $.ajax({
              type: "get",
              url: "{{route('posttask')}}",
              data: {
                "token":token,
                'id' :id,
              },
              
              success: function(response){
                $('#data').empty();
                for(var i=0; i<response.dataarray.length; i++)
                {
                  
                  $('#data').append(`<option value="`+response.dataarray[i].task_id+`">`+response.dataarray[i].title+`</option>`);
                }
                
              }
              
            });
          });
        });
        </script>

<script>
  $(document).ready(function() {
    $('#add-writer-btn').on('click', function() {
      var p_id = $('#p_id').val();
      var t_id =$('#data').val();
      var token=$('#csrf-token').val();
      $.ajax({
        url: "{{route('addtask')}}",
        method: "get",
        data: {
          "token":token,
          "p_id": p_id,
          "t_id": t_id
          
        },
        success:function(message){
          $('.id').empty();
          $('.id').append(`<input type="hidden" class="get" value="`+message.id+`">`);
          $('#exampleModal').modal('hide');
          $('#startStop').hide();
          var id=message.id;
          var url1="{{route('/completetask')}}"+'/'+id;
          $('.showstopbutton').append(`<a href="`+url1+`"><button  type="button" class="btn btn-primary float-right click" id="click">
          Stop
          </button></a>`);
          let seconds=0;
          let minutes=0;
          let hours=0;
          
          let displaySeconds=0;
          let displayMinutes=0;
          let displayHours=0;
          
          // define ver to hold setInterval{} function
          let interval= null;
          
          //define ver to hold stopwatch status
          let status = "stopped";
          
          // stopwatch function
          function stopwatch() {
            seconds++;
            
            if(seconds / 60 ===1){
              seconds = 0;
              minutes++;
              
              if (minutes / 60 ===1) {
                minutes =0;
                hours++;
              }
            }
            //if second/minute/hour is only one digit.add leading 0 to the value
            if (seconds < 10 ) {
              displaySeconds = "0" + seconds.toString();
            }else{
              displaySeconds = seconds;
            }
            
            if (minutes < 10 ) {
              displayMinutes = "0" + minutes.toString();
            }else{
              displayMinutes = minutes;
            }
            
            if (hours < 10 ) {
              displayHours = "0" + hours.toString();
            }else{
              displayHours = hours;
            }
            
            //display updated time to user
            document.getElementById('display').innerHTML =displayHours +":" +displayMinutes +":" +displaySeconds;
          }
          
          $(document).ready( function () {
            if (status === "stopped") {
              interval=window.setInterval(stopwatch, 1000);
              document.getElementById("startStop").innerHTML = "Stop";
              status ="started";
            }
            /*else{
              window.clearInterval(interval);
              document.getElementById("startStop").innerHTML = "Start";
              status="stopped";
            }*/
          });
          
          function reset(){
            if (status === "started") {
              window.clearInterval(interval);
              seconds=0;
              minutes=0;
              hours=0;
              document.getElementById("display").innerHTML ="00:00:00";
              document.getElementById("startStop").innerHTML = "Start";
              status ="started";
              
            }
          }
        }
      });
    });
  });
</script>
@if($firstdata!==null)
<script>
  $(document).ready( function () {
    var hou =$('.hou').val();
    var min =$('.min').val();
    var sec =$('.sec').val();
    
    let seconds=sec;
    let minutes=min;
    let hours=hou;
    
    let displaySeconds=sec;
    let displayMinutes=min;
    let displayHours=hou;
    
    // define ver to hold setInterval{} function
    let interval= null;
    
    //define ver to hold stopwatch status
    let status = "stopped";
    
    // stopwatch function
    function stopwatch() {
      seconds++;
      
      if(seconds / 60 ===1){
        seconds = 0;
        minutes++;
        
        if (minutes / 60 ===1) {
          minutes =0;
          hours++;
        }
      }
      //if second/minute/hour is only one digit.add leading 0 to the value
      if (seconds < 10 ) {
        displaySeconds = "0" + seconds.toString();
      }else{
        displaySeconds = seconds;
      }
      
      if (minutes < 10 ) {
        displayMinutes = "0" + minutes.toString();
      }else{
        displayMinutes = minutes;
      }
      
      if (hours < 10 ) {
        displayHours = "0" + hours.toString();
      }else{
        displayHours = hours;
      }
      
      //display updated time to user
      document.getElementById('display').innerHTML =displayHours +":" +displayMinutes +":" +displaySeconds;
    }
    
    $(document).ready( function () {
      if (status === "stopped") {
        interval=window.setInterval(stopwatch, 1000);
        document.getElementById("startStop").innerHTML = "Stop";
        status ="started";
      }
      /*else{
        window.clearInterval(interval);
        document.getElementById("startStop").innerHTML = "Start";
        status="stopped";
      }*/
    });
    
    
  });
</script>

@endif

<!-- <script>
  window.onload = function(){
    document.getElementById('click').click();
  }
</script> -->
@stop

@section('js_link')

<script src="{{asset('public/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>

<script src="{{asset('public/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

@stop
