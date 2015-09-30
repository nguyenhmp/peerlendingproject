<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
	<title>Welcome to the PLP</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.theme.css">
	<script type="text/javascript" src = "/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src = "/assets/js/scripts.js"></script>
	<script type="text/javascript" src = "/assets/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
						</button> <a class="navbar-brand" href="/Lendings/companyInfo">PLP</a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li>
								<a href="/Lendings/createrInfo">About the Creator</a>
							</li>
						</ul>
						<form class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input type="text" class="form-control" / placeholder = "Find tools/people around you!">
							</div> 
							<button type="submit" class="btn btn-default">
								Search!
							</button>
						</form>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="Lendings/registration">Register</a>
							</li>
						</ul>
						<form class="navbar-form navbar-right" role="search" action = "/lendings/welcome" method = "post">
                   			<div class="form-group">
                        		<input type="text" class="form-control" name="email" placeholder="Email">
                    		</div>
                    		<div class="form-group">
                        		<input type="password" class="form-control" name="password" placeholder="Password">
                    		</div>
                    			<button type="submit" class="btn btn-default">Sign In</button>
                		</form>
					</div>
				</nav>
				<div class="jumbotron well">
					<h2>
						Welcome to the Peer Lending Project!
					</h2>
					<p>
						We are a crowd-inventoried service for any tools, equipment or service you need. If this is your first time, see what we have to offer!
					<p>
						<a class="btn btn-primary btn-large" href="/Lendings/registration">Sign Up!</a>
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<h2>
					Save Money
				</h2>
				<p>
					No need to purchase or rent from the big big boys, renting from the local people around you will ensure you are given the best competitive price for the tools you need
				</p>
				<p>
					<a class="btn" href="#">Compare our prices vs those around you»</a>
				</p>
			</div>
			<div class="col-md-4">
				<h2>
					Save Time
				</h2>
				<p>
					With the right tool, you can easily complete your task whether it is building the fence or just renovating your homes
				</p>
				<p>
					<a class="btn" href="#">See what Chuck has to say!»</a>
				</p>
			</div>
			<div class="col-md-4">
				<h2>
					Meet people
				</h2>
				<p>
					People everywhere are doing the same task you are! Need help on a project? Someone can help!
				</p>
				<p>
					<a class="btn" href="#">Sign up now! »</a>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="carousel slide" id="carousel-642371">
					<ol class="carousel-indicators">
						<li class="active" data-slide-to="0" data-target="#carousel-642371">
						</li>
						<li data-slide-to="1" data-target="#carousel-642371">
						</li>
						<li data-slide-to="2" data-target="#carousel-642371">
						</li>
					</ol>
					<div class="carousel-inner">
						<div class="item active">a
							<img alt="Carousel Bootstrap First" src="http://lorempixel.com/output/sports-q-c-1600-500-1.jpg" />
							<div class="carousel-caption default">
								<h4>
									"We didnt have a cricket bat but somebody did!"
								</h4>
								<p>
									Thank goodness!
								</p>
							</div>
						</div>
						<div class="item">
							<img alt="Carousel Bootstrap Second" src="http://lorempixel.com/output/sports-q-c-1600-500-2.jpg" />
							<div class="carousel-caption">
								<h4>
									Picked up a surfboard while I was on vacation!
								</h4>
								<p>
									Beats renting per hour!
								</p>
							</div>
						</div>
						<div class="item">
							<img alt="Carousel Bootstrap Third" src="http://lorempixel.com/output/sports-q-c-1600-500-3.jpg" />
							<div class="carousel-caption">
								<h4>
									I rented locally for biking equipment after a sudden break down
								</h4>
								<p>
									If it wasnt for PLP, I wouldn't have won the Tour de France!
								</p>
							</div>
						</div>
					</div> <a class="left carousel-control" href="#carousel-642371" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-642371" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>