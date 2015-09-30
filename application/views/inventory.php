<html>
	<head>
		<title>Users Inventory Page</title>
		<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.theme.css">
		<script type="text/javascript" src = "/assets/js/jquery.min.js"></script>
		<script type="text/javascript" src = "/assets/js/scripts.js"></script>
		<script type="text/javascript" src = "/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			var newwindow;
			function pop(url){
				newwindow=window.open(url,'Item Info','height=400,width=400');
				if (window.focus) {newwindow.focus()}
			}
		</script>
		<style>
			.center {
	    		text-align:center !important!;
			}
		</style>
	</head>
		<div class = "container-fluid">
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
<?php
	echo $this->session->flashdata("itemMessage");
	echo $this->session->userdata('itemMessage');
	$this->session->unset_userdata('itemMessage');
?>			
			<div class = 'row'>
				<div class = 'col-md-12'>
					<a href="javascript:pop('<?= "/lendings/viewAddItem/";?>')"><h3>Click to Add New Item</h3></a>
				</div>
			</div>
			<div class = 'row'>
				<div class = 'col-md-12'>
					<table class = 'table table-bordered table-hover table-condensed table-responsive' id = "userItems">
						<thead>
							<tr>
								<th>Item</th>
								<th>Description</th>
								<th>Stock</th>
								<th>Price</th>
								<th>Options</th>
							</tr>
						<tbody>

<?php
			for ($i = 0; $i < count($userItems); $i++) {
?>
							<tr>
								<td><?php echo $userItems[$i]['title']?></td>
								<td><?php echo $userItems[$i]['description']?></td>
								<td><?php echo $userItems[$i]['stock']?></td>
								<td><?php echo $userItems[$i]['price']?></td>
								<td>
									<a href="/lendings/editItem/<?php echo $userItems[$i]['item_id']?>">Edit</a>
									<a href="/lendings/removeItem/<?php echo $userItems[$i]['item_id']?>">Remove</a>
								</td>
							</tr>
<?php
			}
?>						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>