<?php
session_start();
include_once("../../dbCon.php");
$conn =connect();
if(isset($_POST['save'])){
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
	$name = $_POST['routeName'];
	$station = $_POST['station'];
	$totalUsername = sizeof($station);
	if($totalUsername==$_SESSION['length']){
		$sql="INSERT INTO routes_info (id,routesName) VALUES('$id','$name')";
		$conn->query($sql);
					for($i=0;$i<$totalUsername;$i++) {
						$j = $i+1;
						$sta = $station[$i];
						$query = "INSERT INTO `routes_order`(`route_id`,`ordering`,`station_id`) VALUES ('$id','$j','$sta')";
						$conn->query($query);
					}
				$_SESSION['msg'] = "Added Successfully";
				header('Location:../viewRoutes');
		}else{
			$_SESSION['emsg'] = "Please Select All the stations";
			header('Location:../addRouteInfo');

		}
	}
	if(isset($_POST['rou_id'])){
	$id = $_POST['rou_id'];
	$sql = "SELECT * FROM routes_order as r , stationinfo as s where s.id = r.station_id AND route_id='$id' Order By ordering ASC ";
	$result = $conn->query($sql);
	while($row=mysqli_fetch_array($result)){
		echo "<li>";
		echo "<i class='fa fa-hand-o-down bg-blue'></i>";
		echo "<div class='row col-xs-12'>";
		echo "<div class='col-xs-6'>";
		echo "<h4 style='margin-left:50px;color:blue;' ><i class='fa fa-long-arrow-down'></i> Stopage Number ".$row['ordering']." :</h4>";
		echo "</div>";
		echo "<div class='col-xs-6'>";
		echo "<h4><b>".$row['stationName']." </b></h4>";
		echo "</div>";
		echo "</div>";
		echo "</li>";
		echo "</br>";
	}
	exit;

}

if(isset($_POST['edit'])){
	$id = $_POST['r_id'];
	$name = $_POST['routeName'];
	$station = $_POST['station'];
	$totalUsername = sizeof($station);
	if($totalUsername==$_SESSION['length']){
		$sql="UPDATE `routes_info` SET `routesName`='$name' WHERE id='$id'";
		$delete = "DELETE FROM `routes_order` WHERE route_id = '$id'";
		$conn->query($sql);
		$conn->query($delete);
					for($i=0;$i<$totalUsername;$i++) {
						$j = $i+1;
						$sta = $station[$i];
						$query = "INSERT INTO `routes_order`(`route_id`,`ordering`,`station_id`) VALUES ('$id','$j','$sta')";

						$conn->query($query);
					}
				$_SESSION['msg'] = "Edited Successfully";
				header('Location:../viewRoutes');
		}else{
			$_SESSION['emsg'] = "Please Select All the stations";
			header('Location:../addRouteInfo');

		}

}

?>
