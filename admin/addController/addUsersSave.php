<?php
session_start();
include_once("../../dbCon.php");
$conn =connect();
if(isset($_POST['user_add'])){
	$nid = $_POST['nid'];
	$card_no = $_POST['card_no'];
	$email = $_POST['email'];
	$sql = "SELECT N_id from national_id WHERE N_id  = '$nid'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$sql = "INSERT INTO `users_info`(`NID`, `card_no`,`user_mail`) VALUES ('$nid','$card_no','$email')";

		if ($conn->query($sql)) {
			$_SESSION['useremail'] = $_POST['email'];
			header('Location:../mailPassword');
		}else{
			$_SESSION['emsg'] = "Something Went Wrong";
      header('Location:../addUsers');
		}
	}else{
		$_SESSION['emsg'] = "NID doesn't Exist";
		header('Location:../addUsers');
	}
}
?>
