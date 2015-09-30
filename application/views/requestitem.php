<html>
<head>
	<title>Request Form</title>
		<title>View other Users Items</title>
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
		<h2>Name: <?php echo $item['title']?></h2>
		<table class = 'table table-hover'>
		  	<tr>
			    <th>Photo of Item</th>
			    <td>no photo</td>
		  	</tr>
		  	<tr>
		    	<th>Description</th>
		    	<td><?php echo $item['description']?></td>
		  	</tr>
		  	<tr>
		   	 	<th>Status (in/out)</th>
		    	<td><?php echo $item['stock']?></td>
		 	</tr>

		 	<tr>
		    	<th> Suggested Price:</th>
		    	<td><?php echo $item['price']?></td>
		  	</tr>
		  	<tr>
		   	 	<th>Owner of Item</th>
		    	<td><?php echo $item['email']?></td>
		 	</tr>  
		</table>
		<h2> Request Form </h2>
		<h5> <?= $this->session->flashdata('errors') ?></h5>
		<form action = '/lendings/sendRequest' method = 'post'>
			<input type = 'hidden' value ="<?= $item['item_id']?>" name = 'item_id'>
			<input type = 'hidden' value ="<?= $item['id']?>;" name = 'owner_id'>
			<input type = 'hidden' value ="<?= $item['title']?>" name = 'title'>
			<label>Start Date</label>
			<input type = 'date' name = 'start_date' class = 'form-control'>
			<label>End Date</label>
			<input type = 'date' name = 'end_date' class = 'form-control'>
			<label>Offer price</label>
			<input type = 'int' name = 'price' class = 'form-control'>
			<input type = 'submit' name = 'Send request' class='btn btn-primary'>
		</form>
	</body>
</html>