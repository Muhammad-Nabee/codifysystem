<!DOCTYPE html>
<html>
<head>
	<title>show empolyee List</title>
</head>
<body>

	<form>
		<input type="hidden" name="" value="{{$projects->p_id}}">
	</form>


	@foreach($users as $emp)
	<li>{{$emp}}</li>
	@endforeach


</body>
</html>