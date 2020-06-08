<?php
session_start();
include_once("dbCon.php");
$conn =connect();
if(isset($_POST['search'])){
  $source = $_POST['source'];
  $_SESSION['source'] = $_POST['source'];
  $des = $_POST['destination'];
  $_SESSION['destination'] = $_POST['destination'];

  $_SESSION['time'] = $_POST['time'];

  $sql = "select ordering, route_id from routes_order where station_id = '$source'";
  $result = $conn->query($sql);
  $array;
  while($row=mysqli_fetch_array($result)){
    $array[] = [
      'ordering'=>$row['ordering'],
      'route'=>$row['route_id'],
    ];
  };
  $sql1 = "select ordering, route_id from routes_order where station_id = '$des'";
  $result1 = $conn->query($sql1);
  $array;
  while($row1=mysqli_fetch_array($result1)){
    $array1[] = [
      'ordering1'=>$row1['ordering'],
      'route1'=>$row1['route_id'],
    ];
  }
  $a =  json_encode($array);
  $b =  json_encode($array1);
  echo '<script>
  for(var i=0;i<'.$a.'.length ;i++){
    var a =('.$a.'[i].ordering) - ('.$b.'[i].ordering1);
    if(a < 0){
      var kj = ('.$a.'[i].route);
      window.location.href = "http://localhost/metrorail/index?query_id=" + kj;
    }
  }
  </script>';


}

if(isset($_POST['calculate'])){
  $_SESSION['source'] = $_POST['source'];
  $_SESSION['destination'] = $_POST['destination'];
  header('Location:fareMeter');
}


?>
