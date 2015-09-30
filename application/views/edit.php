<html>
	<head>
		<title>Edit User Profile</title>
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
		<div class = 'container-fluid'>
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-default" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
							</button> <a class="navbar-brand" href="/lendings/welcome">Home</a>
						</div>
						
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<form class="navbar-form navbar-left" role="search">
								<div class="form-group">
									<input type="text" class="form-control" />
								</div> 
								<button type="submit" class="btn btn-default">
									Submit
								</button>
							</form>
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li>
											<a href="/lendings/profile">Profile</a>
										</li>
										<li>
											<a href="/lendings/messages">Inbox</a>
										</li>
										<li>
											<a href="/lendings/inventory">Inventory</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="/">Log Out</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						
					</nav>
				</div>
			</div>
		<div class="row">
			<div class="col-md-5 center">
<?php
	echo $this->session->flashdata("updateMessage");
?>
				<form action = "/lendings/updateAccount" method = "post">
					<h2>Edit Account</h2>
					<p>First Name: <input class="form-control" class="form-control" type = "text" name = "first" value = "<?php echo $this->session->userdata['first_name']?>"></p>
					<p>Last Name: <input class="form-control" type = "text" name = "last" value = "<?php echo $this->session->userdata['last_name']?>"></p>
					<p>Email: <input class="form-control" type = "text" name = "email" value = "<?php echo $this->session->userdata['email']?>"></p>
					<p>Password: <input class="form-control" type = "password" name = "password"></p>
					<p>Password Confirmation: <input class="form-control" type = "password" name = "confirm"></p>
					<input class="btn btn-default" type = "submit" value = "Update!">
				</form>

<?php
	echo $this->session->flashdata("addressMessage");
?>
				<form action = "/lendings/updateAddress" method = "post">
					<h2>Update Your Address</h2>
					<p>House Number: <input class="form-control" class="form-control" type = "text" name = "house" value = "<?php echo $this->session->userdata('address')['house_number']?>"></p>
					<p>Street: <input class="form-control" type = "text" name = "street" value = "<?php echo $this->session->userdata('address')['street_name']?>"></p>
					<p>Apt Number: <input class="form-control" type = "text" name = "apt" value = "<?php echo $this->session->userdata('address')['apt_number']?>"></p>
					<p>City: <input class="form-control" type = "text" name = "city" value = "<?php echo $this->session->userdata('address')['city']?>"></p>
					<p>State: <input class="form-control" type = "text" name = "state" value = "<?php echo $this->session->userdata('address')['state']?>"></p>
					<p>Zip: <input class="form-control" type = "text" name = "zip" value = "<?php echo $this->session->userdata('address')['zip_code']?>"></p>
					<input class="btn btn-default" type = "submit" value = "Address!">
				</form>
			</div>
		</div>
	</div>
	</body>
</html>