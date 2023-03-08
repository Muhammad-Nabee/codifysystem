<!DOCTYPE html>
<html>
<head>
	<title>Registration form</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<style>
body {
	color: #fff;
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	height: 40px;
	box-shadow: none;
	color: #969fa4;
}
.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 450px;
	margin: 0 auto;
	padding: 30px 0;
  	font-size: 15px;
}
.signup-form h2 {
	color: #636363;
	margin: 0 0 15px;
	position: relative;
	text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
	content: "";
	height: 2px;
	width: 30%;
	background: #d4d4d4;
	position: absolute;
	top: 50%;
	z-index: 2;
}	
.signup-form h2:before {
	left: 0;
}
.signup-form h2:after {
	right: 0;
}
.signup-form .hint-text {
	color: #999;
	margin-bottom: 30px;
	text-align: center;
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f2f3f7;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
	margin-top: 3px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;		
	min-width: 140px;
	outline: none !important;
}
.signup-form .row div:first-child {
	padding-right: 10px;
}
.signup-form .row div:last-child {
	padding-left: 10px;
}    	
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #5cb85c;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}  
</style>
<body>
	<div class="signup-form">
    <form action="{{route('add_registration_form')}}" method="POST" enctype="multipart/form-data">
    	@csrf
		<h2>Register</h2>
		@if(session('user_added'))
			<div class="alert alert-success">
				{{session('user_added')}}
			</div>
		@endif
        <div class="form-group">
        	<label>Username</label>
			<input type="text" class="form-control" name="user_name" placeholder="User_Name" required="required">      	
        </div>
        <div class="form-group">
        	<label>Email</label>
        	<input type="email" class="form-control" name="email" placeholder="Email" required="required">
        	@error('email') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
		<div class="form-group">
			<label>Contact Number</label>
            <input type="number" class="form-control" name="phone" required="required">
            @error('number') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
		<div class="form-group">
			<label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>  
        <div class="form-group">
            <label>Empolyee Name</label>
                <select style="border-radius: 5px;" class="form-control" name="role_id">
                    @foreach($Role as $role)
						<option value="{{$role->role_id}}">
                            {{$role->name}} 
                        </option>   
					@endforeach    

                </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Profile Picture</label>
                <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
        </div>      
        <div class="form-group">
			<label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
		</div>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
    </form>
	<div class="text-center">Already have an account? <a href="">Sign in</a></div>
</div>

</body>
</html>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>