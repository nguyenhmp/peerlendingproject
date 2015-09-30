<html>
<head>
	<title>Outbox</title>
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
		.msg{
			color:black;
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
			<div class="col-md-12 well"> 
              	<ul class="nav nav-stacked" id="sidebar">
                 	<li><a href="/Lendings/message" class="btn btn-default">Inbox »</a></li>
                  	<li><a href="/Lending/messageOut" class="btn btn-default">Outbox »</a></li>
                   	<li><a href='/Lendings/sendMessage' class="btn btn-default"> Compose Msg</a></li>
              	</ul>
  			</div>
		</div> <!--col-sm-3-->
		<div class="col-md-10">
			<div class = 'col-md-12 well'>
			<h2><?= $this->session->flashdata('success'); ?></h2>
			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr>
						<th>Date</th>
						<th>Sent to</th>
						<th>Subject</th>
						<th>Content</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

<?php
// class = 'clickable-row' data-href= "<?= '/lendings/messageDetails/' . $messages[$i]['id'];
	for ($i=0; $i < count($messages); $i++) { ?>
					<tr>
						<td><a class = 'msg' href="<?= '/lendings/messageDetails/' . $messages[$i]['msg_id'] . '/' .$messages[$i]['u_id'] ?> "><?= date('d M Y (g:i:s a)', strtotime($messages[$i]['sent_at'])); ?></a></td>
						<td ><a class = 'msg' href="<?= '/lendings/messageDetails/' . $messages[$i]['msg_id'] . '/' .$messages[$i]['u_id'] ?>"><?= $messages[$i]['fname'] . " " . $messages[$i]['lname']; ?></a></td>
						<td ><a class = 'msg' href="<?= '/lendings/messageDetails/' . $messages[$i]['msg_id'] . '/' .$messages[$i]['u_id'] ?>"><?= $messages[$i]['title']; ?></a></td>
						<td ><a class = 'msg' href="<?= '/lendings/messageDetails/' . $messages[$i]['msg_id'] . '/' .$messages[$i]['u_id'] ?>"><?= $messages[$i]['content']; ?></a></td>
						<td ><select id = 'action' onchange="window.location.href=this.value">
								<option value="" disabled selected>Choose an action</option>
								<option value = "<?= '/lendings/deleteMessage/' . $messages[$i]['msg_id'] . '/' .$messages[$i]['u_id']?>">Delete</option>
							</select>
						</td>
					</tr>
<?php
	}
?>				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
</body>
</html>