<?php
session_start();
include_once("../../dbCon.php");
$conn =connect();
if(isset($_POST['train_add'])){
	$train_name = $_POST['train_name'];
	$seat = $_POST['seat'];
		$sql = "INSERT INTO `train_info`(`train_name`, `total_seat`) VALUES ('$train_name','$seat')";
		if ($conn->query($sql)) {
			$_SESSION['msg'] = "Added Successfully";
			header('Location:../viewTrain');
		}else{
			$_SESSION['emsg'] = "Something Went Wrong";
      header('Location:../addTrainInfo');
		}
}


if(isset($_POST['train_edit'])){
	$id = $_SESSION['train_id'];
	$train_name = $_POST['train_name'];
	$seat = $_POST['seat'];
		$sql = "Update `train_info` SET `train_name`='$train_name', `total_seat` = '$seat' WHERE id = '$id'";
		if ($conn->query($sql)) {
			$_SESSION['msg'] = "Edited Successfully";
			header('Location:../viewTrain');
		}else{
			$_SESSION['emsg'] = "Something Went Wrong";
      header('Location:../addTrainInfo');
		}
		unset($_SESSION['train_id']);
}
?>
