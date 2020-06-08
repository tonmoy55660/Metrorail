<?php
session_start();
include_once("../../dbCon.php");
$conn =connect();
if(isset($_POST['save'])){
	$station = $_POST['stationName'];
	$stationMaster = $_POST['masterID'];
		$sql = "INSERT INTO `stationinfo`(`stationName`, `stationMasterID`)
						VALUES ('$station','$stationMaster')";
						echo $sql;
		if ($conn->query($sql)) {
			$_SESSION['msg'] = "Added Successfully";
			header('Location:../viewStation');
		}else{
			$_SESSION['emsg'] = "Something Went Wrong!";
		}

	}

	if(isset($_POST['edit'])){
		$id=$_POST['id'];
		$station = $_POST['stationName'];
		if(isset($_POST['masterID'])){
		$stationMaster = $_POST['masterID'];
	}else{
		$stationMaster = $_POST['stationMid'];
	}
			$sql = "UPDATE `stationinfo` SET `stationName`='$station',`stationMasterID`='$stationMaster' WHERE id='$id'";
			if ($conn->query($sql)) {
				$_SESSION['msg'] = "Edited Successfully";
				header('Location:../viewStation');
			}else{
				$_SESSION['emsg'] = "Something Went Wrong!";
			}

		}

?>
