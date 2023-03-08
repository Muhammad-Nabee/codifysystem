@extends('includes.master1')

@section('css_links')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  
@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<div class="card-datatable">

                    <table class="dt-responsive table table-bordered" id = "show_empolyee" >

                        <thead class="thead-dark">

                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>
                        	<?php $i = 0; ?>
                         @foreach($Notice_emp as $notice)
                         	<?php $i++ ?>
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$notice->notice}}</td>
                               <td>{{date('Y-m-d',strtotime($notice->created_at))}}</td> 
                                <td>
                                	<!-- <button><i class="fas fa-search"></i></button> -->
                                	<!-- <button class="btn btn-outline-warning" type='button' data-toggle="modal" data-target="#notice_info">
									<i class='fa fa-search'> </i> </button> -->
									<a href="#" class="btn btn-outline-warning show" data-des="{{$notice->description}}" data-title="{{$notice->notice}}" data-toggle="modal"><i class='fa fa-search'> </i></a>
                                	
                                </td>
                                

                            </tr>

                            @endforeach()
                            
                           

                            

                        </tbody>

                    </table>
                    <!-- Modal -->
					<div class="modal fade" id="notice_info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Description</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>

					      <div class="modal-body ">
					         <div class="title"></div>
                   <div class="description"></div>
					      </div>
					      <div class="modal-footer">
					        
					      </div>
					    </div>
					  </div>
					</div>
					<!-- modal ended here -->
                    

                </div>
			
		</div>
		
	</div>
	
</div>
@stop

@section('js_link')
<script>
  $(document).ready( function () {

    $('#show_empolyee').DataTable();

} );
</script>
<script>
    $(document).ready(function(){
        $(".show").click(function(){
      var desc=$(this).attr('data-des');
      var title=$(this).attr('data-title'); 
      $('.title').empty();
      $('.title').append(`<h1>`+title+`</h1>`);  
      $('.description').empty();
      $('.description').append(desc);
            $("#notice_info").modal('show');
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>




@stop


























