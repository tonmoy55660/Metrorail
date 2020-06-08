<?php
$title = 'Add Time Schedule | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("../dbCon.php");
$conn =connect();
?>
<!-- Content Header (Page header) -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <small>Schedule <?php if(isset($_SESSION['schedule_id'])){ ?> Edit Form<?php }else{ ?> Add Form 2 <?php } ?> </small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</li>
    <?php if(!isset($_SESSION['schedule_id'])){ ?>
      <li>Select train-routes</li>
    <?php } ?>

    <li class="active"><?php if(isset($_SESSION['schedule_id'])){ ?> Edit <?php }else{ ?> Add  <?php } ?> time Scedule train</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-warning ">
    <div class="box-header with-border">
      <h4 class="text-center"><b><?php if(isset($_SESSION['schedule_id'])){ ?> Edit <?php }else{ ?> Add  <?php } ?> Time Schedule Details</b></h4>

    </div>
    <!-- /.box-header -->
    <div class="box-body ">
      <div class="col-md-8 col-md-offset-2">
        <form action="addController/addTimeSave.php" method="post">
          <label class="form-group"><?php if(isset($_SESSION['schedule_id'])){ ?> Edit <?php }else{ ?> Input  <?php } ?> Arrival and Departure Time :</label>
          <div class="form-group">
            <label for="">
            </label>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Station Name</th>
                  <th>Arrival Time</th>
                  <th>Departure Time</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    if(isset($_SESSION['schedule_id'])){
                      $id = $_SESSION['schedule_id'];
                      $sql = "SELECT *, s.id as ID FROM time_schedule as ts , stationinfo as s WHERE ts.station_id = s.id AND ts.schedule_id = '$id' ORDER BY ts.id ASC";
                      //echo $sql;exit;
                      $resultData=$conn->query($sql);

                    }else{
                     $id = $_SESSION['route_id'] ;
                     $sql="SELECT s.stationName , s.id as ID FROM `routes_info` as ri, routes_order as ro , stationinfo as s WHERE ri.id = ro.route_id AND ro.station_id=s.id AND ri.id = '$id'  ORDER BY ro.ordering";
                     $resultData=$conn->query($sql);
                   }
                     foreach ($resultData as $row){
                  ?>
                  <tr>

                  <td ><input type="hidden" name="station[]" value="<?=$row['ID']?>"><?=$row['stationName']?></td>
                  <td>
                    <div class="input-group clockpicker">
                      <input type="text" class="form-control" name="arrival[]" value="<?php if(isset($row['arrival_time'])){echo $row['arrival_time'];}else{ echo '18:00';}  ?>">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                  </td>
                  <td>
                    <div class="input-group clockpicker">
                      <input type="text" class="form-control" name="departure[]" value="<?php if(isset($row['departure_time'])){echo $row['departure_time'];}else{ echo '18:00';}  ?>">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                  </td>
                  </tr>
                <?php } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>Station Name</th>
                  <th>Arrival Time</th>
                  <th>Departure Time</th>
                </tr>
              </tfoot>
            </table>
          </div>

          <div class="form-group">
            <?php if(isset($_SESSION['schedule_id'])){ ?>
             <a class="btn btn-danger col-md-3" href="viewSchedule" role="button"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
           <?php }else{ ?>
            <a class="btn btn-danger col-md-3" href="addScheduleInfo" role="button"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
          <?php }?>

            <?php if(isset($_SESSION['schedule_id'])){ ?>
             <button type="submit" class="btn btn-info col-md-4 pull-right"  name="ts_edit"><i class="fa fa-save"></i> Edit</button>
           <?php }else{ ?>
            <button type="submit" class="btn btn-success col-md-4 pull-right"  name="ts_add"><i class="fa fa-save"></i> Save</button>
          <?php }?>
          </div>
          </form>
        </div>
  </div>
  </div>
</section>
<!-- /.content -->
<?php
include_once 'includes/footer.php';
?>

<script type="text/javascript">
$('.clockpicker').clockpicker({
  placement: 'bottom',
  align: 'right',
  donetext: 'Done'
});
</script>

</body>
</html>
