<?php
session_start();
include_once("../../dbCon.php");
$conn =connect();
if(isset($_POST['fairsave'])){
	$source = $_POST['sourceID'];
	$destination = $_POST['desID'];
	$dis = $_POST['distance'];
  $base = $_POST['baseFair'];
  $fair_per = $_POST['fair_per'];
  $query = "UPDATE `base_fair` SET `base_fair`='$base' WHERE id = 1";
	$q = "UPDATE `fair_per_km` SET `fair`='$fair_per' WHERE id = 1";
  $conn->query($query);
  $conn->query($q);
  $total = sizeof($source);
  $sql="TRUNCATE TABLE distance";
  $conn->query($sql);
          for($i=0;$i<$total;$i++) {
            $src = $source[$i];
            $des = $destination[$i];
            $fr = $dis[$i];
            $query = "INSERT INTO `distance`(`source_station_id`, `des_station_id`, `distance`)
                      VALUES ('$src','$des','$fr')";;
            $conn->query($query);
          }
        $_SESSION['msg'] = "Edited Successfully";
        header('Location:../viewFair');
    }
