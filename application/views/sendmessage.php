

<html>
<head>
	<title>Inbox</title>
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
                 	<li><a href="/Lendings/message" class="btn btn-default">Inbox »</a></li>
                  	<li><a href="/Lendings/messageOut" class="btn btn-default">Outbox »</a></li>
                   	<li><a href='/Lendings/sendMessage' class="btn btn-default"> Compose Msg</a></li>
              	</ul>
  			</div>
		</div> <!--col-sm-3-->
		<div class="col-sm-10">
			<?= $this->session->flashdata('error');?>
			<div class="col-sm-12 well">
				<form class="form-horizontal" role="form" method="post" action="/Lendings/sendingMessage">
				    <div class="form-group">
				        <label for="name" class="col-sm-1 control-label">Name</label>
				        <div class="col-sm-11">
				            <input type="text" class="form-control" id="name" name="name" placeholder="Name"  value="<?= $info['fname'] . " " . $info['lname']?>">
				        </div>
				    </div>
				    <div class="form-group">
				        <label for="email" class="col-sm-1 control-label">Email</label>
				        <div class="col-sm-11">
				            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $info['email']?>">
				        </div>
				    </div>
				    <div class="form-group">
				        <label for="email" class="col-sm-1 control-label">Subject</label>
				        <div class="col-sm-11">
				            <input type="text" class="form-control" id="email" name="title" placeholder="Subject" value="<?= $info['title']?>">
				        </div>
				    </div>
				    <div class="form-group">
				        <label for="message" class="col-sm-1 control-label">Message</label>
				        <div class="col-sm-11">
				            <textarea class="form-control" rows="4" name="message"></textarea>
				        </div>
				    </div>

				    <div class="form-group">
				    	<div class = 'col-sm-1'>
				    	</div>
				        <div class="col-sm-11">
				        	<div class="col-sm-12 well">
					        	<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
					        	<a id = "right" href='/lendings/messages' class="btn btn-default navbar-right"> Back to inbox »</a>
					   		</div>
				        </div>

				    </div>
				</form>

			</div>
		</div>
	</div>
</div>
</body>
</html>