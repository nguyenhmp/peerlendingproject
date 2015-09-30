<html>
<head>
	<title>Registration Page</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.theme.css">
	<script type="text/javascript" src = "/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src = "/assets/js/scripts.js"></script>
	<script type="text/javascript" src = "/assets/js/bootstrap.min.js"></script>		
</head>
<body>

<?php
	echo $this->session->flashdata("registerError");
?>


	<div class = "container-fluid">
		<div class = 'row'>
			<div class = 'col-md-4 center'>
				<form action = '/lending/registerUser' method = 'post'>
					<h2>Register</h2>
					<p>First Name: <input class="form-control" type = "text" name = "first"></p>
					<p>Last Name: <input class="form-control" type = "text" name = "last"></p>
					<p>Email: <input class="form-control" type = "text" name = "email"></p>
					<p>Password: <input  class="form-control" type = "password" name = "password"></p>
					<p>Password Confirmation: <input  class="form-control" type = "password" name = "confirm"></p>
					<input class="btn btn-default" type = "submit" value = "Register!">
				</form>
				<a href="/Lendings/login">Already have an Account? Log in!</a>
				<a href="/">HomePage</a>
			</div>
		</div>
	</div>
</body>
</html>