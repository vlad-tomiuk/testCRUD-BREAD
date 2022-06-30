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
		array_push($errors, 'Variable unit is empty');
	}
	if(!empty($_POST['product'])){
		$product = stripslashes($_POST['product']);
	}else{
		array_push($errors, 'Variable product is empty');
	}

	if(count($errors) < 1){
		$sql = "INSERT INTO ingredients (count, unit, product) VALUES ('".$count."', '".$unit."', '".$product."')";
		$result = mysqli_query($conn, $sql);
		if($result){
			$id_product = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(`id`) FROM ingredients")))['MAX(`id`)'];
			$response = array(
				'id' => $id_product,
				'status' => true,
				'count'=> $count,
				'unit' => $unit,
				'product'=> $product,
				'errors' => 'Ingredient added successfully'
			);
		}else{
			$response = array(
				'id' => '',
				'status' => false,
				'count'=> '',
				'unit' => '',
				'product'=> '',
				'errors' => 'Bad database entry!'
			);
		}
	}else{
		$response = array(
			'id' => '',
			'status' => false,
			'count'=> '',
			'unit' => '',
			'product'=> '',
			'errors' => $errors
		);
	}
	echo json_encode($response);
}	
?>