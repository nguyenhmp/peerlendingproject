
<html>
	<head>
		<title>EDIT ITEM PAGE FOR USER</title>
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

		<div class = "container-fluid">
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-default" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
							</button> <a class="navbar-brand" href="/Lendings/welcome">Home</a>
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
			<div class = 'row'>
				<div class = 'col-md-12'>
					<form>
						<p>Item Name: <input class = 'form-control' type = "text" name = "name" value = "<?php echo $item['title']?>"></p>
						<p>Item Description: <input class = 'form-control' type = "text" name = "description" value = "<?php echo $item['description']?>"></p>
						<p>Item Status (in/out): <input class = 'form-control' type = "text" name = "status" value = "<?php echo $item['stock']?>"></p>
						<p>Item Suggested Price: <input class = 'form-control' type = "text" name = "price" value = "<?php echo $item['price']?>"></p>
						<p>Photo of Item <input class = 'form-control' type="file" name="fileToUpload" id="fileToUpload"></p>
						<input class='btn btn-primary' type = "submit" value = "Edit/Update">
						<a class='btn btn-primary' href="/lendings/removeItem/<?php echo $item['id']?>">Delete Item</a>
					</form>
				</div>

			</div>	

	</body>
</html>