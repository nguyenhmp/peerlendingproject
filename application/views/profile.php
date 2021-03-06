<html>
	<head>
		<title>User Profile</title>
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

<!-- <?php
	// var_dump($this->session->userdata());
	?> -->

	<body>
		<div class = "container-fluid">
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
				<div class="col-md-3 text-center">
					<div class="row">
						<div class="col-md-12">
							<img alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" class="img-circle" />
							<form class = "col-md-12 text-left">
								<input type="file" name="fileToUpload" id="fileToUpload">
    							<input type="submit" value="Upload Picture" >
							</form>
						</div>
					</div>

				</div>
				<div class="col-md-4">
					<dl class="dl-horizontal">
						<dt>Address</dt>
						<dd>
							<?php echo $this->session->userdata('address')['house_number'] . " " . $this->session->userdata('address')['street_name'] . " " . $this->session->userdata('address')['apt_number']?>
						</dd>
						<dd>
							<?php echo $this->session->userdata('address')['city'] . " " . $this->session->userdata('address')['state'] . " " . $this->session->userdata('address')['zip_code']?>
						</dd>
						<dt>Email</dt>
						<dd><?php echo $current['email'];?></dd>
						<dt> Number of Items</dt>
						<dd><?php echo count($userItems)?></dd>
						<dt>Overall Rating</dt>
							<dd>
<?php
		$sum = 0;
		for($i = 0; $i < count($userRating); $i++) {
			$sum = $sum + $userRating[$i]['num_stars'];
		}
			if (count($userRating) == 0) {
				echo "No Ratings for this user";
			} else {
				echo $sum / count($userRating);
			}
?>
							</dd>
						<dt><a href="/Lendings/edit">Edit Profile</a></dt>
					</dl>
				</div>

				<div class="col-md-4">
					<table class="table table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th>
									Date Added
								</th>
								<th>
									Name
								</th>
								<th>
									Comment
								</th>
								<th>
									Rating
								</th>
								<th>
									By
								</th>
								<th>
									Status
								</th>
							</tr>
						</thead>
						<tbody>
<?php
	for($i = count($userRating) - 1; $i >= 0; $i--) {
		if ($userRating[$i]['num_stars'] > 3) {
?>
			<tr class = "success">
<?php
			$rating = "Good!";
		} else if ($userRating[$i]['num_stars'] == 3) {
?>
		<tr>
<?php	
			$rating = "Okay";
		} else {
?>	
			<tr class="danger">
<?php	
			$rating = "BAD";
		}
?>
			<td><?php echo $userRating[$i]['created_at']?></td>
			<td><?php echo $userRating[$i]['title']?></td>
			<td><?php echo $userRating[$i]['comment']?></td>
			<td><?php echo $userRating[$i]['num_stars']?></td>
			<td><a href = "/lendings/viewProfile/<?php echo $userRating[$i]['createdBy_id']?>"><?php echo $userRating[$i]['createdBy_id']?></td>
			<td><?php echo $rating?></td>
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