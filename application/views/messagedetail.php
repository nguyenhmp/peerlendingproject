<?php var_dump($message)?>

<html>
<head>
	<title>Inbox</title>
	<meta charset = 'utf-8'>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.theme.css">
	<script type="text/javascript" src = "/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src = "/assets/js/scripts.js"></script>
	<script type="text/javascript" src = "/assets/js/bootstrap.min.js"></script>
	<script>
		jQuery(document).ready(function($) {
			$(".clickable-row").click(function() {
			    window.document.location = $(this).data("href");
			});
		});
	</script>
	<style>
		#right{
			margin-right: 0px;
		}
		.center {
    		text-align:center !important!;
		}
	</style>
</head>
<body>
<div class="container-fluid">
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
		<div class="col-md-2"> 	
			<div class="well"> 
              	<ul class="nav nav-stacked" id="sidebar">
                  <li><a href="/Lendings/message">Inbox</a></li>
                  <li><a href="/Lending/messageOut">Outbox</a></li>
                  <li><a href='/Lendings/sendMessage'> Compose Message</a></li>
              	</ul>
  			</div>
		</div>
		<div class="col-md-10">
				<div class = 'col-md-12 well'>
				<h1><?= $message['title'];?></h1>
				<p><span><h3>Sent by <?= $message['fname'] . " " . $message['lname'] . " at " . $message['sent_at'] ; ?></h3></span></p>
				<div class = "col-md-11">
					<p><span><h5> <?= $message['content'] ; ?></h5></span></p>
				</div>
			<div class = 'col-md-12 well'>
			<a href="<?= '/lendings/reply/' . $message['msg_id'] . '/' .$message['u_id']?>" class="btn btn-default"> reply » </a>
			<a onclick="return confirm('Are you sure you want to delete this message？')" href="<?= '/lendings/deleteMessage/' . $message['msg_id'];?>" class="btn btn-default"> delete » </a>
			<a id = "right" href='/lendings/messages' class="btn btn-default navbar-right"> Back to inbox »</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>