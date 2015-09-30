<html>
	<head>
		<title><?php echo $current['first_name'] . " " . $current['last_name'] . "'s"?> 'Lending' Page</title>
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
							</button> <a class="navbar-brand" href="">Home</a>
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
					<h2> Active Items </h2>
<?php
					if(count($approvedReq>0)){
?>
					<div class = 'col-md-4'> 
						<h4><b> You have <?= count($approvedReq) ?> request approved. Please remember to deliver your items</b></h4>
							<table class="table table-striped table-bordered table-hover table-condensed">
								<thead>
									<th>Item</th>
									<th>Rental Start</th>
									<th>Rental End</th>
									<th>Request By:</th>
									<th>Action</th>
								<thead>
								<tbody>
<?php
							for ($i=0; $i < count($approvedReq); $i++) { 
?>
									<tr>
										<td><?= $approvedReq[$i]['title'] ;?> </td>
										<td><?= date('d M Y', strtotime($approvedReq[$i]['start_date'])) ;?> </td>
										<td><?= date('d M Y', strtotime($approvedReq[$i]['end_date'])) ;?> </td>
										<td><?= $approvedReq[$i]['first_name'] . " " . $approvedReq[$i]['last_name']  ;?> </td>
										<td><a href=""> Accept </a> | <a href="">Decline</a> | <a href=""> Sendmessage  </a></td>
									</tr>
<?php
							}
?>
								</tbody>
<?php
						}
?>	
							</table>
					</div>					
<?php
					if(count($unapprovedReq>0)){
?>
					<div class = 'col-md-4'> 
						<h4><b>You have <?= count($unapprovedReq) ?> request unreplied.</b></h4>

							<table class="table table-striped table-bordered table-hover table-condensed">
								<thead>
									<th>Item</th>

									<th>Rental Start</th>
									<th>Rental End</th>
									<th>Request By:</th>
									<th>Action</th>
								<thead>
								<tbody>
<?php
							for ($i=0; $i < count($unapprovedReq); $i++) { 
?>
									<tr>
										<td><?= $unapprovedReq[$i]['title'] ;?> </td>
										<td><?= date('d M Y', strtotime($unapprovedReq[$i]['start_date'])) ;?> </td>
										<td><?= date('d M Y', strtotime($unapprovedReq[$i]['end_date'])) ;?> </td>
										<td><?= $unapprovedReq[$i]['first_name'] . " " . $unapprovedReq[$i]['last_name']  ;?> </td>
										<td> Delivered | returned | <a href ="/lendings/payPage">Pay</a> </td>
									</tr>
<?php
							}
?>

								</tbody>
							</table>
<?php
						}
?>		
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h2>Search PLP inventory</h2>
					<form>
						<p>Name: <input class="form-control" type = "text" name = "name"></p>
						<p>Item: <input class="form-control" type = "text" name = "item"></p>
						<input class="btn btn-default" type = "submit" value = "Find">
					</form>

					<!-- Display Out items on bottom-->		
					<p>Sort By: Ratings, Price, Status (maybe use)</p>
					<table class="table table-striped table-bordered table-hover table-condensed">
						<th>User</th>
						<th>Item</th>
						<th>Description</th>
						<th>Status</th>
						<th>Suggested Price</th>
						<th>User Rating</th>
						<th>Item Rating</th>
						<th>Action</th>
<?php
	for ($i = count($otherItems) - 1; $i >=0; $i--) {
?>
						<tr>
							<td><a href = "/lendings/viewProfile/<?php echo $otherItems[$i]['users_id']?>"><?php echo $otherItems[$i]['users_id']?></a></td>
							<td><a href="javascript:pop('<?= "/lendings/viewItem/" . $otherItems[$i]['id'];?>')"><?php echo $otherItems[$i]['title']?></a></td>
							<td><?php echo $otherItems[$i]['description']?></td>
							<td><?php echo $otherItems[$i]['stock']?></td>
							<td><?php echo $otherItems[$i]['price']?></td>
							<td>
<?php
		$sumRating = 0;
		$count = 0;
		for ($j = 0; $j < count($otherRatings); $j++) {
			if ($otherRatings[$j]['users_id'] == $otherItems[$i]['users_id']) {
				$sumRating = $sumRating + $otherRatings[$j]['num_stars'];
				$count++;
			}
		}
			if ($count == 0) {
				$count = 1;
			}
?>

							<?php echo ($sumRating / $count)?>
							</td>
							<td>
<?php
		$itemSum = 0;
		$count2 = 0;
		for ($j = 0; $j < count($allItemRatings); $j++) {
			if ($otherItems[$i]['id'] == $allItemRatings[$j]['items_id']) {
				$itemSum = $itemSum + $allItemRatings[$j]['num_stars'];
				$count2++;
			}
		}
			if ($count2 == 0) {
				$count2 = 1;
			}
?>
							<?php echo ($itemSum / $count2)?>
							</td>
							<td><a href="<?= '/lendings/requestItem/' . $otherItems[$i]['id'] ;?>">Request</a></td>
						</tr>
<?php
	}
?>
					</table>
					<h3>Popular Items</h3>

				</div>
			</div>
		</div>
	</body>
</html>