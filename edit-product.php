<?php 	
// Include config file
include 'config.php';
global $conn;
if(isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['id']) && !empty($_POST['id'])){
		$id = $_POST['id'];
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
			$sql = "UPDATE `ingredients` SET `count` = '".$count."', `unit` = '".$unit."', `product` = '".$product."' WHERE `ingredients`.`id` = ".$id;	
			$result = mysqli_query($conn, $sql);
			if($result){
				$response = array(
					'status' => true,
					'errors' => 'Ingredient edited successfully'
				);
			}else{
				$response = array(
					'status' => false,
					'errors' => 'Bad database entry!'
				);
			}
		}else{
			$response = array(
				'status' => false,
				'errors' => $errors
			);
		}
		echo json_encode($response);
	}
}
?>