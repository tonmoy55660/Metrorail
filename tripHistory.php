<?php
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("dbCon.php");
$conn =connect();
?>

    <!-- Start Content -->
    <div id="content">
      <div class="container">
          <div class="col-sm-12 page-content">
            <div class="inner-box">
              <h2 class="title-2"><i class="fa fa-credit-card"></i> My Trips</h2>
              <div class="table-responsive">

                <table class="table table-striped table-bordered add-manage-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Source Station</th>
                      <th>Destination Station</th>
                      <th>Time</th>
                      <th>Amount</th>
                      <th>Total Fare</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $id = $_SESSION['id'];
                     $sql = "SELECT * FROM trip_history WHERE user_id = '$id'";
                     $result = $conn->query($sql);
                     foreach ($result as $key => $value) {
                     ?>
                    <tr class = "text-center">
                      <td><?=$key+1?></td>
                      <td ><?=$value['source_station']?></td>
                      <td ><?=$value['destination_station']?></td>
                      <td ><?=$value['time']?></td>
                      <td ><?=$value['amount']?></td>
                      <td ><?=$value['total_fare']?></td>
                      <td ><?=$value['date']?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
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
