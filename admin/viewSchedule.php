<?php
$title = 'Schedules | MetroRail';
include_once 'signinchecker.php';
include_once 'includes/header.php';
include_once 'includes/navbar.php';
include_once 'includes/sidebar.php';
?>

	<section class="content-header">
         <a class="btn btn-success"  href="addScheduleInfo" role="button" ><i class="fa fa-plus" > </i> Click to Add Train Schedule </a>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Train Schedules</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">

				<div class="box box-danger">
					<div class="box-header with-border">
					  <h4 class=" text-center"><b>View All Train-Schedule</b> </h4>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php if (isset($_SESSION['msg'])){?>
						<div class="callout callout-success msg"  ><p><?=$_SESSION['msg']?></p></div>
						<?php unset ($_SESSION['msg']);} ?>
						<table id="example1" class="table table-bordered table-hover">
							<thead>
								<tr>
								  <th class="nosort">No.</th>
								  <th>Route Name</th>
								  <th>Train Name</th>
								  <th>Base Station</th>
								  <th>Trip Start Time</th>
								  <th>Trip End Time</th>
								  <th>Edit</th>
								</tr>
							</thead>
							<tbody>
								<?php
								include_once("../dbCon.php");
								$conn =connect();
								$sql="SELECT sc.id, routesName, train_name, s.stationName as station, MIN(`arrival_time`) as start ,MAX(`departure_time`) as end
											FROM `time_schedule` as t , stationinfo as s , train_info as ti , routes_info as r , schedule_info as sc
											WHERE sc.route_id = r.id
											AND sc.train_id = ti.id
											AND sc.id = t.schedule_id
											AND t.station_id = s.id
											GROUP BY t.`schedule_id` ORDER BY routesName ASC";
								$result= $conn->query($sql);
								foreach($result as $key=>$value){
								?>
								<tr>
								  <td><?php echo $key+1;?></td>
								  <td><?=$value['routesName']?></td>
								  <td><?=$value['train_name']?></td>
								  <td><?=$value['station']?></td>
								  <td><?=$value['start']?></td>
								  <td><?=$value['end']?></td>
								  <td>
										<form action="addController/sessions" method="post">
											<input type="hidden" name="schedule_id" value="<?=$value['id']?>">
											<button type="submit" name="edit_train_sc" class="btn btn-primary"><i class="fa fa-edit" ></i>Edit</buttton>
										</form>
									</td>
								</tr>
							<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th class="nosort">No.</th>
									<th>Route Name</th>
									<th>Train Name</th>
									<th>Base Station</th>
									<th>Trip Start Time</th>
									<th>Trip End Time</th>
									<th>Edit</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>

			</div>

		</div>
    </section>

<?php
include_once 'includes/footer.php';
?>

<script>
  $(function () {
    $('#example1').DataTable({
			"aoColumns": [
         null,
         null,
         null,
         null,
         null,
         null, // <-- disable sorting for column 3
         { "bSortable": false },
      ]
    })
  })
</script>
