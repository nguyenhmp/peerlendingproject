<html>
	<head>
		<title>Checkout page</title>
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
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-default" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
							</button> <a class="navbar-brand" href="/Lendings/viewDashBoard">Home</a>
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
		<div class = "container-fluid">
			<div class = "col-md-12">
				<form action = "/lendings/billingAddress" method = "post">
					<h2>Billing Address</h2>
<?php
	echo $this->session->flashdata('addressMessage');
	echo $this->session->flashdata('billingMessage');
?>

					<p>House Number: <input class="form-control" class="form-control" type = "text" name = "house"></p>
					<p>Street: <input class="form-control" type = "text" name = "street"></p>
					<p>Apt Number: <input class="form-control" type = "text" name = "apt"></p>
					<p>City: <input class="form-control" type = "text" name = "city"></p>
					<p>State: <input class="form-control" type = "text" name = "state"></p>
					<p>Zip: <input class="form-control" type = "text" name = "zip"></p>
					<input class="btn btn-default" type = "submit" value = "Submit!">
				</form>


				<form action="/charge" method="post">

				  <script
				    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
				    data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
				    data-amount="30"
				    data-name="Rent Now"
				    data-description="Item Name for Price">
				  </script>

				</form>
			</div>
		</div>

	</body>
</html>