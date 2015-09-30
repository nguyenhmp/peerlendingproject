<html>
	<head>
		<title>Add Inventory Page</title>
		<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.theme.css">
		<script type="text/javascript" src = "/assets/js/jquery.min.js"></script>
		<script type="text/javascript" src = "/assets/js/scripts.js"></script>
		<script type="text/javascript" src = "/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		    window.onunload = refreshParent;
		    function refreshParent() {
		        window.opener.location.reload();
		    }	
    	</script>
	</head>
<body>
<div class = 'container-fluid'>
	<div class = 'row'>
		<div class = 'col-md-12'>
			<?= $this->session->flashdata('itemMessage', validation_errors());?>
			<form class = 'form-inline' action = "/lendings/addItem" method = "post">
				<p>Item Name: <input class = 'form-control' type = "text" name = "name"></p>
				<p>Item Description: <input class = 'form-control' type = "text" name = "description"></p>
				<p>Item Status (in/out): <input class = 'form-control' type = "text" name = "status"></p>
				<p>Item Suggested Price: <input class = 'form-control' type = "text" name = "price"></p>
				<p>Photo of Item <input type="file" name="fileToUpload" id="fileToUpload"></p>
				<input type = "submit" class='btn btn-primary' value = "Add Item">
			</form>
		</div> 
	</div>
</div>
</body>
</html>