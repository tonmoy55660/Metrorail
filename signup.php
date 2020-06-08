<?php
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("dbCon.php");
$conn =connect();
?>
<?php
if(isset($_POST['user_add'])){
	$nid = $_POST['nid'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);

  /* 1st Image upload  */
  if(isset($_FILES["imageup1"]["name"]) && $_FILES["imageup1"]["name"] != ''){
    $target_dir = "assets/";
    $img1 = date('YmdHis_');
    $img1 .= basename($_FILES["imageup1"]["name"]);
    $target_file = $target_dir . $img1;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $check = getimagesize($_FILES["imageup1"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        $uploadOk = 0;
      }
    if (file_exists($target_file)) {
      $uploadOk = 0;
    }
    if ($_FILES["imageup1"]["size"] > 5000000) {
      $uploadOk = 0;
    }
    if($imageFileType != "JPG" &&$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      $okFlag = FALSE;
    } else {
      if(move_uploaded_file($_FILES["imageup1"]["tmp_name"], $target_file)) {
      } else {
        $okFlag = FALSE;
      }
    }
  }else{
    $img1 = $_POST['image1'];
  }

  //echo $img1;exit;
	$sql = "SELECT N_id from national_id WHERE N_id  = '$nid'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$sql = "INSERT INTO `users_info`(`NID`,`user_mail`,password,img_NID) VALUES ('$nid','$email','$password','$img1')";
    //echo $sql;exit;
		$conn->query($sql);
    header('Location:login');
}
}
 ?>

    <!-- Page Header Start -->
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="breadcrumb-wrapper">
              <h2 class="page-title">Join Us</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page Header End -->

    <!-- Content section Start -->
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="page-login-form box">
              <h3>
                Register
              </h3>
              <form role="form" class="login-form" method = "post" enctype="multipart/form-data" >
                <div class="form-group">
                  <div class="input-icon">
                    <i class="icon fa fa-user"></i>
                    	<input type="text" class="form-control" name="nid" placeholder="national identity">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-icon">
                    <i class="icon fa fa-envelope"></i>
                    <input type="text" class="form-control" name="email" placeholder="users email">
                  </div>
                </div>

                  <div class="form-group">
                    <label class="control-label">Image of NID</label> <input class="file"  type="file" name="imageup1">
                  </div>

                  <div class="form-group">
                    <div class="input-icon">
                      <i class="icon fa fa-unlock-alt"></i>
                      <input type="password" class="form-control" name="password" placeholder="Type Password">
                    </div>
                  </div>

                <div class="form-group">
                  <div class="input-icon">
                    <i class="icon fa fa-unlock-alt"></i>
                    <input type="password" class="form-control" placeholder="Retype Password">
                  </div>
                </div>

                <div class="checkbox">
                  <label for="remember">After completion of registration, a mail would be sent to your email to activate your account.</label>
                </div>
                <button class="btn btn-common log-btn" name="user_add" >Register</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Content section End -->
    <?php
    include_once 'includes/footer.php';
    ?>
