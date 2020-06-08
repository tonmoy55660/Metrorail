<?php
include_once 'includes/header.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script type="text/javascript">
  function buy(sc_id,ar_t,st_id,tr_id,price,balance){
    var amount = document.getElementById('amount');
    var am = amount.options[amount.selectedIndex].value;
    var p = am * price;
    if(p > balance ){
      swal({
  title: "Please recharge your balance",
  text: "You have selected "+am+" Tickets that price's "+p+"tk",
  type: "error",
  showCancelButton: false,
  confirmButtonClass: "btn-primary",
  confirmButtonText: "Ok",
  closeOnConfirm: false,
});

    }else if (balance > p) {

      swal({
    title: "Purchase Confirmation",
    text: "Your will be charged "+p+" tk",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-success",
    confirmButtonText: "BUY!",
    closeOnConfirm: false
  },
  function(){
    window.location.href = "http://localhost/metrorail/mailTicket?confirmation&&sc_id="+sc_id+"&&ar_t= "+ar_t+"&&st_id="+st_id+"&&tr_id="+tr_id+"&&price="+price+"&&am="+am+"&&balance="+balance;
  });
    }
  }

</script>


<?php
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("dbCon.php");
$conn =connect();
?>
<!-- Start intro section -->
<section id="intro" class="section-intro">
  <div class="overlay">
    <div class="container">
      <div class="main-text">
        <h1 class="intro-title">Welcome To </br><span style="color: #3498DB">MetrolRail E-ticketing</span></h1>
      </br>

      <!-- Start Search box -->
      <div class="row search-bar">
        <div class="advanced-search">
          <form class="search-form" action="controller" method="post">
            <div class="col-md-3 col-sm-6 search-col">
              <div class="input-group-addon search-category-container">
                <label class="styled-select">
                  <select class="dropdown-product selectpicker" name="source" >
                    <option selected="true" disabled="disabled">Source Station</option>
                    <?php
                    $sql="SELECT * FROM stationinfo ";
                    $resultData=$conn->query($sql);
                    foreach ($resultData as $row){
                      ?>
                      <option class="subitem" value="<?=$row['id']?>"><?=$row['stationName']?></option>
                    <?php } ?>
                  </select>
                </label>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 search-col">
              <div class="input-group-addon search-category-container">
                <label class="styled-select ">
                  <select class="dropdown-product selectpicker" name="destination" >
                    <option selected="true" disabled="disabled">Destination Station</option>
                    <?php
                    $sql="SELECT * FROM stationinfo ";
                    $resultData=$conn->query($sql);
                    foreach ($resultData as $row){
                      ?>
                      <option class="subitem" value="<?=$row['id']?>"><?=$row['stationName']?></option>
                    <?php } ?>
                  </select>
                </label>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 search-col">
              <div class="input-group-addon search-category-container">
                <label class="styled-select location-select">
                  <select class="dropdown-product selectpicker" name="time" >
                    <option value="0">Time (24 hour format)</option>
                    <option value="8">08:00</option>
                    <option value="9">09:00</option>
                    <option value="10">10:00</option>
                    <option value="11">11:00</option>
                    <option value="12">12:00</option>
                    <option value="13">13:00</option>
                    <option value="14">14:00</option>
                    <option value="15">15:00</option>
                    <option value="16">16:00</option>
                    <option value="17">17:00</option>
                    <option value="18">18:00</option>
                  </select>
                </label>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 search-col">
              <button class="btn btn-common btn-search btn-block" name="search" type="submit"><strong>Search</strong></button>
            </div>
          </form>
        </div>
      </div>
      <!-- End Search box -->
    </div>
  </div>
</div>
</section>
<!-- end intro section -->

<!-- Start Content -->
<div id="content">
  <div class="container">
    <div class="col-sm-12 page-content">
      <div class="inner-box">
        <h2 class="title-2"><i class="fa fa-credit-card"></i> My SEARCH</h2>
        <div class="table-responsive">
          <?php if(isset($_GET['query_id'])){
            $route_id = $_GET['query_id'];
            $time = $_SESSION['time'];
            if($time > 12){
              $time = ($time - 12);
            }
            $betTime = ($time +1);
            $usr = $_SESSION['id'];
            $balanceSql = "SELECT balance FROM account_balance WHERE user_id = '$usr'";
            $balanceR= $conn->query($balanceSql);
            $rowbalance = mysqli_fetch_assoc($balanceR);
            $sql1 = "SELECT base_fair from base_fair";
            $sql2 = "SELECT fair from fair_per_km";
            $result= $conn->query($sql1);
            $rowbase = mysqli_fetch_assoc($result);
            $results= $conn->query($sql2);
            $rows = mysqli_fetch_assoc($results);
            $source = $_SESSION['source'];
            $des = $_SESSION['destination'];
            $sql5 = "SELECT `stationName` FROM `stationinfo` WHERE `id` = $source";
            $re1= $conn->query($sql5);
            $r1 = mysqli_fetch_assoc($re1);
            $sql6 = "SELECT `stationName` FROM `stationinfo` WHERE `id` = $des";
            $re2= $conn->query($sql6);
            $r2 = mysqli_fetch_assoc($re2);
            if($source < $des){
              $qu = "SELECT SUM(d.distance) as dis FROM distance AS d
              WHERE `des_station_id` BETWEEN
              (SELECT ds.des_station_id FROM distance AS ds WHERE ds.source_station_id = '$source') AND '$des'";
              $r = $conn->query($qu);

            }elseif($source > $des){
              $qu = "SELECT SUM(d.distance) as dis FROM distance AS d
              WHERE `des_station_id` BETWEEN '$des'
              AND  (SELECT ds.des_station_id FROM distance AS ds WHERE ds.source_station_id = '$source')";
              $r = $conn->query($qu);
            }
            $dis = mysqli_fetch_assoc($r);
            $sql = "SELECT id FROM schedule_info WHERE route_id = '$route_id'";
            $result = $conn->query($sql);
            $data = '0';
            foreach( $result as $row ){
              $data .=  $row['id'].',';
            }
            $data = rtrim($data,',');
            $sql = "SELECT * FROM time_schedule  as t, schedule_info as sc, train_info as tr WHERE t.schedule_id = sc.id AND sc.train_id = tr.id AND  `schedule_id` IN ($data) AND station_id = '$source'  AND arrival_time between $time AND $betTime";
            $result = $conn->query($sql);
            //echo $sql;
            $rowcount=mysqli_num_rows($result);
            if($rowcount < 1){
              ?>
              <td><h4>No result Found! Try again with another time!</h4></td>
              <?php
                }else{
              ?>
              <table class="table table-striped table-bordered add-manage-table">
                <thead>
                  <tr class="text-center">
                    <th>Source Station</th>
                    <th>Train Name</th>
                    <th>Arrival Time</th>
                    <th>Departure Time</th>
                    <th>Destination</th>
                    <th>Total KM</th>
                    <th>Price</th>
                    <th>Amount of ticket</th>
                    <th>Buy Ticket</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($result as $value) {
                    ?>
                    <tr class="text-center">
                      <td><h5> <?=$r1['stationName']?> </h5></td>
                      <td><h5> <?=$value['train_name']?> </h5></td>
                      <td><?=$value['arrival_time']?></td>
                      <td><?=$value['departure_time']?></td>
                      <td><h5><?=$r2['stationName']?></h5></td>
                      <td><?=$dis['dis']?> KM</td>
                      <td><?php $price = $dis['dis']*$rows['fair']; echo $p = ($price+$rowbase['base_fair']);echo ' ৳'; ?></td>
                      <td><select class="form-control" id = "amount" name="amount" >
                        <option class="subitem" value="1">1</option>
                        <option class="subitem" value="2">2</option>
                        <option class="subitem" value="3">3</option>
                        <option class="subitem" value="4">4</option>
                      </select></td>
                      <?php if(isset($_SESSION['isLogged'])){?>
                        <td> <button type="button" class="btn btn-success" onclick = "buy(<?=$value['schedule_id']?>,'<?=$value['arrival_time']?>',<?=$value['station_id']?>,<?=$value['train_id']?>,'<?=$p?>',<?=$rowbalance['balance']?>);" name="button">Buy</button></td>
                      <?php } else{ ?>
                        <td style="color:red">Please Login</td>
                      <?php } ?>
                    </tr>
                  <?php } } ?>
                </tbody>
              </table>
            <?php }else{ echo '<h3>No search Yet</h3>'; }  ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Content -->

<!-- Counter Section Start -->
<section id="counter">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="counting wow fadeInDownQuick" data-wow-delay=".5s">
          <div class="icon">
            <span>
              <i class="lnr lnr-tag"></i>
            </span>
          </div>
          <div class="desc">
            <h3 class="counter">12090</h3>
            <p>Regular Ads</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="counting wow fadeInDownQuick" data-wow-delay="1s">
          <div class="icon">
            <span>
              <i class="lnr lnr-map"></i>
            </span>
          </div>
          <div class="desc">
            <h3 class="counter">350</h3>
            <p>Locations</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="counting wow fadeInDownQuick" data-wow-delay="1.5s">
          <div class="icon">
            <span>
              <i class="lnr lnr-users"></i>
            </span>
          </div>
          <div class="desc">
            <h3 class="counter">23453</h3>
            <p>Reguler Members</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="counting wow fadeInDownQuick" data-wow-delay="2s">
          <div class="icon">
            <span>
              <i class="lnr lnr-license"></i>
            </span>
          </div>
          <div class="desc">
            <h3 class="counter">150</h3>
            <p>Premium Ads</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Counter Section End -->
<?php
include_once 'includes/footer.php';
?>
