<html>
	<head>
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

<?php
	// var_dump($item);
?>
	<body>
		<h2>Item Name: <?php echo $item['title']?></h2>
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
		<a class='btn btn-primary'  href="<?= '/lendings/requestItem/' . $item['item_id']?>">Request</a>

<?php
	echo $this->session->flashdata('ratingMessage');
?>
			
		<h2> ITEM RATINGS/COMMENTS with HISTORY of RENT</h2>
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
	for($i = count($itemRating) - 1; $i >= 0; $i--) {
		if ($itemRating[$i]['num_stars'] > 3) {
?>
			<tr class = "success">
<?php
			$rating = "Good!";
		} else if ($itemRating[$i]['num_stars'] == 3) {
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
			<td><?php echo $itemRating[$i]['created_at']?></td>
			<td><?php echo $itemRating[$i]['title']?></td>
			<td><?php echo $itemRating[$i]['comment']?></td>
			<td><?php echo $itemRating[$i]['num_stars']?></td>
			<td><a href = "/lendings/viewProfile/<?php echo $itemRating[$i]['createdby_id']?>"><?php echo $itemRating[$i]['createdby_id']?></td>
			<td><?php echo $rating?></td>
		</tr>
<?php
	}
?>
					</tbody>
				</table>	
			<form action = "/lendings/addItemRating/<?php echo $item['item_id'] ?>" method = "post">
				<h2>Add Item Rating</h2>
				<p>Item Title <input class = 'form-control' type = "text" name = "title"></p>

				<p>Comment <textarea class = 'form-control'name = "comment"></textarea></p>
				<p>Number of Stars <input class = 'form-control'type = "text" name = "stars"></p>
				<p><input class = 'btn btn-default' type = "submit" value = "Submit"></p>
			</form>

	</body>
</html>