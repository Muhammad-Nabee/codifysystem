<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col">
				<h1>Hi,{{$Emp_notice_mail['user_name']}}</h1>
				<h3 class="text-center text-danger"> {{$Emp_notice_mail['notice']}}</h3>
				<p class="text-center text-success"> {!!$Emp_notice_mail['description']!!}</p>
				
			</div>
			
		</div>
		
	</div>


</body>
</html>