<?php
session_start();
include_once("../../dbCon.php");
$conn =connect();
if(isset($_POST['staffadd'])){
	$nid = $_POST['nid'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$sql = "SELECT N_id from national_id WHERE N_id  = '$nid'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$sql = "INSERT INTO `admin_user`(`NID`, `email`,`phone`) VALUES ('$nid','$email','$phone')";
		if ($conn->query($sql)) {
			$_SESSION['msg'] = "Added Successfully";
			header('Location:../viewStaffs');
		}else{
			$_SESSION['emsg'] = "Something Went Wrong";
		}

	}else{
		$_SESSION['emsg'] = "NID doesn't Exist";
		header('Location:../addStaff');
	}

}

if(isset($_POST['staffedit'])){
	$id = $_SESSION['staff_id'];
	$nid = $_POST['nid'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$sql = "SELECT N_id from national_id WHERE N_id  = '$nid'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$sql = "Update `admin_user` SET `NID` = '$nid', `email` = '$email' ,`phone` = '$phone' WHERE id = '$id'";
		if ($conn->query($sql)) {
			$_SESSION['msg'] = "Edited Successfully";
			header('Location:../viewStaffs');
		}else{
			$_SESSION['emsg'] = "Something Went Wrong";
		}

	}else{
		$_SESSION['emsg'] = "NID doesn't Exist";
		header('Location:../addStaff');
	}

}

?>
