<?php
session_start();
include_once("../dbCon.php");
$conn =connect();

if(isset($_POST["login"])){
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, md5($_POST['password']));

$sql=" SELECT * FROM admin_user where email ='$email' AND password='$password'";
            $result = $conn->query($sql);
              if($result->num_rows>0){
	               $_SESSION['isLoggedIn']=TRUE;
					foreach($result as $row){
							$_SESSION['email']=$row['email'];
							$_SESSION['role']=$row['role'];
            }

	header('Location:dashboard');
}else{
	$_SESSION['lmsg']="invalid login";
	header('Location:index');
}
}elseif($valid==false){
	$_SESSION['lmsg']="invalid login";
	header('Location:index');

}
?>
