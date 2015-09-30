<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.theme.css">
	<script type="text/javascript" src = "/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src = "/assets/js/scripts.js"></script>
	<script type="text/javascript" src = "/assets/js/bootstrap.min.js"></script>
	<style>
		.center {
    		text-align:center !important!;
		}
	</style>
</head>
	<body>
<?php
	echo $this->session->flashdata("registerMessage");
	echo $this->session->flashdata("loginMessage");
?>
		<div class = "container-fluid">
			<div class = 'row'>
				<div class = 'col-md-4 center'>
					<form action = "/lendings/welcome" method = "post"> 
						<h2>Login</h2>
						<p>Email: <input class="form-control" type = "text" name = "email"></p>
						<p>Password: <input class="form-control" type = "password" name = "password"></p>
						<input type = "submit" class="btn btn-default" value = "Login!">
					</form>
					<a href="/Lendings/registration">Don't have an account? Register! »</a>
					<p><a href="/">HomePage</a></p>

				</div>
			</div>
		</div>
	</body>

</html>