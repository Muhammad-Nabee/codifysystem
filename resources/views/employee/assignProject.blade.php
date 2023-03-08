@extends('includes.master1')

@section('css_link')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">





@section('content')



                <section id="dashboard-ecommerce">
                 
                 <h1>All Assign Projects to <span class="user-name font-weight-bolder">{{session('status')?session('status')->user_name:""}}</span>

                  </h1> 

                 <table class="table table-striped table-bordered" id="myTable">
					  <thead>
					    <tr>
					      <th>Project Title</th>
					      <th>Desc</th>
					      <th>Deadline</th>
					      <th>Status</th>
					    </tr>
					  </thead>
						  <tbody>
						  	@foreach($p_array as $project)
						    <tr>
						      
						      <td>{{$project['title']}}</td>
						      <td><a href="#" class="show" data_des="{{$project['desc']}}" data-toggle="modal">show</a></td>
						      <td>{{$project['deadline']}}</td>

						       @if($project['status']==0)
						       	 <td>In Progress</td>
						       @elseif($project['status']==1)
						         <td>Completed</td>
                               @endif
						      <!-- <td>{{$project['status']}}</td> -->
						    </tr>
						    @endforeach
						  </tbody>
					</table>

                    <!-- modal start here -->
                     <div id="myModal" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-light" style="background:#ffa500;">
								<h5 class="modal-title">Description</h5>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body description">
								empty function uses
							
								</div>
							</div>
						</div>
    				</div> 
                    <!-- modal ended here -->

                  
                </section>
                
                



@stop

@section('js_link')
<script type="text/javascript">
	$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script>
	$(document).ready( function () {
		$(document).on('click','#show',function(){
			var des=$(this).attr('data_des');
			
		});
	});
</script>
<script>
    $(document).ready(function(){
        $(".show").click(function(){
			var desc=$(this).attr('data_des');   
			$('.description').empty();
			$('.description').append(`<table class="table">
							<td>`+desc+`</td>
							</table>`);
            $("#myModal").modal('show');
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<script src="{{asset('public/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>

<script src="{{asset('public/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>



@stop