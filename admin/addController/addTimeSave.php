<?php
session_start();
include_once("../../dbCon.php");
$conn =connect();
if(isset($_POST['ts_add'])){
  function generateRandomString()  {
    $characters = '123456789';
    $length = 6;
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
  $id = generateRandomString();
  $r_id = $_SESSION['route_id'];
  $t_id = $_SESSION['train_id'];
  $arrivals = $_POST['arrival'];
  $departures = $_POST['departure'];
  $station = $_POST['station'];

  $total = sizeof($station);
  $sql="INSERT INTO `schedule_info`(`id`, `route_id`, `train_id`) VALUES ('$id','$r_id','$t_id')";
  $conn->query($sql);
  for($i=0;$i<$total;$i++) {
    $arr = $arrivals[$i];
    $dep = $departures[$i];
    $st = $station[$i];
    $query = "INSERT INTO `time_schedule`( `schedule_id`, `arrival_time`, `departure_time`,`station_id`)
    VALUES ('$id','$arr','$dep',$st)";;
    $conn->query($query);
  }
  $_SESSION['msg'] = "Added Successfully";
  header('Location:../viewSchedule');
}

if(isset($_POST['ts_edit'])){
  $id = $_SESSION['schedule_id'];
  $arrivals = $_POST['arrival'];
  $departures = $_POST['departure'];
  $station = $_POST['station'];
  $total = sizeof($station);
  for($i=0;$i<$total;$i++) {
    $arr = $arrivals[$i];
    $dep = $departures[$i];
    $st = $station[$i];
    $query = "UPDATE `time_schedule` SET `arrival_time`= '$arr' , `departure_time`='$dep' WHERE schedule_id = '$id' AND station_id = '$st' ";
    $conn->query($query);
  }
  $_SESSION['msg'] = "Edited Successfully";
  header('Location:../viewSchedule');
}


?>
