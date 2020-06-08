<?php
session_start();
include_once("../../dbCon.php");
$conn =connect();
if(isset($_POST['routes'])){
  $_SESSION['route_id'] = $_POST['routes'];
  header('Location:../addRouteInfo');
}

if(isset($_POST['schedule'])){
  $_SESSION['route_id'] = $_POST['route_id'];
  $_SESSION['train_id'] = $_POST['train_id'];
  header('Location:../addTimeschedule');
}
if((isset($_GET['route_id']))&&(isset($_GET['train_id']))){
  $r_id = $_GET['route_id'];
  $t_id = $_GET['train_id'];
  $sql = "SELECT `id` FROM `schedule_info` WHERE `route_id` = '$r_id' AND `train_id` = '$t_id'";
  $result= $conn->query($sql);
  $data = '0';
  foreach( $result as $row ){
    $data .=  $row['id'].',';
  }
  $data = rtrim($data,',');
  $_SESSION['data'] = $data;
  //print_r($_SESSION['data']);exit;
  header('Location:../edit_trainSchedule');
}
if(isset($_POST['staff_edit'])){
  $_SESSION['staff_id'] = $_POST['staff_id'];
  header('Location:../addStaff');
}

if(isset($_POST['edit_train_sc'])){
  $_SESSION['schedule_id'] = $_POST['schedule_id'];
  header('Location:../addTimeschedule');
}

if(isset($_POST['train_edit'])){
  $_SESSION['train_id'] = $_POST['train_id'];
  header('Location:../addTrainInfo');
}

if(isset($_POST['sent_mail'])){
  $_SESSION['mail'] = $_POST['mail'];
  $_SESSION['id'] = $_POST['id'];
  header('Location:../mailpassword');
}

 ?>
