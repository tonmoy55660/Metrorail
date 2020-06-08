<?php
$title = 'Dashboard | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script>
   google.charts.load('current', { 'packages': ['map'] });
   google.charts.setOnLoadCallback(drawMap);

   function drawMap() {
     var data = google.visualization.arrayToDataTable([
    ['Lat', 'Long', 'Name'],
    [23.740624, 90.392869, 'Shahbag']
  ]);

   var options = {
     showTooltip: true,
     showInfoWindow: true
   };

   var map = new google.visualization.Map(document.getElementById('chart_div'));

   map.draw(data, options);
 };
 </script>


<?php
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>6</h3>

              <p>Total Station</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>50<sup style="font-size: 20px"></sup></h3>

              <p>Total Train</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>10</h3>

              <p>Total Trip </p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>100025</h3>

              <p>Total User</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <br>
        <div id="chart_div"></div>
      <!-- /.row -->
</section>



<?php

//Addd new content
include_once 'includes/footer.php';

?>
