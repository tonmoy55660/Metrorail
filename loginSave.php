<?php
session_start();
include_once("dbCon.php");
$conn =connect();

if(isset($_POST["submit"])){
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, md5($_POST['password']));

$sql=" SELECT id, NID, user_mail FROM users_info where user_mail ='$email' AND password='$password' AND isAccepted=1 ";
            $result = $conn->query($sql);
              if($result->num_rows>0){
	               $_SESSION['isLogged']=TRUE;
					foreach($result as $row){
							$_SESSION['id']=$row['id'];
							$_SESSION['NID']=$row['NID'];
							$_SESSION['card_no']=$row['card_no'];
							$_SESSION['user_mail']=$row['user_mail'];
            }

	header('Location:index');
}else{
	$_SESSION['lmsg']="invalid login";
	header('Location:login');
}
}

?>
