<?php  
// Include config file
include 'config.php';
global $conn;
if(isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST"){

	$errors = array();
	if(!empty($_POST['count']) && is_numeric($_POST['count'])){
		$count = $_POST['count'];
	}else{
		array_push($errors, 'Variable count is not a number');
	}
	if(!empty($_POST['unit'])){
		$unit = stripslashes($_POST['unit']);
	}else{
		array_push($errors, 'Variable unit empty');
	}
	if(!empty($_POST['product'])){
		$product = stripslashes($_POST['product']);
	}else{
		array_push($errors, 'Variable product empty');
	}

	if(count($errors) < 1){
		$sql = "INSERT INTO ingredients (count, unit, product) VALUES ('".$count."', '".$unit."', '".$product."')";
		$result = mysqli_query($conn, $sql);
		if($result){
			$id_product = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(`id`) FROM ingredients")))['MAX(`id`)'];
		?>
		<tr>
			<th><?php echo $id_product; ?></th>
			<th>
				<input type="text" name="edit-count" value="<?php echo $count; ?>">	
			</th>
			<th>
				<input type="text" name="edit-unit" value="<?php echo $unit; ?>">		
			</th>
			<th>
				<input type="text" name="edit-product" value="<?php echo $product; ?>">		
			</th>
			<th>
				<form method="POST">
					<input hidden name="id_product" value="<?php echo $table['id']; ?>">
					<input type="submit" name="edit-product" value="Save Edited">
				</form>
				<a onclick="deleteProduct(this);" href="javascript:;" data-id_product="<?php echo $id_product; ?>">Delete</a>
			</th>
		</tr>	
	<?php		
		}
	}
}	
?>