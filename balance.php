<?php
include_once 'includes/header.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script type="text/javascript">

  function inputamount(){
    swal({
  title: "Input Recharge Amount",
  type: "input",
  showCancelButton: true,
  closeOnConfirm: false,
  inputPlaceholder: "Write something"
}, function (inputValue) {
  if (inputValue === false) return false;
  if (inputValue === "") {
    swal.showInputError("You need to input amount!");
    return false
  }
  //swal("Nice!", "You wrote: " + inputValue, "success");
  window.location.href = "http://localhost/metrorail/checkout?amount="+ inputValue;
});
  }

</script>
<?php
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("dbCon.php");
$conn =connect();
?>
<?php

  $id = $_SESSION['id'];
  $sql = "SELECT balance FROM account_balance WHERE user_id = '$id'";
  $result = $conn->query($sql);
  $row = mysqli_fetch_assoc($result);

 ?>
    <!-- Start Content -->
    <div id="content">
      <div class="container">
          <div class="col-sm-12 page-content">
            <div class="inner-box">
              <div class="text-center">
               <h2>Balance :<b style="color:red;"><?=$row['balance']?>  ৳</b></h2>
              </div>
            </div>
              <div class="inner-box">
                <div class="row">
                  <div class="col-sm-6">
                    <h2 class="title-2"><i class="fa fa-credit-card"></i> Transaction History</h2>
                  </div>
                  <div class="col-sm-6">
                    <button class="btn btn-primary pull-right" onclick="inputamount()"><i class="fa fa-credit-card"></i> Recharge Balance</button>
                  </div>
                </div>

                <div class="table-responsive">
                <hr>
                  <table class="table table-striped table-bordered add-manage-table">
                    <thead>
                      <tr>
                        <th data-type="numeric">Transaction ID</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Card type</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                       $sql = "SELECT * FROM transaction_history WHERE user_id = '$id'";
                       $result = $conn->query($sql);
                       foreach ($result as $value) {
                       ?>
                      <tr>
                        <td><?=$value['transaction_id']?></td>
                        <td><?=$value['date']?></td>
                        <td><?=$value['amount']?></td>
                        <td><?=$value['card_type']?></td>

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
    </div>
    <!-- End Content -->
    <?php
    include_once 'includes/footer.php';
    ?>
