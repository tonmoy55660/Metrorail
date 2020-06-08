<?php
$title = 'Fair | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
include_once("../dbCon.php");
$conn =connect();
?>

	<section class="content-header">
    <h4>View Trip info</h4>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Fair</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-danger">
					<div class="box-header with-border">
					  <h4 class=" text-center"><b>View Fair Information</b></h4>
					</div>
					<!-- /.box-header -->
					<div class="box-body">

              <!-- Custom Tabs (Pulled to the right) -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <?php
  								$sql="SELECT * FROM `schedule_info` WHERE route_id = 004661 AND `train_id` = 3";
  								$result= $conn->query($sql);
  								foreach($result as $key=>$value){
  								?>
                  <li><a href="#<?=$value['id']?>" data-toggle="tab"> TRIP <?=$key+1?></a></li>
                <?php } ?>
                </ul>

                  <div class="tab-pane active col-sm-8 col-sm-offset-2" id="">
                  </br>
                  <div class="row">
          					<div class="col-sm-6 ">
          					  <h4 class="pull-left"><b>Route : </b></h4>
          					</div>
                    <div class="col-sm-6 ">
          					  <h4 class="pull-right"><b>Train :</b></h4>
          					</div>
                  </div>
                </br>
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Station Name</th>
                          <th>Arrival Time</th>
                          <th>Departure Time</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <?php
                            //SELECT * FROM `schedule_info` WHERE route_id = 004661 AND `train_id` = 3
                            //SELECT *FROM `routes_info` as ri, routes_order as ro , stationinfo as s , time_schedule as ts WHERE ri.id = ro.route_id AND ro.station_id=s.id AND ts.station_id = s.id AND ts.schedule_id = 936334 AND ri.id = 004661 GROUP BY ro.ordering ORDER BY ro.ordering



                             ?>

                          <td ><input type="hidden" name="station[]" value="<?=$row['id']?>"><?=$row['stationName']?></td>
                          <td>
                            <div class="input-group clockpicker">
                              <input type="text" class="form-control" name="arrival[]" value="18:00">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                          </td>
                          <td>
                            <div class="input-group clockpicker">
                              <input type="text" class="form-control" name="departure[]" value="18:00">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                          </td>
                          </tr>


                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Station Name</th>
                          <th>Arrival Time</th>
                          <th>Departure Time</th>
                        </tr>
                      </tfoot>
                    </table>

                       <button type="submit" class="btn btn-info col-md-4 pull-right"   name="save"><i class="fa fa-edit"></i> Edit</button>

                  </div>
                  <!-- /.tab-pane -->
              </div>

</div>
</div>
</div>
</div>
</section>

<?php
include_once 'includes/footer.php';
?>
