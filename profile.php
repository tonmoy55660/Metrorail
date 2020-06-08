<?php
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("dbCon.php");
$conn =connect();
?>

<?php
if(isset($_POST['update'])){
  $id = $_SESSION['id'];
  $pass= $_POST['password'];
  $repass = $_POST['repassword'];
  if($pass == $repass){
    $p = md5($pass);
    $sql ="Update users_info SET password = '$p' WHERE id = '$id'";
    if($conn->query($sql)){
      echo 'done';

    }

  }

}



$nid = $_SESSION['NID'];
$sql = "select * from users_info as ad , national_id as nd WHERE ad.NID=nd.N_id AND ad.NID = '$nid'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
 ?>
    <!-- Start Content -->
    <div id="content">
      <div class="container">
          <div class="col-sm-12 page-content">
            <div class="inner-box">
              <div class="usearadmin">
               <h3><a href="#"> <?=$row['Name']?></a></h3>
              </div>
            </div>
            <div class="inner-box">
              <div class="welcome-msg">
                <h3 class="page-sub-header2 clearfix no-padding">Hello <?=$row['Name']?></ </h3>
              </div>
              <div id="accordion" class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title"> <a aria-expanded="false" class="collapsed" href="#collapseB2" data-toggle="collapse"> Change Password </a> </h4>
                  </div>
                  <div style="height: 0px;" aria-expanded="false" class="panel-collapse collapse" id="collapseB2">
                    <div class="panel-body">
                      <form role="form" method="POST" >

                        <div class="form-group">
                          <label class="control-label">New Password</label>
                          <input class="form-control" placeholder="type new password" name="password" type="password">
                        </div>
                        <div class="form-group">
                          <label class="control-label">Confirm Password</label>
                          <input class="form-control" placeholder="Re-type new password" name="repassword" type="password">
                        </div>
                        <div class="form-group">
                          <button type="submit"  class="btn btn-common" name="update">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title"> <a href="#collapseB1" data-toggle="collapse"> My details </a> </h4>
                  </div>
                  <div class="panel-collapse collapse in" id="collapseB1">
                    <div class="panel-body">
                        <div class="form-group">
                          <label class="control-label">Email</label>
                          <label class="form-control"><?=$row['user_mail']?></</label>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Gender</label>
                          <label class="form-control"><?=$row['Gender']?></</label>
                        </div>
                        <div class="form-group">
                          <label for="Phone" class="control-label">Nation Id NO</label>
                          <label class="form-control"><?=$row['NID']?></</label>
                        </div>
                        <div class="form-group">
                          <label for="Phone" class="control-label">Date Of Birth</label>
                          <label class="form-control"><?=$row['DOB']?></</label>
                        </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Content -->
    <?php
    include_once 'includes/footer.php';
    ?>
