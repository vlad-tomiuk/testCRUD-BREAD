<?php 	
// Include config file
include 'config.php';
global $conn;
if(isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['id']) && !empty($_POST['id'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM `ingredients` WHERE `ingredients`.`id` = " . $id;	
		$result = mysqli_query($conn, $sql);
		if($result){
			echo 'true';
		}else{
			echo 'false';
		}
	}
}
?>