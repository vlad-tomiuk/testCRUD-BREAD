<?php  
// Include config file
include 'config.php';
global $conn; 	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test</title>
	<style>
	a{
		color: #df1b1b;
	}
	table, td, th {
	  border: 1px solid;
	}
	tr:nth-child(even),
	tr:nth-child(even) input{
		background-color: #dfdfdf;
	}
	.edit_product input[name=edit-product]{
		color: #45af23;
    	font-weight: 700;
    	width: 100%;
	}
	table {
	  width: 50%;
	  margin: 0 auto;
	  border-collapse: collapse;
	}
	table input{
		text-align: center;
		border: none;
		background: #fff;
	}
	table input:hover{
		cursor: pointer;
	}
	.add_product{
		width: fit-content;
		margin: 10px auto 0 auto;
	}
	.info-error,
	.info-good{
		display: none;
	    margin: 10px auto;
	    text-align: center;
	    width: 602px;
	    padding: 15px;
	    border-radius: 5px;    
	}
	.info-error{
		background: #ffdbdb;
	    border: 1px solid #fbbebe;
	    color: #a11a1a;	
	}
	.info-good{
		background: #a8dfaf;
    	border: 1px solid #6cb360;
		color: #49761f;
	}
</style>
</head>
<body>
	<table class="table">
		<tr>
			<th>ID</th>
			<th>Count</th>
			<th>Unit</th>
			<th>Product</th>
			<th>Settings</th>
		</tr>
		<?php 
			$sql = "SELECT * FROM `ingredients`";
			$result = mysqli_query($conn, $sql);
			if($result){
				if(mysqli_num_rows($result) != 0){	
					while ($table = mysqli_fetch_assoc($result)) {
					?>	
					<tr>
						<th><?php echo $table['id']; ?></th>
						<th>
							<input type="text" name="edit-count" value="<?php echo $table['count']; ?>">
						</th>
						<th>
							<input type="text" name="edit-unit" value="<?php echo $table['unit']; ?>">		
						</th>
						<th>
							<input type="text" name="edit-product" value="<?php echo $table['product']; ?>">		
						</th>
						<th>
							<form class="edit_product" method="POST">
								<input hidden name="id_product" value="<?php echo $table['id']; ?>">
								<input type="submit" name="edit-product" value="Save Edited">
							</form>
							<a onclick="deleteProduct(this);" href="javascript:;" data-id_product="<?php echo $table['id']; ?>">Delete</a>
						</th>
					</tr>
					<?php  
					}
				}
			}
		?>	
	</table>
	<form class="add_product" method="POST">
		<input type="text" name="count" placeholder="Count">
		<input type="text" name="unit" placeholder="Unit">
		<input type="text" name="product" placeholder="Product">
		<input type="submit" name="add_product" value="Add Product">
	</form>
	<span class="info-error"></span>
	<span class="info-good"></span>
<script src="main.js"></script>
</body>
</html>
